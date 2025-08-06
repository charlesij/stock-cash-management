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
        Schema::create('sub_akun', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('akun_id')->unsigned();
            $table->string('kode'); // exp : 001
            $table->string('nama'); // exp : Kas Bank
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
        Schema::dropIfExists('sub_akun');
    }
};
