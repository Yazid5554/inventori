<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kerusakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')
                  ->constrained('barang', 'id')
                  ->cascadeOnDelete();
            $table->foreignId('id_pengguna')
                  ->constrained('users', 'id')
                  ->restrictOnDelete();
            $table->date('tanggal_kerusakan');
            $table->text('deskripsi');
            $table->enum('tingkat_kerusakan', [
                'ringan',
                'sedang',
                'parah'
            ]);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerusakan');
    }
};
