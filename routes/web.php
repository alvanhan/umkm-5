<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Webpage\MenuController;
use App\Http\Controllers\ProdukController;

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

Route::get('/', [MenuController::class, 'menu'])->name('index');
Route::group(['prefix' => 'menu'], function () {
    Route::get('/', [MenuController::class, 'menu'])->name('menu.index');
});




Auth::routes();
Route::group(['prefix' => 'dashboard/admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::group(['prefix' => 'dashboard/produk', 'middleware' => 'auth'], function () {
    Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('/destroy/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/status/{id}/{status}', [ProdukController::class, 'status'])->name('produk.status');
});
