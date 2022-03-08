<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|---------------
| Web Routes
|---------------
*/

Route::get('/', function () {
    return view('home.index');
})->name('home') ;

//shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index') ;

//cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index') ;
Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add') ;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');




/*
 |-----------------
 | Admin Routes
 |-----------------
 */
Route::prefix('p4dmin')->group(  function () {
    Route::get('/', AdminController::class)
        ->name('admin.index');
        /*->middleware('auth', 'role:admin');*/

    Route::resource('/products', ProductController::class);
        /*->middleware('auth', 'role:admin');*/

    Route::resource('/categories', CategoryController::class);
        /*->middleware('auth', 'role:admin');*/
});



require __DIR__.'/auth.php';
