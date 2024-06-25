<?php

namespace App\Interfaces;

use App\Interfaces\ProductComponentInterface;

interface ProductInterface extends ProductComponentInterface
{
    public function getDetails(): string;
    public function getName(): string;
    public function getDescription(): string;
    public function getPrice(): float;
}