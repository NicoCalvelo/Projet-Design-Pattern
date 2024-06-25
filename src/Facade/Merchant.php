<?php

namespace App\Facade;

use App\Interfaces\ProductComponentInterface;
use App\Singleton\Depot;

abstract class Merchant
{
    protected static $products;

    public static function listProducts() : void
    {
        $products = Depot::listProducts();
        // TODO : continuer
        
    }


}