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
        Schema::create('akun', function (Blueprint $table) {
            $table->id();
            $table->string('kode'); // kas(1), hpp(2), hutang(3), pendapatan(4), biaya(5)
            $table->string('nama'); // kas(debit), hpp(debit), hutang(kredit), pendapatan(kredit), biaya(debit)
            $table->integer('jenis')->default(1); // 1= debit, 2=kredit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun ');
    }
};
