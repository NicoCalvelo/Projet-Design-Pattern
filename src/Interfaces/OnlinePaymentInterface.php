<?php

namespace App\Interfaces;

interface OnlinePaymentInterface extends PaymentInterface
{
    public function getPaymentLink(): string;
}
