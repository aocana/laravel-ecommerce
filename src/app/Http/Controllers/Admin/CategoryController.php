<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());
        return redirect()
            ->route('admin.categories.index')
            ->with('succes', 'Category created succesfully');
    }

    public function edit(Category $category): View
    {
        $category = Category::findOrFail($category->id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $category = Category::findOrFail($category->id);
        $category->update($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('succes', 'Category updated succesfully');
    }

    public function destroy(Category $category): RedirectResponse
    {
        Category::destroy($category->id);
        return redirect()
            ->route('admin.categories.index')
            ->with('succes', 'Category deleted succesfully');
    }
}
