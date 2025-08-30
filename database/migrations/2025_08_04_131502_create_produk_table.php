<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_master_id');
            $table->decimal('harga_beli', 15)->default(0);
            $table->string('metode_pembayaran');
            $table->string('data_supplier');
            $table->date('tanggal_barang_masuk');
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('produk_master_id')->references('id')->on('produk_master')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
