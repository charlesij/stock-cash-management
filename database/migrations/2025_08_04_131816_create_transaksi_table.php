<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kontak_id')->unsigned(); 
            $table->string('kode')->index();
            $table->date('tanggal');
            $table->enum('tipe', ['pembelian', 'penjualan']); // 1 = pembelian, 2 = penjualan
            $table->enum('jenis_bayar', ['cash', 'hutang']); //1 = cash /  2 = hutang
            $table->enum('status', ['lunas', 'belum_lunas']); //1 = lunas, 2 = belum lunas
            $table->timestamps();

            $table->foreign('kontak_id')->references('id')->on('kontak')
             ->onDelete('restrict') 
             ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
