<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
<<<<<<< HEAD:database/migrations/2025_08_04_131713_create_supplier_table.php
            $table->decimal('debt', 15, 0)->default(0);
=======
            $table->decimal('hutang', 15,0)->nullable();
            $table->enum('jenis', ['customer', 'supplier']);
>>>>>>> 2266788db5fcd01619cf82e9febfff76d515b30a:database/migrations/2025_08_04_131713_create_kontak_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontak');
    }
};
