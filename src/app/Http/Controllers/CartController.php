<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use App\Services\Stripe\CheckoutStripe;


class CartController extends Controller
{

    private $stripeService;

    public function __construct(CheckoutStripe $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function index(Request $request): View
    {
        $products = collect(json_decode(Cookie::get('cart')));
        //dd($products);
        return view('cart.index', compact('products'));
    }

    public function addToCart(Product $product): RedirectResponse
    {
        $collection = collect(json_decode(Cookie::get('cart')));

        if (!$collection->contains('id', $product->id)) {
            $collection->push($product);
        }

        Cookie::queue('cart', $collection->toJson(), 45000);

        return redirect()->back()->with('message', 'Product added');
    }

    static function updateCart(Product $product): void
    {
        $collection = collect(json_decode(Cookie::get('cart')));

        $key = $collection->where('id', '==', $product->id)->keys();
        $collection[$key[0]] = $product->getAttributes();

        Cookie::queue('cart', $collection->toJson(), 45000);
    }

    public function checkout(Request $request): RedirectResponse
    {
        dd($request);
        $products = [];
        for ($i = 0; $i < count($request->price); $i++) {
            array_push($products, [
                'price' => $request->price[$i],
                'quantity' => $request->quantity[$i],
            ]);
        }
        dd($products);
        $url = $this->stripeService->paymentLink($products);
        return redirect($url);
    }
}
