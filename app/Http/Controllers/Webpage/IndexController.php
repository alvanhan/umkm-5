<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\daerah_produk;
use App\Models\kategori_produk;
use App\Models\produk;
class IndexController extends Controller
{
    function index() {

        return view('frontend.index');
    }
}
