<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saldo_kas_id')->constrained('saldo_kas');
            $table->string('jenis_transaksi');
            $table->string('keterangan');
            $table->decimal('cash_in', 15, 0);
            $table->decimal('cash_out', 15, 0);
            $table->decimal('current_saldo', 15, 0);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('transaksi_kas');
    }
};
