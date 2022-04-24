<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\MeilisearchService;

class ShopController extends Controller
{

    private MeilisearchService $meilisearch;

    public function __construct()
    {
        $this->meilisearch = new MeilisearchService();
    }


    public function index(): View
    {
        $products = Product::where('is_visible', 1)
            ->paginate(9);

        return view('shop.index', compact('products'));
    }

    public function search(Request $request): View
    {
        $options = [];
        if ($request->sort) $options['sort'] = [$request->sort];
        if ($request->filter) $options['filter'] = [$request->filter];
        //if (!$request->input('query')) $options['sort'] = ['name:asc'];

        $results = collect($this->meilisearch->search('products', $request->input('q'), $options));

        $products = Product::whereIn('id', $results->pluck('id'))
            ->paginate(9);
        //findMany($results->pluck('id'))

        return view('shop.index', compact('products'));
    }
}
