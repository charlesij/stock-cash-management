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
        Schema::create('tipe_akun', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama'); // kas, hpp, hutang, pendapatan, biaya
            $table->integer('jenis')->default(1); // 1= debit, 2=kredit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_akun');
    }
};
