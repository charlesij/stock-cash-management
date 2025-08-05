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
            $table->bigInteger('tipe_akun_id')->unsigned();
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();
            $table->foreign('tipe_akun_id')->references('id')->on('tipe_akun')
             ->onDelete('restrict') 
             ->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};
