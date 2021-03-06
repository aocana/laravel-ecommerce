<?php

namespace App\Services\Stripe;

use Stripe\StripeClient;
use Laravel\Cashier\Cashier;

class ProductsStripe
{
    private StripeClient $stripe;

    function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
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
            'active' => (bool) $data['is_visible'],
        ]);

        return ['product_id' => $stripeProduct['id'], 'price_id' => $stripePrice['id']];
    }


    public function updateProduct($product, $data): string
    {
        $this->stripe->products->update(
            $product->stripe_product_id,
            [
                'name' => $data['name'],
                'active' => (bool) $data['is_visible'],
            ]
        );

        return $this->updateProductPrice($product->stripe_price_id, $product->stripe_product_id, $data);
    }


    public function updateProductPrice($currentPriceId, $productId, $data)
    {
        $stripePriceId = $currentPriceId;
        $stripePrice = $this->stripe->prices->retrieve($currentPriceId, [])->unit_amount;
        $productPrice = (int) str_replace('.', '', $data['price']);

        if ($stripePrice == $productPrice) {
            $this->stripe->prices->update(
                $currentPriceId,
                ['active' => (bool) $data['is_visible']]
            );
        } else {
            //search price
            $this->stripe->prices->search(
                $currentPriceId,
                ['active' => false]
            );
            //new price
            $newStripePrice = $this->stripe->prices->create([
                'unit_amount' => $data['price'] * 100,
                'product' => $productId,
                'currency' => env('CASHIER_CURRENCY'),
                'active' => (bool) $data['is_visible'],
            ]);

            $stripePriceId = $newStripePrice->id;
        }

        return $stripePriceId;
    }
}
