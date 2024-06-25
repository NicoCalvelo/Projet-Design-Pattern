<?php

namespace App\Interfaces;

// Fot the composite design pattern
interface ProductComponentInterface
{
    public function display($depth = 0): void;

    public function searchByName(string $name): ProductComponentInterface;
}
