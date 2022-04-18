<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierWebhookController;

class WebhookController extends CashierWebhookController
{
    public function handleCheckoutSessionCompleted($payload)
    {
        if ($user = $this->getUserByStripeId($payload['data']['object']['customer'])) {
            Cookie::forget('cart');
        }
    }
}
