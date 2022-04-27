<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        //
    }


    public function show(Brand $brand)
    {
        return view('shop.index', [
            'products' => $brand->products()->paginate(9),
            'categories' => $this->categories,
            'brands' => $this->brands,
        ]);
    }
}
