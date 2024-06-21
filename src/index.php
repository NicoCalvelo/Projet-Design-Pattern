<?php

use Stripe\StripeClient;

require_once __DIR__ . "/../vendor/autoload.php";


// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
$stripe = new StripeClient('sk_test_51PRXGiCNlsghrgSRkb09vLyFT541QjRFAR22YCKAbmwBX0ajpcl6RzFieqVfyvCt2uXJgEYGgrFtdtidEz7grCqi002kXTz04V');


// Create a Price
// $res = $stripe->prices->create([
//     'currency' => 'usd',
//     'unit_amount' => 1000,
//     'product' => 'prod_QI7aYiTu2xxSOU',
// ]);


// Create a Payment Link
// $res = $stripe->paymentLinks->create([
//     'line_items' => [
//         [
//             'price' => 'price_1PRXZkCNlsghrgSR5X4mdnLd',
//             'quantity' => 1,
//         ],
//     ],
//     'after_completion' => [
//         'type' => 'redirect',
//         'redirect' => ['url' => 'http://localhost:8001/redirect.php'],
//     ],
// ]);

echo '<script async src="https://js.stripe.com/v3/buy-button.js"></script>';

echo '<stripe-buy-button
  buy-button-id="buy_btn_1PRXoACNlsghrgSRV9RrelCr"
  publishable-key="pk_test_51PRXGiCNlsghrgSRAzwqo8wYiTQrhVB2f3hIer8AWz6CMM3AXa6h4PB87oHTtJ1K03wG4J85NJ81JHplYL2bVSnB00fQgBU0vQ"
>
</stripe-buy-button>';
