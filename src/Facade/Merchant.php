<?php

namespace App\Facade;

use App\Builders\OrderBuilder;
use App\Interfaces\ProductComponentInterface;
use App\Singleton\Depot;

abstract class Merchant
{
    protected static $orderBuilder;
    protected static ?OrderBuilder $products;

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
            foreach (self::$orderBuilder->getProducts() as $product) {
                $product->display();
            }

            echo PHP_EOL;
            echo "Votre pannier vous coûtera : " . self::$orderBuilder->getTotalPrice() . " €\n";
            echo "0. Vider mon pannier\n";
            echo "1. Continuer mes achats\n";
            $choice = trim(fgets(STDIN));

            if ($choice == "0") {
                self::$orderBuilder = new OrderBuilder();
                echo "Votre pannier à été vidé\n";
                echo PHP_EOL;
            }
        }
    }
}
