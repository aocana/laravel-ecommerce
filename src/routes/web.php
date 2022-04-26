<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\CategoryController;


//shop
Route::get('/', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('shop.detail');
Route::get('/search', [ProductController::class, 'search'])->name('shop.search');

//categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');


//orders
Route::get('/orders', [OrderController::class, 'index'])->middleware(['auth'])->name('orders.index');
Route::get('/orders/search', [OrderController::class, 'search'])->middleware(['auth'])->name('orders.search');
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware(['auth'])->name('orders.show');


//profile
Route::get('/profile', [UserController::class, 'index'])->middleware(['auth'])->name('profile.index');
Route::get('/profile/{user:id}/edit', [UserController::class, 'edit'])->middleware(['auth'])->name('profile.edit');
Route::put('/profile/{user:id}', [UserController::class, 'update'])->middleware(['auth'])->name('profile.update');
Route::get('/profile/change-password', [UserController::class, 'changePassword'])->middleware(['auth'])->name('profile.change-password');
Route::post('/profile/change-password', [UserController::class, 'newPassword'])->middleware(['auth'])->name('profile.new-password');


//cart
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth'])->name('cart.index');
Route::get('/cart/remove', [CartController::class, 'removeCart']);
Route::get('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/delete/{product}', [CartController::class, 'deleteFromCart'])->name('cart.delete');
Route::post('/cart', [CartController::class, 'checkout'])->middleware(['auth'])->name('cart.checkout');


//stripe webhook
Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);

require __DIR__ . '/auth.php';
