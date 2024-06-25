<?php

namespace App\Models;

use App\Interfaces\PaymentInterface;

class Payment implements PaymentInterface
{

    public function __construct(
        public string $name,
        public string $description,
        public Order $order
    )
    { 
    }

    public function getDetails(): string
    {
        return 'Method de payement par ' . $this->name . ' - ' . $this->description;
    }

    public function pay(): string
    {
        $this->order->payed = true;
        return 'Paiement effectué';
    }
}