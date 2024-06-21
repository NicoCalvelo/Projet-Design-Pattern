<?php

namespace App\Models;

use App\Interfaces\PaymentMethodInterface;

class PaymentMethod implements PaymentMethodInterface
{

    public function __construct(
        protected string $name,
        protected string $description,
        protected Order $order
    )
    { 
    }

    public function getDetails(): string
    {
        return 'Payment Method Details';
    }

    public function getPaymentMethod(): string
    {
        return 'Payment Method';
    }

    public function pay(float $amount): string
    {
        return 'Payment Method Payment';
    }
}