<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::where('is_visible', 1)
            ->paginate(9);

        return view('shop.index', [
            'products' => $products,
            'categories' => $this->categories,
            'brands' => $this->brands
        ]);
    }

    public function show(Product $product)
    {
        dd($product);
    }

    public function search(Request $request): View
    {
        return view('shop.index', [
            'products' => $this->searchTemplate($request, Product::class),
            'categories' => $this->categories,
            'brands' => $this->brands
        ]);
    }
}
