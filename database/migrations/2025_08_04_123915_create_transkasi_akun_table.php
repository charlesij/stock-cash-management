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
        Schema::create('trans_akun', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sub_akun_id')->unsigned();
            $table->string('transaksi_code')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tanggal');
            $table->decimal('debit', 15)->default(0);
            $table->decimal('kredit', 15)->default(0);
            $table->decimal('total', 15)->default(0);
            $table->timestamps();

            $table->foreign('sub_akun_id')->references('id')->on('sub_akun')
            ->onDelete('restrict') 
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trans_akun');
    }
};
