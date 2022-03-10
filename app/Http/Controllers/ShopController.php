<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        $products = Product::where('is_visible', 1)
            ->get();

        return view('shop.index', compact('products'));
    }
}
