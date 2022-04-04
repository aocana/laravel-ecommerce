<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\View\View;
use App\Services\FileService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

class ProductController extends Controller
{
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
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
        $validatedData['stripe_id'] = "prueba12";
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
