<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_stok_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk');
            $table->integer('qty_in')->default(0);
            $table->integer('qty_out')->default(0);
            $table->string('unit');
            $table->string('harga_unit');
            $table->integer('sisa_stok');
            $table->decimal('total_harga', 15, 0);
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_stok_produk');
    }
};
