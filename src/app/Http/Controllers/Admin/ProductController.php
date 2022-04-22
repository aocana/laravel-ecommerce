<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CartController;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use App\Services\FileService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\Stripe\ProductsStripe;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

class ProductController extends Controller
{
    private FileService $fileService;
    private ProductsStripe $stripeService;

    public function __construct()
    {
        $this->fileService = new FileService();
        $this->stripeService = new ProductsStripe();
    }

    public function index(): View
    {
        $products = Product::paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function store(ProductCreateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['price'] = (float) $validatedData['price'];
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
        return view('admin.products.show', $product);
    }

    public function edit(Product $product): View
    {
        $brands = Brand::all();
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'brands', 'categories'));
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
}
