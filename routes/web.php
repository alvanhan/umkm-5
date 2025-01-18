<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Webpage\IndexController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DaerahKhasController;

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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/produk_list', [IndexController::class, 'getProduk'])->name('index.getProduk');
Route::get('/', [IndexController::class, 'index'])->name('menu.index');
Route::get('/konfirmasi-pesanan', [IndexController::class, 'checkout'])->name('index.checkout');





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

Route::group(['prefix' => 'dashboard/kategori', 'middleware' => 'auth'], function () {
    Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/create', [kategoriController::class, 'create'])->name('kategori.create');
    Route::post('/store', [kategoriController::class, 'store'])->name('kategori.store');
    Route::get('/edit/{id}', [kategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('/update/{id}', [kategoriController::class, 'update'])->name('kategori.update');
    Route::post('/destroy/{id}', [kategoriController::class, 'destroy'])->name('kategori.destroy');
});


Route::group(['prefix' => 'dashboard/daerah', 'middleware' => 'auth'], function () {
    Route::get('/', [DaerahKhasController::class, 'index'])->name('daerah.index');
    Route::get('/create', [DaerahKhasController::class, 'create'])->name('daerah.create');
    Route::post('/store', [DaerahKhasController::class, 'store'])->name('daerah.store');
    Route::get('/edit/{id}', [DaerahKhasController::class, 'edit'])->name('daerah.edit');
    Route::post('/update/{id}', [DaerahKhasController::class, 'update'])->name('daerah.update');
    Route::post('/destroy/{id}', [DaerahKhasController::class, 'destroy'])->name('daerah.destroy');
});
