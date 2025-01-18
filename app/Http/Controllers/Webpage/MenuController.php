<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\daerah_produk;
use App\Models\kategori_produk;
use App\Models\produk;
class MenuController extends Controller
{

    function menu() {

        $daerah = daerah_produk::all();
        $kategori = kategori_produk::all();
        $produk = produk::all();
        return view('frontend.index', compact('daerah', 'kategori', 'produk'));

    }
}
