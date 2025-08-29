<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('satuan_produk_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('produk_id');
            $table->bigInteger('satuan_produk_id');
            $table->integer('');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('satuan_produk_settings');
    }
};
