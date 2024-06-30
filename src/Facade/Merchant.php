<?php

namespace App\Facade;

use App\Adapter\StripePayment;
use App\Builders\OrderBuilder;
use App\Decorators\OrderDiscount;
use App\Interfaces\ProductComponentInterface;
use App\Models\Payment;
use App\Singleton\Depot;

// Facade en forme de singleton pour gérer les achats
abstract class Merchant
{
    protected static $orderBuilder;
    protected static ?ProductComponentInterface $products;

    public static function listProducts(): void
    {
        $products = Depot::listProducts();

        // Affichage des produits
        $products->display();

        // On demande si l'utilisateur veut acheter un produit
        echo PHP_EOL;
        echo "Voulez-vous acheter un produit ? (oui/non) : ";
        $choice = trim(fgets(STDIN));

        if ($choice === 'oui' || $choice === 'o' || $choice === 'Oui' || $choice === 'O') {
            $product = null;

            echo "Entrez le nom du produit que vous souhaitez acheter : \n";
            $productName = trim(fgets(STDIN));
            $product = Depot::searchProduct($productName);

            if ($product == null) {
                echo "Produit non trouvée\n";
            } else {
                if (self::$orderBuilder === null) {
                    self::$orderBuilder = new OrderBuilder();
                }
                // clear the console
                echo "\033[2J\033[;H";
                echo PHP_EOL;
                echo '✅ "' . $product->getName() . '" à été ajouté au pannier' . PHP_EOL;
                echo PHP_EOL;
                self::$orderBuilder->addProduct($product);
            }
        } else if ($choice === 'non' || $choice === 'n' || $choice === 'Non' || $choice === 'N') {
            // clear the console
            echo "\033[2J\033[;H";
        } else {
            // clear the console
            echo "\033[2J\033[;H";
            echo "Choix invalide\n";
            self::listProducts();
        }
    }


    public static function displayCart(): void
    {
        if (self::$orderBuilder === null) {
            echo "Votre pannier est vide !";
            echo PHP_EOL;
            echo PHP_EOL;
        } else {
            echo "Votre pannier vous coûtera : " . self::$orderBuilder->build()->getTotalAmount() . " €\n";
            echo PHP_EOL;
            foreach (self::$orderBuilder->getProducts() as $product) {
                $product->display();
            }

            echo PHP_EOL;
            echo "0. Vider mon pannier\n";
            echo "1. Continuer mes achats\n";
            $choice = trim(fgets(STDIN));

            // clear the console
            echo "\033[2J\033[;H";
            if ($choice == "0") {
                self::$orderBuilder = new OrderBuilder();
                echo "Votre pannier à été vidé\n";
                echo PHP_EOL;
            }
        }
    }

    // function pour regler le pannier
    public static function checkout(): void
    {
        if (self::$orderBuilder === null) {
            echo "Votre pannier est vide !";
            echo PHP_EOL;
            echo PHP_EOL;
        } else {
            $order = self::$orderBuilder->build();
            echo "Votre pannier vous coûtera : " . $order->getTotalAmount() . " €\n";
            echo PHP_EOL;
            foreach ($order->getProducts() as $product) {
                $product->display();
            }

            // On demade si l'utilisateur a un code promo
            echo "Avez-vous un code promo ? (oui/non) : ";
            $choice = trim(fgets(STDIN));

            if ($choice === 'oui' || $choice === 'o' || $choice === 'Oui' || $choice === 'O') {
                $order = new OrderDiscount($order);
                // clear the console
                echo "\033[2J\033[;H";
                echo $order->getDetails();
                echo PHP_EOL;
            }

            echo PHP_EOL;
            echo "Choisissez un mode de paiement : -- -- -- -- -- -- \n";
            echo "  0. Annuler\n";
            echo "  1. En espèces\n";
            echo "  2. Stripe\n";
            echo "  3. PayPal\n";
            echo "Votre choix :";
            $choice = trim(fgets(STDIN));

            while ($choice != "0" && $choice != "1" && $choice != "2" && $choice != "3") {
                echo "Choix invalide\n";
                $choice = trim(fgets(STDIN));
            }

            // clear the console
            echo "\033[2J\033[;H";

            switch ($choice) {
                case "0":
                    echo "Achat annulé\n";
                    break;
                case "1":
                    $payment = new Payment("Cash Payment", "payement par espèces", $order);
                    break;
                case "2":
                    $payment = new Payment("Stripe Payment", "payement en ligne avec Stripe", $order);
                    $stripePayment = new StripePayment($payment);

                    echo "Veulliez regler à partir du lien suivante";
                    echo "  " . $stripePayment->getPaymentLink();
                    break;
                case "3":
                    $payment = new Payment("PayPal Payment", "payement en ligne avec PayPal", $order);
                    // TODO créer payment adapter de payement pour PayPal

                    break;
            }

            if (isset($payment)) {
                echo $payment->pay();
                echo "Merci pour votre achat !\n";
            }
        }
    }
}
