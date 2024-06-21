<?php

namespace App\Interfaces;

interface ProductFactoryInterface
{
    public function createProduct(string $name, string $description, float $price): ProductInterface;

    public function createProductFromData(array $data): ProductInterface;
}