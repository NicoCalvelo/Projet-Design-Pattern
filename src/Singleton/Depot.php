<?php

namespace App\Singleton;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Interfaces\ProductComponentInterface;

abstract class Depot
{
    protected static $products;

    public static function listProducts(): ProductComponentInterface
    {
        if (!isset($products)) {
            $root = new ProductCategory('Produits');

            // Vêtements
            $clotheCategory = new ProductCategory('Vêtements');
            $clotheCategory->addProduct(new Product('T-shirt', 10.99, 'Un t-shirt simple et élégant'));
            $clotheCategory->addProduct(new Product('Pantalon', 29.99, 'Un pantalon confortable et pratique'));
            $clotheCategory->addProduct(new Product('Chaussures', 49.99, 'Des chaussures de sport'));

            // Boissons
            $drinksCategory = new ProductCategory('Boissons');
            $alcholCategory = new ProductCategory('Alcool');
            $alcholCategory->addProduct(new Product('Vin', 12.99, 'Un bon vin rouge'));
            $alcholCategory->addProduct(new Product('Whisky', 49.99, 'Un whisky écossais'));
            $notAlcholCategory = new ProductCategory('Sans alcool');
            $notAlcholCategory->addProduct(new Product('Eau', 1.99, 'Une bouteille d\'eau minérale'));
            $notAlcholCategory->addProduct(new Product('Soda', 2.99, 'Une canette de soda'));
            $drinksCategory->addProduct($alcholCategory);
            $drinksCategory->addProduct($notAlcholCategory);

            // Nourriture
            $foodCategory = new ProductCategory('Nourriture');
            $breakfastCategory = new ProductCategory('Petit-déjeuner');
            $breakfastCategory->addProduct(new Product('Céréales', 3.99, 'Un paquet de céréales'));
            $breakfastCategory->addProduct(new Product('Pain', 1.99, 'Une baguette de pain'));
            $lunchCategory = new ProductCategory('Déjeuner');
            $lunchCategory->addProduct(new Product('Salade', 4.99, 'Une salade composée'));
            $lunchCategory->addProduct(new Product('Sandwich', 3.99, 'Un sandwich au jambon'));
            $dinneCategory = new ProductCategory('Dîner');
            $dinneCategory->addProduct(new Product('Pâtes', 5.99, 'Un plat de pâtes'));
            $dinneCategory->addProduct(new Product('Steak', 9.99, 'Un steak grillé'));
            $foodCategory->addProduct($breakfastCategory);
            $foodCategory->addProduct($lunchCategory);
            $foodCategory->addProduct($dinneCategory);

            $root->addProduct($clotheCategory);
            $root->addProduct($drinksCategory);
            $root->addProduct($foodCategory);

            self::$products = $root;
        }

        return self::$products;
    }
}
