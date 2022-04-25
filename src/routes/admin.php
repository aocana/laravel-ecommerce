<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;


// Home
Route::get('/', AdminController::class)->name('index');

// Products
Route::resource('/products', AdminProductController::class);
Route::get('/producs/search', [AdminProductController::class, 'search'])->name('products.search');

// Categories 
Route::resource('/categories', CategoryController::class)->except(['show']);
Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');

// Brands 
Route::resource('/brands', BrandController::class)->except(['show']);
Route::get('/brands/search', [BrandController::class, 'search'])->name('brands.search');


// Orders 
Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{order}', [AdminOrderController::class, 'edit'])->name('orders.update');
