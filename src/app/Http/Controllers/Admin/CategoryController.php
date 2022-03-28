<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\FileService;

class CategoryController extends Controller
{
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index(): View
    {
        $categories = Category::paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(CategoryCreateRequest $request): RedirectResponse
    {
        $this->createModel(Category::class, 'create', 'categories');

        return redirect()
            ->route('admin.categories.index')
            ->with('succes', 'Category created succesfully');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $image = $request->hasFile('image')
            ? $this->fileService->upload('categories', $request->image)
            : null;

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $image,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('succes', 'Category updated succesfully');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()
            ->route('admin.categories.index')
            ->with('succes', 'Category deleted succesfully');
    }
}
