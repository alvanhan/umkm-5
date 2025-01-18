<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\daerah_produk;
use App\Models\kategori_produk;
use App\Models\produk;
use App\Models\pemesanan_produk;
use App\Models\pemesanan;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Hashids\Hashids;

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

        $produk = $query->where('status', 1)->where('stok', '>', 0)->get();
        return view('frontend.ajax.produk', compact('produk'));
    }


    function checkout(Request $request)
    {
        $produk = produk::find($request->id);
        return view('frontend.checkout', compact('produk'));
    }

    function getProdukCheck(Request $request)
    {
        $idArray = array_map('intval', $request->id);
        $produk = produk::whereIn('id', $idArray)->select('id', 'nama', 'harga', 'stok')->get();
        return response()->json($produk);
    }


    function prosesPesanan(Request $request)
    {
        $pemesanan = new pemesanan();
        $pemesanan->nama_lengkap = $request->nama_lengkap;
        $pemesanan->no_telepon = $request->no_telepon;
        $pemesanan->alamat_lengkap = $request->alamat_lengkap;
        $pemesanan->pesanan = json_encode($request->pesanan);
        $pemesanan->metode_pembayaran = $request->metode_pembayaran;
        $pemesanan->save();
        $totalPembayaran = 0;
        foreach ($request->pesanan as $key => $value) {
            $produk = produk::find($value['id']);
            $produk->stok = $produk->stok - $value['jumlah'];
            $produk->save();
            $pemesananProduk = new pemesanan_produk();
            $pemesananProduk->pemesanan_id = $pemesanan->id;
            $pemesananProduk->produk_id = $value['id'];
            $pemesananProduk->jumlah = $value['jumlah'];
            $pemesananProduk->total_harga = $value['jumlah'] * $produk->harga;
            $pemesananProduk->save();
            $totalPembayaran += $pemesananProduk->total_harga;
        }
        $pemesanan->total_pembayaran = $totalPembayaran;
        $pemesanan->save();


        if ($pemesanan->metode_pembayaran == 'cod') {
            $pemesanan->status = 'proses';
            $pemesanan->save();
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'type' => $pemesanan->metode_pembayaran,
                'data' => route('menu.index'),
            ]);
        }

        $hashids = new Hashids('', 8);
        $client = new Client();
        $url = 'https://api.xendit.co/v2/invoices';
        $headers = [
            'Authorization' => 'Basic ' . base64_encode(env("XENDIT_SECRET_KEY")),
            'Content-Type' => 'application/json',
        ];
        $body = [
            "external_id" => $hashids->encode($pemesanan->id),
            "amount" => $pemesanan->total_pembayaran,
            "description" => "Pembayaran Pemesanan ". $pemesanan->nama_lengkap,
            "invoice_duration" => 86400,
            "success_redirect_url" => route('menu.index'),
            "failure_redirect_url" => route('menu.index'),
            "currency" => "IDR",
            "payment_methods" => ["BCA", "BNI", "BRI", "MANDIRI", "PERMATA"],
        ];

        try {
            $response = $client->post($url, [
                'headers' => $headers,
                'json' => $body,
            ]);
            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody()->getContents(), true);
            return response()->json([
                'status' => 'success',
                'code' => $statusCode,
                'type' => $pemesanan->metode_pembayaran,
                'data' => $responseBody['invoice_url'],
            ]);
        } catch (RequestException $e) {
            $errorResponse = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => $errorResponse,
            ], $e->getCode() ?: 500);
        }
    }

    function callbackBayar(Request $request)
    {
        $id = $request->external_id;
        $hashids = new Hashids('', 8);
        $id = $hashids->decode($id)[0];
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Pemesanan tidak ditemukan',
            ]);
        }
        $pemesanan = pemesanan::find($id);
        if (!$pemesanan) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Pemesanan tidak ditemukan',
            ]);
        }
        $pemesanan->status_pesanan = $request->status == 'PAID' ? 'proses' : 'menunggu pembayaran';
        $pemesanan->callback_payment = json_encode($request->all());
        $pemesanan->save();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'data' => $id,
        ]);
    }
}
