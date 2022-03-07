<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){

        $products = Product::where('is_visible', 1)
            ->get();

        return view('shop.index', compact('products'));
    }
}
