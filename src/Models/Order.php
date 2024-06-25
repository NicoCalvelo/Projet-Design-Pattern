<?php

namespace App\Models;

use App\Interfaces\OrderInterface;
use App\Interfaces\ProductInterface;

class Order implements OrderInterface
{
    protected array $products = [];

    public function __construct(
        public string $orderNumber,
        public bool $payed = false
    ) {
    }

    public function getDetails(): string
    {
        return 'Order Number: ' . $this->orderNumber . ' - Total Amount: €' . $this->getTotalAmount() . ' - Products: ' . implode(', ', array_map(fn ($product) => $product->getDetails(), $this->products)) . ' - Payment Method:';
    }

    public function getTotalAmount(): float
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice();
        }
        return $total;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function addProduct(ProductInterface $product): void
    {
        $this->products[] = $product;
    }
}
