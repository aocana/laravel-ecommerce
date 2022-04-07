<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\View\View;
use App\Services\FileService;
use App\Services\StripeService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

class ProductController extends Controller
{
    private $fileService;
    private $stripe;

    public function __construct(FileService $fileService, StripeService $stripe)
    {
        $this->fileService = $fileService;
        $this->stripe = $stripe;
    }

    public function index(): View
    {
        $products = Product::paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(ProductCreateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['image'] = $this->fileService->upload('products', $request->image);

        $this->stripe->createProduct($validatedData);
        /* dd($validatedData); */


        Product::create($validatedData);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created succesfully');
    }

    public function show(Product $product): View
    {
        return view('admin.products.show', $product);
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', $product);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) $this->fileService->delete($product->image);
        $product->delete();
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted succesfully');
    }
}
