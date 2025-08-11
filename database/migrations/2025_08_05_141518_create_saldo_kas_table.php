<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saldo_kas', function (Blueprint $table) {
            $table->id();
            $table->decimal('cash', 15, 0)->default(0);
            $table->decimal('hutang', 15, 0)->default(0);
            $table->date('date')->unique(); // month and year only (YYYY-MM-01) always use the date 1
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saldo_kas');
    }
};
