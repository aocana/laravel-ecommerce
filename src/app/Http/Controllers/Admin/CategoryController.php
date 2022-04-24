<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;

class CategoryController extends Controller
{

    public function index(): View
    {
        $categories = Category::latest()->paginate(20);
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
            ->with('success', 'Category created succesfully');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $this->updateModel($category, 'update', 'categories');

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated succesfully');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted succesfully');
    }

    public function search(Request $request)
    {
        return view('admin.categories.index', [
            'categories' => $this->searchTemplate($request, Category::class)
        ]);
    }
}
