<?php

namespace App\Interfaces;

// Class de base pour les produits et les categories
// Permets d'implementer le Design Pattern Composite
interface ProductComponentInterface
{
    public function display($depth = 0): void;

    public function searchByName(string $name): ?ProductComponentInterface;
}
