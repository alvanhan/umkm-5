<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id')->default(0);
            $table->unsignedBigInteger('produk_id')->default(0);
            $table->integer('jumlah')->default(0);
            $table->integer('total_harga')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_pemesanan_produk');
    }
};
