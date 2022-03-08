<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use Illuminate\View\View;

class CartController extends Controller
{

    public function index(): View
    {
        $products = collect(json_decode(Cookie::get('cart')));
        return view('cart.index', compact('products'));
    }

    public function addToCart(Product $product){
        $collection = collect(json_decode(Cookie::get('cart')));

        if (!$collection->contains('id', $product->id)){
            $collection->push($product);
            //$product->quantity = 1;
        }
        /* else{
            $searchProduct = $collection->firstWhere('id', $product->id);
            $searchProduct->quantity++;
        } */

        Cookie::queue('cart', $collection->toJson(), 10);

        return redirect()->back()->with('message', 'Product added');
    }
}
