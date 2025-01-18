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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('no_telepon')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->integer('total_pembayaran')->default(0);
            $table->enum('status_pesanan', ['proses','mengunggu pembayaran', 'selesai'])->default('mengunggu pembayaran');
            $table->text('pesanan')->nullable();
            $table->text('callback_payment')->nullable();
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
        //
    }
};
