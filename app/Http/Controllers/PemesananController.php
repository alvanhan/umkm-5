<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\pemesanan_produk;
use App\Models\pemesanan;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanan = pemesanan::all();
        return view('page.admin.pesanan.index', compact('pemesanan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemesanan = pemesanan::find($id);
        return view('page.admin.pesanan.show', compact('pemesanan'));
    }


    public function status(Request $request, $id)
    {
        $pemesanan = pemesanan::find($id);
        $pemesanan->status_pesanan = $request->status_pesanan;
        $pemesanan->save();
        return redirect()->route('pemesanan.index')->with('success', 'Status Pesanan Berhasil Diubah');
    }

}
