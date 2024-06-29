<?php

namespace App\Builders;

use App\Models\Order;
use App\Interfaces\OrderInterface;
use App\Interfaces\ProductInterface;

class OrderBuilder
{
    protected string $orderNumber;
    protected array $products;

    public function __construct()
    {
        $this->orderNumber = uniqid("ORDER_");
        $this->products = [];
    }

    public function addProduct(ProductInterface $product): self
    {
        $this->products[] = $product;
        return $this;
    }

    public function getProducts() : array
    {
        return $this->products;
    }

    public function removeProduct(ProductInterface $product): self
    {
        $this->products = array_filter($this->products, fn ($p) => $p !== $product);
        return $this;
    }

    public function build(): OrderInterface
    {
        $order = new Order($this->orderNumber);
        foreach ($this->products as $product) {
            $order->addProduct($product);
        }
        return $order;
    }

}