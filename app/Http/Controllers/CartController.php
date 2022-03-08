<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

    public function index(){
        $products = collect(json_decode(Cookie::get('cart')));
        return $products;
    }

    public function addToCart($id){
        $id = intval($id);
        $collection = collect(json_decode(Cookie::get('cart')));

        if ($collection->contains('id', $id)){
            $prueba = $collection->firstWhere('id', $id);
            $prueba->quantity = 3;
            //$prueba->save();
            dd($collection);
        }else{
            $collection->push([
                'id' => $id,
                'quantity' => 1,
            ]);
        }

        /*$collection = collect([
            [
                'id' => intval($id),
                'quantity' => 1,
            ]
        ]);*/
        Cookie::queue('cart', $collection->toJson(), 10);


        //return redirect()->back();
    }
}
