<?php

namespace App\Factories;

use App\Models\Product;
use App\Interfaces\ProductInterface;
use App\Interfaces\ProductFactoryInterface;

class ProductFactory implements ProductFactoryInterface
{
    public function createProduct(string $name, string $description, float $price): ProductInterface
    {
        return new Product($name, $description, $price);
    }

    public function createProductFromData(array $data): ProductInterface
    {
        // Avant de créer un produit, nous devons vérifier si les données nécessaires sont présentes
        if(!array_key_exists('name', $data))
        {
            throw new \InvalidArgumentException('Le nom du produit est requis');
        }
        if(!array_key_exists('description', $data))
        {
            throw new \InvalidArgumentException('La description du produit est requise');
        }
        if(!array_key_exists('price', $data))
        {
            throw new \InvalidArgumentException('Le prix du produit est requis');
        }

        // Créer un produit à partir des données
        return new Product($data['name'], $data['description'], $data['price']);
    }
}