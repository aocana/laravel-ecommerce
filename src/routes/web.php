<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;

/*
|---------------
| Web Routes
|---------------
*/

Route::get('/', function () {
    return view('home.index');
})->name('home');

//shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/search', [ShopController::class, 'search'])->name('shop.search');

//cart
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth'])->name('cart.index');
Route::post('/cart', [CartController::class, 'checkout'])->middleware(['auth'])->name('cart.checkout');
Route::get('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');

//stripe webhook
Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::prefix('p4dmin')->name('admin.')->group(function () {
    Route::get('/', AdminController::class)
        ->name('index');
    /*->middleware('auth', 'role:admin');*/

    Route::resource('/products', ProductController::class);
    /*->middleware('auth', 'role:admin');*/

    Route::resource('/categories', CategoryController::class)
        ->except(['show']);
    /*->middleware('auth', 'role:admin');*/
    Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');

    Route::resource('/brands', BrandController::class)
        ->except(['show']);
    Route::get('/brands/search', [BrandController::class, 'search'])->name('brands.search');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.index');
    Route::put('/orders/{order}', [OrderController::class, 'edit'])->name('orders.update');
});



require __DIR__ . '/auth.php';
