<?php

namespace App\Models;

use App\Interfaces\ProductComponentInterface;

class ProductCategory implements ProductComponentInterface
{
    /**
     * @var ProductComponentInterface[]
     */
    public array $products = [];

    public function __construct(protected string $title)
    {
    }

    public function addProduct(ProductComponentInterface $product): self
    {
        $this->products[] = $product;
        return $this;
    }

    public function display($depth = 0): void
    {
        // Display the category title
        $offset = implode("", array_fill(0, $depth, "\t"));
        echo $offset . $this->title . PHP_EOL;

        // Call display method on each child
        foreach ($this->products as $product) {
            $product->display($depth + 1);
        }
    }

    // Algorithme simple de recherche de produit par nom, retourne le premier produit trouvé
    public function searchByName(string $name): ?ProductComponentInterface
    {
        foreach ($this->products as $product) {
            $product = $product->searchByName($name);
            if ($product instanceof ProductComponentInterface) {
                return $product;
            }
        }
        return null;
    }
}
