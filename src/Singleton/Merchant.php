<?php

namespace App\Singleton;

use App\Interfaces\ProductComponentInterface;

abstract class Merchant
{
    protected static $products;

    public static function listProducts() : ProductComponentInterface
    {
        if(!isset($products)){

        }

        return self::$products;
    }


}