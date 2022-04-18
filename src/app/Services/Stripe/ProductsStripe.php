<?php

namespace App\Services\Stripe;

use Stripe\StripeClient;

class ProductsStripe
{
    function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    public function listProducts()
    {
        return $this->stripe->products->all();
    }

    public function createProduct($data): array
    {
        $stripeProduct = $this->stripe->products->create([
            'name' => $data['name'],
            'active' => (bool) $data['is_visible'],
        ]);

        $stripePrice = $this->stripe->prices->create([
            'unit_amount' => $data['price'] * 100,
            'product' => $stripeProduct['id'],
            'currency' => env('CASHIER_CURRENCY'),
            'active' => true,
        ]);

        return ['product_id' => $stripeProduct['id'], 'price_id' => $stripePrice['id']];
    }

    public function paymentLink($products): string
    {
        $stripe = $this->stripe->paymentLinks->create([
            'line_items' => $products
        ]);
        return $stripe->url;
    }
}
