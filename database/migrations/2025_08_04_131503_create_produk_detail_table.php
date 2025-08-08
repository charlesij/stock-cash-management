<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('produk_id')->unsigned();
            $table->string('nama_satuan');
            $table->decimal('kuantitas', 15, 0)->default(0);
            $table->decimal('harga_jual', 15, 0)->default(0);

            $table->timestamps();

             $table->foreign('produk_id')->references('id')->on('produk')
             ->onDelete('restrict') 
             ->onUpdate('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('produk_detail');
    }
};
