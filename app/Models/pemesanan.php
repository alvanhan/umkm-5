<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    protected $fillable = [
        'nama_lengkap',
        'metode_pembayaran',
        'no_telepon',
        'alamat_lengkap',
        'total_pembayaran',
        'status_pesanan',
        'pesanan',
        'callback_payment'
    ];
}
