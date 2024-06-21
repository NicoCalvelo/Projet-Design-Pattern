<?php

namespace App\Models;

use App\Interfaces\ProductInterface;

class Product implements ProductInterface
{

    public function __construct(
        protected string $name,
        protected string $description,
        protected float $price
    )
    { 
    }

    public function getDetails(): string
    {
        return $this->name . ' : ' . $this->description . ' ( €' . $this->price . ' )';
    }
}