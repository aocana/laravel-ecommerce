<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
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

    public function edit(Category $id)
    {
        $category = Category::findOrFail($id);
        dd($category);
        return view('admin.categories.form', compact('category'));
    }

    public function update(CategoryRequest $request, Category $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('succes', 'Category updated succesfully');
    }

    public function destroy(Category $id): RedirectResponse
    {
        Category::destroy($id);
        return redirect()
            ->route('admin.categories.index')
            ->with('succes', 'Category deleted succesfully');
    }
}
