<?php

namespace App\Adapter;

use App\Models\Payment;
use Stripe\PaymentLink;
use Stripe\StripeClient;
use App\Interfaces\ProductInterface;
use App\Interfaces\OnlinePaymentInterface;

class StripePayment implements OnlinePaymentInterface
{
    protected PaymentLink $paymentLink;

    public function __construct(
        protected Payment $payment
    ) {
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        $stripe = new StripeClient('sk_test_51PRXGiCNlsghrgSRkb09vLyFT541QjRFAR22YCKAbmwBX0ajpcl6RzFieqVfyvCt2uXJgEYGgrFtdtidEz7grCqi002kXTz04V');

        // Create a Price
        $prices = [];
        /** @var ProductInterface $product */
        foreach ($payment->order->getProducts() as $product) {
            $stripeProduct = $stripe->products->create([
                'name' => $product->getName(),
                'description' => $product->getDescription()
            ]);
            $prices[] = $stripe->prices->create([
                'currency' => 'eur',
                'unit_amount' => round($product->getPrice() * 100),
                'product' => $stripeProduct->id
            ]);
        }

        // Create a Payment Link
        $this->paymentLink = $stripe->paymentLinks->create([
            'line_items' => $prices,
            'after_completion' => [
                'type' => 'redirect',
                'redirect' => ['url' => 'https://localhost:3000/Stripe-success'],
            ],
        ]);
    }

    public function getDetails(): string
    {
        return $this->payment->getDetails();
    }

    public function pay(): string
    {
        $this->payment->pay();
        return "Le paiement en ligne pour la commande N°" . $this->payment->order->orderNumber . " est effectué";
    }

    public function getPaymentLink(): string
    {
        return $this->paymentLink->url;
    }
}
