<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;

class CartController extends Controller
{

    public function index(){
        $products = collect(json_decode(Cookie::get('cart')));
        return $products;
    }

    public function addToCart(Product $product){
        //$id = intval($id);
        //$product->quantity = 1;
        //dd($product);
        $collection = collect(json_decode(Cookie::get('cart')));

        if ($collection->contains('id', $product->id)){
            $searchProduct = $collection->firstWhere('id', $product->id);
            $searchProduct->quantity++;
        }else{
            $product->quantity = 1;
            $collection->push($product);
        }

        /*$collection = collect([
            [
                'id' => intval($id),
                'quantity' => 1,
            ]
        ]);*/
        dd($collection);
        Cookie::queue('cart', $collection->toJson(), 10);


        //return redirect()->back();
    }
}
