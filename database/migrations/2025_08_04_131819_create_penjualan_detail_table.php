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
        Schema::create('penjualan_detial', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('penjualan_id')->unsigned();
            $table->text('deskripsi');
            $table->bigInteger('kuantitas')->default(0);
            $table->bigInteger('satuan_id')->unsigned();
            $table->decimal('harga_satuan', 15)->unsigned()->default(0);
            $table->decimal('diskon', 15)->default(0);
            $table->bigInteger('pajak')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('satuan_id')->references('id')->on('satuan')
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
