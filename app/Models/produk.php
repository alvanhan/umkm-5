<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'kategori_id',
        'daerah_id',
        'stok',
        'gambar'
    ];

    protected $casts = [
        'gambar' => 'array',
    ];

    public function kategori()
    {
        return $this->belongsTo(kategori_produk::class, 'kategori_id', 'id');
    }

    public function daerah()
    {
        return $this->belongsTo(daerah_produk::class, 'daerah_id', 'id');
    }

}
