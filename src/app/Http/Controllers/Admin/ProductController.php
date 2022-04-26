<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->paginate(10);

        return view('admin.products.index', [
            'products' => $products,
            'brands' => $this->brands,
            'categories' => $this->categories,
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'brands' => $this->brands,
            'categories' => $this->categories,
        ]);
    }

    public function store(ProductCreateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['image'] = $this->fileService->upload('products', $request->image);

        $stripeProduct = $this->stripeService->createProduct($validatedData);

        if ($stripeProduct) {
            $validatedData['stripe_product_id'] = $stripeProduct['product_id'];
            $validatedData['stripe_price_id'] = $stripeProduct['price_id'];
        }

        Product::create($validatedData);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created succesfully');
    }

    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
            'brands' => $this->brands,
            'categories' => $this->categories,
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['price'] = (float) $validatedData['price'];

        if ($request->has('image')) {
            $validatedData['image'] = $this->fileService->upload('products', $request->image);
        }

        $validatedData['stripe_price_id'] = $this->stripeService->updateProduct($product, $validatedData);

        $product->update($validatedData);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated succesfully');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) $this->fileService->delete($product->image);
        $product->delete();
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted succesfully');
    }

    public function search(Request $request): View
    {
        return view('admin.products.index', [
            'products' => $this->searchTemplate($request, Product::class),
            'categories' => $this->categories,
            'brands' => $this->brands
        ]);
    }
}
