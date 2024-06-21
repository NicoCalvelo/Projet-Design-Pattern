<?php

namespace App\Interfaces;

interface OrderInterface
{
    public function getDetails(): string;
    public function getTotalAmount(): float;
    public function getProducts(): array;
    public function addProduct(ProductInterface $product): void;
}