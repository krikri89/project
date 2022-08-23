<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RestaurantController as R;
use App\Http\Controllers\DishController as D;
use App\Http\Controllers\MenuController as M;
use App\Http\Controllers\FrontController as F;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Restaurant
Route::prefix('restaurants')->name('restaurants-')->group(
    function () {
        Route::get('/', [R::class, 'index'])->name('index')->middleware('roleblade:user');
        Route::get('/create', [R::class, 'create'])->name('create')->middleware('roleblade:admin');
        Route::post('', [R::class, 'store'])->name('store')->middleware('roleblade:admin');
        Route::get('/edit/{restaurant}', [R::class, 'edit'])->name('edit')->middleware('roleblade:admin');
        Route::put('/{restaurant}', [R::class, 'update'])->name('update')->middleware('roleblade:admin');
        Route::delete('/{restaurant}', [R::class, 'destroy'])->name('delete')->middleware('roleblade:admin');
        Route::get('/show/{id}', [R::class, 'show'])->name('show')->middleware('roleblade:user');
    }
);


//Menus
Route::prefix('menus')->name('menus-')->group(
    function () {
        Route::get('', [M::class, 'index'])->name('index')->middleware('roleblade:user');
        Route::get('/create', [M::class, 'create'])->name('create')->middleware('roleblade:admin');
        Route::post('', [M::class, 'store'])->name('store')->middleware('roleblade:admin');
        Route::get('/edit/{menu}', [M::class, 'edit'])->name('edit')->middleware('roleblade:admin');
        Route::put('/{menu}', [M::class, 'update'])->name('update')->middleware('roleblade:admin');
        Route::delete('/{menu}', [M::class, 'destroy'])->name('delete')->middleware('roleblade:admin');
        Route::get('/show/{id}', [M::class, 'show'])->name('show')->middleware('roleblade:user');
    }
);


//Dishes
Route::prefix('dishes')->name('dishes-')->group(
    function () {
        Route::get('', [D::class, 'index'])->name('index')->middleware('roleblade:user');
        Route::get('/create', [D::class, 'create'])->name('create')->middleware('roleblade:admin');
        Route::post('', [D::class, 'store'])->name('store')->middleware('roleblade:admin');
        Route::get('/edit/{dish}', [D::class, 'edit'])->name('edit')->middleware('roleblade:admin');
        Route::put('/{dish}', [D::class, 'update'])->name('update')->middleware('roleblade:admin');
        Route::delete('/{dish}', [D::class, 'destroy'])->name('delete')->middleware('roleblade:admin');
        Route::get('/show/{id}', [D::class, 'show'])->name('show')->middleware('roleblade:user');
        Route::put('/delete-pic/{dish}', [D::class, 'deletePic'])->name('delete-pic')->middleware('roleblade:admin');
    }
);

//front
Route::get('', [F::class, 'index'])->name('front-index')->middleware('roleblade:user');
Route::post('add-it-to-cart', [O::class, 'add'])->name('front-add')->middleware('roleblade:user');
Route::get('my-order', [O::class, 'showMyOrders'])->name('my-order')->middleware('roleblade:user');
Route::post('add-travel-to-the-cart', [Cart::class, 'add'])->name('front-add-cart')->middleware('roleblade:admin');
Route::get('my-small-cart', [Cart::class, 'showSmallCart'])->name('my-small-cart')->middleware('roleblade:admin');
Route::delete('my-small-cart', [Cart::class, 'deleteSmallCart'])->name('my-small-cart')->middleware('roleblade:admin');
//linkas tas pats bet method kitoks. 

// Orders
Route::prefix('orders')->name('orders-')->group(
    function () {
        Route::get('', [O::class, 'index'])->name('index')->middleware('roleblade:user');
        Route::put('status/{order}', [O::class, 'setStatus'])->name('status')->middleware('roleblade:admin');
    }
);
