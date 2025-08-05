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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned();
            $table->string('kode');
            $table->date('tanggal');
            $table->string('jenis_pembayaran'); //cash / hutang
            $table->string('status'); //lunas, belum lunas
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customer')
             ->onDelete('restrict') 
             ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
