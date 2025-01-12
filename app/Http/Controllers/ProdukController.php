<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\kategori_produk;
use App\Models\daerah_produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = produk::all();
        return view('page.admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori_produk::all();
        $daerah = daerah_produk::all();
        return view('page.admin.produk.create', compact('kategori', 'daerah'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $imageNames = [];

        if (produk::where('nama', $data['nama'])
            ->where('kategori_id', $data['kategori_id'])
            ->where('daerah_id', $data['daerah_id'])
            ->exists()
        ) {
            return redirect()->back()->withErrors(['error' => 'Produk telah tersedia']);
        }

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->storeAs('public/produk', $imageName);
                $imageNames[] = '/storage/produk/' . $imageName;
            }
        }
        $data['gambar'] = $imageNames;
        produk::create($data);
        return redirect()->route('produk.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = produk::find($id);
        $kategori = kategori_produk::all();
        $daerah = daerah_produk::all();
        return view('page.admin.produk.edit', compact('produk', 'kategori', 'daerah'));
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
        $data = $request->all();
        $produk = produk::find($id);
        $imageNames = $produk->gambar;

        if (produk::where('nama', $data['nama'])
            ->where('kategori_id', $data['kategori_id'])
            ->where('daerah_id', $data['daerah_id'])
            ->where('id', '!=', $id)
            ->exists()
        ) {
            return redirect()->back()->withErrors(['error' => 'Produk telah tersedia']);
        }

        if ($request->hasFile('gambar')) {
            $imageNames = [];
            foreach ($request->file('gambar') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->storeAs('public/produk', $imageName);
                $imageNames[] = '/storage/produk/' . $imageName;
            }
            $data['gambar'] = $imageNames;
        } else {
            $data['gambar'] = $produk->gambar;
        }

        $produk->update($data);
        return redirect()->route('produk.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk  = produk::destroy($id);
        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Data tidak ditemukan');
        }
        return redirect()->route('produk.index')->with('success', 'Data berhasil dihapus');
    }


    public function status($id, $status)
    {
        $produk = produk::find($id);
        $produk->status = $status;
        $produk->save();
        return redirect()->route('produk.index')->with('success', 'Status berhasil diperbarui');
    }
}
