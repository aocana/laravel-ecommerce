<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

    public function index(Request $request): View
    {
        $products = collect(json_decode(Cookie::get('cart')));
        /*
        if (count($products) == 0) {
            $checkout = null;
        } else {
            $checkout = $request->user()->checkout($products->pluck('stripe_id')->toArray(), [
                'success_url' => route('shop.index'),
                'cancel_url' => route('shop.index'),
            ]);
        }
*/

        /* dd($checkout); */

        return view('cart.index', compact('products'));
    }

    public function addToCart(Product $product)
    {
        $collection = collect(json_decode(Cookie::get('cart')));

        if (!$collection->contains('id', $product->id)) {
            $collection->push($product);
            //$product->quantity = 1;
        }
        /* else{
            $searchProduct = $collection->firstWhere('id', $product->id);
            $searchProduct->quantity++;
        } */

        Cookie::queue('cart', $collection->toJson(), 500);

        return redirect()->back()->with('message', 'Product added');
    }
}
