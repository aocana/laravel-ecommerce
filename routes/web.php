<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|---------------
| Web Routes
|---------------
*/

Route::get('/', function () {
    return view('home.index');
})->name('home') ;

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
