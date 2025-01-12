<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daerah_produk extends Model
{
    use HasFactory;

    protected $table = 'daerah_produk';

    protected $fillable = [
        'nama_daerah'
    ];
}
