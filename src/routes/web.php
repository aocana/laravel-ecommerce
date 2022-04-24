<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;


Route::get('/', function () {
    return view('home.index');
})->name('home');


//shop
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/search', [ProductController::class, 'search'])->name('shop.search');


//orders
Route::get('/orders', [OrderController::class, 'index'])->middleware(['auth'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware(['auth'])->name('orders.show');


//cart
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth'])->name('cart.index');
Route::post('/cart', [CartController::class, 'checkout'])->middleware(['auth'])->name('cart.checkout');
Route::get('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove', [CartController::class, 'removeCart']);
Route::get('/cart/delete/{product}', [CartController::class, 'deleteFromCart'])->name('cart.delete');


//stripe webhook
Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


/*
|---------------
| Admin Routes
|---------------
*/
Route::get('p4dmin/products/search', [AdminProductController::class, 'search'])->name('admin.products.search');
Route::prefix('p4dmin')->name('admin.')->group(function () {
    Route::get('/', AdminController::class)
        ->name('index');
    /*->middleware('auth', 'role:admin');*/

    Route::resource('/products', AdminProductController::class);
    /*->middleware('auth', 'role:admin');*/

    Route::resource('/categories', CategoryController::class)
        ->except(['show']);
    /*->middleware('auth', 'role:admin');*/
    Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');

    Route::resource('/brands', BrandController::class)
        ->except(['show']);
    Route::get('/brands/search', [BrandController::class, 'search'])->name('brands.search');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [AdminOrderController::class, 'edit'])->name('orders.update');
});



require __DIR__ . '/auth.php';
