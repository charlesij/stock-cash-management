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
        Schema::create('akun_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('akun_id')->unsigned();
            $table->string('kode_transaksi');
            $table->date('tanggal');
            $table->decimal('saldo', 15)->default(0);
            $table->timestamps();

            $table->foreign('akun_id')->references('id')->on('akun')
            ->onDelete('restrict') 
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_detail');
    }
};
