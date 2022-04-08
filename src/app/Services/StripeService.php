<?php

namespace App\Services;

use Stripe\StripeClient;

class StripeService
{
    function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    public function listProducts()
    {
        return $this->stripe->products->all();
    }

    public function createProduct($data)
    {
        $stripeProduct = $this->stripe->products->create([
            'name' => $data['name'],
            'active' => (bool) $data['is_visible'],
        ]);
        /* dd($product); */

        $stripeProductPrice = $this->stripe->prices->create([
            'unit_amount' => $data['price'],
            'product' => (float) $stripeProduct['id'],
            'currency' => env('CASHIER_CURRENCY'),
            'active' => true,
        ]);

        dd($stripeProductPrice);
    }
}
