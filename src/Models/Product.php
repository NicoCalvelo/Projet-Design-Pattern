<?php

namespace App\Models;

use App\Interfaces\ProductComponentInterface;
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

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function display($depth = 0): void
    {
        $offset = implode("", array_fill(0, $depth, "\t"));
        echo $offset . "- " . $this->getDetails() . PHP_EOL;
    }

    public function searchByName(string $name): ?ProductComponentInterface
    {
        if(strtolower($this->name) === strtolower($name)){
            return $this;
        } else {
            return null;
        }
    }
}