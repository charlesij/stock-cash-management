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
        Schema::create('produk_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('produk_id')->unsigned();
            $table->bigInteger('satuan_id')->unsigned();
            $table->bigInteger('quantity')->default(0);
            $table->decimal('harga_jual', 15)->default(0);

            $table->timestamps();

             $table->foreign('produk_id')->references('id')->on('produk')
             ->onDelete('restrict') 
             ->onUpdate('cascade');

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
        Schema::dropIfExists('produk_detail');
    }
};
