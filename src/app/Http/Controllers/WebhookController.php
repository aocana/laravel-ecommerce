<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
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

            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'Preparing',
                'checkout_id' => $payload['data']['object']['id'],
                'total' => $payload['data']['object']['amount_total'] / 100
            ]);

            $products = $this->stripeService->checkoutItems($payload['data']['object']['id']);


            foreach ($products  as $item) {
                $product = Product::where('stripe_product_id', $item->price->product)->get()[0];

                if ($product->stock >= $item->quantity) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
                        'unit_price' => $item->price->unit_amount / 100
                    ]);

                    //decrement stock
                    DB::table('products')
                        ->where('id', $product->id)
                        ->decrement('stock', $item->quantity);
                }
            }
        }
    }
}
