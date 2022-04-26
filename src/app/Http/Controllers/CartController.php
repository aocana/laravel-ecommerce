<?php

namespace App\Http\Controllers;

use App\Rules\InStock;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $products = $this->updateCart();
        return view('cart.index', compact('products'));
    }

    public function addToCart(Product $product): RedirectResponse
    {
        $productsOnCart = collect(json_decode(Cookie::get('cart')));

        if (!$productsOnCart->has('$product->id')) {
            $productsOnCart[$product->id] = $product;
        }

        Cookie::queue('cart', $productsOnCart->toJson(), 45000);

        return redirect()->back()->with('message', 'Product added');
    }

    static function updateCart(): Collection
    {
        $productsOnCart = collect(json_decode(Cookie::get('cart')));

        if ($productsOnCart) {
            foreach ($productsOnCart as $key => $product) {
                $productsOnCart[$key] = Product::find($product->id);
            }
        }

        Cookie::queue('cart', $productsOnCart->toJson(), 45000);

        return $productsOnCart;
    }

    public function deleteFromCart(Product $product): RedirectResponse
    {
        $productsOnCart = collect(json_decode(Cookie::get('cart')))->forget($product->id);
        Cookie::queue('cart', $productsOnCart->toJson(), 45000);

        return redirect()->back()->with('message', 'Product deleted');
    }

    public function removeCart(): RedirectResponse
    {
        Cookie::queue(Cookie::forget('cart'));
        return to_route('orders.index');
    }

    public function checkout(Request $request): RedirectResponse
    {
        //comprobar si el producto tiene stock
        $products = collect();
        for ($i = 0; $i < count($request->price); $i++) {
            $products->push([
                'price' => $request->price[$i],
                'quantity' => $request->quantity[$i],
            ]);
        }

        $data = [
            'ids' => $products->pluck('price')->toArray(),
            'quantity' => $products->pluck('quantity')->toArray()
        ];

        Validator::make(
            $data,
            [
                'ids' => 'required|array|min:1',
                'ids.*' => 'required|string|exists:products,stripe_price_id',
                'quantity' => 'required|array|min:1',
                'quantity.*' => ['required', 'numeric', 'min:1', 'max:10', new InStock()],
            ],
        )->validate();

        return redirect($this->stripeCheckout->paymentLink($products->toArray()));
    }
}
