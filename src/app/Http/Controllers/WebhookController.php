<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierWebhookController;

class WebhookController extends CashierWebhookController
{
    public function handleCheckoutSessionCompleted($payload)
    {
        Log::info($payload);
        Cookie::forget('cart');

        if ($user = $this->getUserByStripeId($payload['data']['object']['customer'])) {
            $order = $user->orders()->create();
        }
    }
}
