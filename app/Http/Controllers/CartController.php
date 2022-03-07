<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

    public function index(){
        $products = Cookie::get('cart');
        return $products;
    }

    public function addToCart($id){
        $cookie = Cookie::get('cart');

        if (!isset($cookie[intval($id)])){
            $product[intval($id)]['quantity'] = 1;
        }else{
            $product = [
                'id' => intval($id),
                'quantity' => 1,
            ];
            Cookie::queue('cart', json_encode($product), 10);
        }

        return redirect()->back();
    }
}
