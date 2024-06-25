<?php

namespace App\Decorators;

use App\Interfaces\OrderInterface;
use App\Interfaces\ProductInterface;

class OrderDiscount implements OrderInterface
{
    const DISCOUNT = 0.10;

    public function __construct(
        protected OrderInterface $order
    ) {
    }

    public function getDetails(): string
    {
        return $this->order->getDetails() . "( " . (self::DISCOUNT * 100) . "% de réduction )";
    }

    public function getTotalAmount(): float
    {
        $total = $this->order->getTotalAmount();
        return $total - ($total * self::DISCOUNT);
    }

    public function getProducts(): array
    {
        return $this->order->getProducts();
    }

    public function addProduct(ProductInterface $product): void
    {
        $this->order->addProduct($product);
    }

}