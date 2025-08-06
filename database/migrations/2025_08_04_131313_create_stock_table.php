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
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_pembelian', ['cash', 'hutang']);
            $table->bigInteger('supplier_id')->unsigned();
            $table->string('nama');
            $table->decimal('harga_beli', 15)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('supplier')
             ->onDelete('restrict') 
             ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
