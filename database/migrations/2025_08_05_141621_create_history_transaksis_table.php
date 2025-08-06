<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saldo_kas_id')->constrained('saldo_kas');
            $table->decimal('cash_in', 15, 0)->default(0);
            $table->decimal('cash_out', 15, 0)->default(0);
            $table->decimal('hutang_in', 15, 0)->default(0);
            $table->decimal('hutang_out', 15, 0)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_transaksis');
    }
};
