<?php

namespace App\Services\Stripe;

use Stripe\StripeClient;

class CustomersStripe
{
    function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    public function createCustomer($name, $email)
    {
        return $this->stripe->customers->create([
            'name' => $name,
            'email' => $email,
        ])->id;
    }
}
