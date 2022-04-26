<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop.categories.index');
    }



    public function show(Category $category)
    {
        return view('shop.index', [
            'products' => Product::where('category_id', $category->id)->paginate(9),
            'categories' => $this->categories,
            'brands' => $this->brands,
        ]);
    }
}
