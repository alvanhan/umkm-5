<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\daerah_produk;
use App\Models\kategori_produk;
use App\Models\produk;

class IndexController extends Controller
{
    function index()
    {
        $daerah = daerah_produk::all();
        $kategori = kategori_produk::all();
        $produk = produk::all();
        return view('frontend.index', compact('daerah', 'kategori', 'produk'));
    }

    function getProduk(Request $request)
    {
        $query = produk::query();

        if ($request->has('daerah') && !is_null($request->daerah)) {
            $query->where('daerah_id', decrypt($request->daerah));
        }

        if ($request->has('kategori') && !is_null($request->kategori)) {
            $query->where('kategori_id', decrypt($request->kategori));
        }

        if ($request->has('search') && !is_null($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $produk = $query->get();
        return view('frontend.ajax.produk', compact('produk'));
    }
}
