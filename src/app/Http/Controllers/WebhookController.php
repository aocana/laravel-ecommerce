<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Order_Product;
use App\Models\Product;
use App\Services\Prueba;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Services\Stripe\CheckoutStripe;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierWebhookController;

class WebhookController extends CashierWebhookController
{
    private CheckoutStripe $stripeService;

    public function __construct()
    {
        $this->stripeService = new CheckoutStripe();
    }

    public function handleCheckoutSessionCompleted($payload): void
    {
        if ($user = $this->getUserByStripeId($payload['data']['object']['customer'])) {
            $order = Order::create(['user_id' => $user->id, 'status' => 'Preparing']);

            $products = $this->stripeService->checkoutItems($payload['data']['object']['id']);


            foreach ($products  as $item) {
                $productId = Product::where('stripe_product_id', '=', $item->price->product)->get('id')[0]->id;
                Order_Product::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item->quantity,
                ]);
            }
        }
    }
}
