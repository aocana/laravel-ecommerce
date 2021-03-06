<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Cache::remember('products', 10 * 60 * 60, function () {
            return Product::where('is_visible', 1)
                ->paginate(9);
        });

        return view('shop.index', [
            'products' => $products,
            'categories' => $this->categories,
            'brands' => $this->brands
        ]);
    }

    public function show(Product $product): View
    {
        return view('shop.show', compact('product'));
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
