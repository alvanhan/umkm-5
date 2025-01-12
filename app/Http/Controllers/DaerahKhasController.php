<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\daerah_produk;

class DaerahKhasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daerah = daerah_produk::all();
        return view('page.admin.produk.wilayah.index', compact('daerah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.admin.produk.wilayah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $check = daerah_produk::where('nama_daerah', $request->nama_daerah)->first();
        if ($check) {
            return redirect()->back()->with('error', 'Daerah sudah ada');
        }
        daerah_produk::create($request->all());
        return redirect()->route('daerah.index')->with('success', 'Daerah berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $daerah = daerah_produk::find($id);
        return view('page.admin.produk.wilayah.edit', compact('daerah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $daerah = daerah_produk::find($id);
        $daerah->update($request->all());
        return redirect()->route('daerah.index')->with('success', 'Daerah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        daerah_produk::find($id)->delete();
        return redirect()->route('daerah.index')->with('success', 'Daerah berhasil dihapus');
    }
}
