<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Stripe\ProductsStripe;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

    private $stripeService;

    public function __construct(ProductsStripe $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function index(Request $request): View
    {
        $products = collect(json_decode(Cookie::get('cart')));

        return view('cart.index', compact('products'));
    }

    public function addToCart(Product $product): RedirectResponse
    {
        $collection = collect(json_decode(Cookie::get('cart')));

        if (!$collection->contains('id', $product->id)) {
            $collection->push($product);
        }

        Cookie::queue('cart', $collection->toJson(), 500);

        return redirect()->back()->with('message', 'Product added');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $products = [];
        for ($i = 0; $i < count($request->price); $i++) {
            array_push($products, [
                'price' => $request->price[$i],
                'quantity' => $request->quantity[$i],
            ]);
        }
        $url = $this->stripeService->paymentLink($products);
        return redirect($url);
    }
}
