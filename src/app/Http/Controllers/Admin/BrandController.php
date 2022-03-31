<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\View\View;
use App\Services\FileService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Brand\BrandCreateRequest;
use App\Http\Requests\Brand\BrandUpdateRequest;

class BrandController extends Controller
{
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index(): View
    {
        $brands = Brand::paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create(): View
    {
        return view('admin.brands.create');
    }

    public function store(BrandCreateRequest $request): RedirectResponse
    {
        $this->createModel(Brand::class, 'create', 'brands');
        return redirect()
            ->route('admin.brands.index')
            ->with('succes', 'Brand created succesfully');
    }

    public function edit(Brand $brand): View
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(BrandUpdateRequest $request, Brand $brand): RedirectResponse
    {
        $this->updateModel($brand, 'update', 'brands');
        return redirect()
            ->route('admin.brands.index')
            ->with('succes', 'Brand updated succesfully');
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        if ($brand->image) $this->fileService->delete($brand->image);

        $brand->delete();
        return redirect()
            ->route('admin.brands.index')
            ->with('succes', 'Brand deleted succesfullly');
    }
}
