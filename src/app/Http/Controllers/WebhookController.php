<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Order_Product;
use Illuminate\Support\Facades\DB;
use App\Services\Stripe\CheckoutStripe;
use Illuminate\Support\Facades\Log;
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
            $id = $payload['data']['object']['id'];
            Log::info('aqui');
            Log::info($id);
            Log::info((string) $id);
            Log::info($payload['data']['object']);
            $order = Order::create(['user_id' => $user->id, 'status' => 'Preparing'], $id);

            $products = $this->stripeService->checkoutItems($id);


            foreach ($products  as $item) {
                $product = Product::where('stripe_product_id', $item->price->product)->get()[0];

                if ($product->stock >= $item->quantity) {
                    Order_Product::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
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
