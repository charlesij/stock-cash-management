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
        Schema::create('produk_master', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('satuan_id'); // unit
            $table->string('nama');
            $table->decimal('harga_beli', 15, 0)->default(0);
            $table->timestamps();

            $table->foreign('satuan_id')->references('id')->on('satuan')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_master');
    }
};
