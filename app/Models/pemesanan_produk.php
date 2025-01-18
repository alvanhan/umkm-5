<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan_produk extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_produk';
    protected $fillable = ['pemesanan_id', 'produk_id', 'jumlah', 'total_harga'];

    public function produk()
    {
        return $this->belongsTo(produk::class, 'produk_id', 'id');
    }
}
