<?php

namespace App\Singleton;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Interfaces\ProductComponentInterface;
use App\Interfaces\ProductInterface;

// Singleton pour gérer les produits
abstract class Depot
{
    protected static $products;

    public static function listProducts(): ProductComponentInterface
    {
        if (!isset($products)) {
            $root = new ProductCategory('Produits');

            // Vêtements
            $clotheCategory = new ProductCategory('Vêtements');
            $clotheCategory->addProduct(new Product('T-shirt', 'Un t-shirt simple et élégant',  10.99));
            $clotheCategory->addProduct(new Product('Pantalon', 'Un pantalon confortable et pratique', 29.99));
            $clotheCategory->addProduct(new Product('Chaussures', 'Des chaussures de sport', 49.99));

            // Boissons
            $drinksCategory = new ProductCategory('Boissons');
            $alcholCategory = new ProductCategory('Alcool');
            $alcholCategory->addProduct(new Product('Vin', 'Un bon vin rouge', 12.99));
            $alcholCategory->addProduct(new Product('Whisky', 'Un whisky écossais', 49.99));
            $notAlcholCategory = new ProductCategory('Sans alcool');
            $notAlcholCategory->addProduct(new Product('Eau', 'Une bouteille d\'eau minérale', 1.99));
            $notAlcholCategory->addProduct(new Product('Soda', 'Une canette de soda', 2.99));
            $drinksCategory->addProduct($alcholCategory);
            $drinksCategory->addProduct($notAlcholCategory);

            // Nourriture
            $foodCategory = new ProductCategory('Nourriture');
            $breakfastCategory = new ProductCategory('Petit-déjeuner');
            $breakfastCategory->addProduct(new Product('Céréales', 'Un paquet de céréales', 3.99));
            $breakfastCategory->addProduct(new Product('Pain', 'Une baguette de pain', 1.99));
            $lunchCategory = new ProductCategory('Déjeuner');
            $lunchCategory->addProduct(new Product('Salade', 'Une salade composée', 4.99));
            $lunchCategory->addProduct(new Product('Sandwich', 'Un sandwich au jambon', 3.99));
            $dinneCategory = new ProductCategory('Dîner');
            $dinneCategory->addProduct(new Product('Pâtes', 'Un plat de pâtes', 5.99));
            $dinneCategory->addProduct(new Product('Steak', 'Un steak grillé', 9.99));
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


    public static function searchProduct(string $name, ProductCategory $category = null): ?ProductInterface
    {
        if ($category == null) {
            $category = self::$products;
        }
        
        return $category->searchByName($name);
    }
}
