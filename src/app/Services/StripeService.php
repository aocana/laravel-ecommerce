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
        $product = $this->stripe->products->create([
            'name' => $data['name'],
            'active' => (bool) $data['is_visible'],
        ]);
        dd($product);

        return $product;
    }
}
