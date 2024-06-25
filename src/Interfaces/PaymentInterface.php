<?php

namespace App\Interfaces;

interface PaymentInterface
{
    public function getDetails(): string;
    public function pay(): string;
}
