<?php

namespace App\Interfaces;

interface PaymentMethodInterface
{
    public function getDetails(): string;
    public function getPaymentMethod(): string;
    public function pay(float $amount): string;
}
