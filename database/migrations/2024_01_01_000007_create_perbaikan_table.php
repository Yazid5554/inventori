<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')
                  ->constrained('barang', 'id')
                  ->cascadeOnDelete();
            $table->foreignId('id_pengguna')
                  ->constrained('users', 'id')
                  ->restrictOnDelete();
            $table->date('tanggal_perbaikan');
            $table->text('deskripsi_kerusakan');
            $table->text('tindakan')->nullable();
            $table->enum('status', [
                'menunggu',
                'sedang_diperbaiki',
                'selesai',
                'tidak_bisa_diperbaiki'
            ])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perbaikan');
    }
};
