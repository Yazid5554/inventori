<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_kondisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')
                  ->constrained('barang', 'id')
                  ->cascadeOnDelete();
            $table->foreignId('id_pengguna')
                  ->constrained('users', 'id')
                  ->restrictOnDelete();
            $table->enum('kondisi', [
                'baik',
                'rusak_ringan',
                'rusak_berat',
                'dalam_perbaikan',
                'tidak_layak_pakai'
            ]);
            $table->text('catatan')->nullable();
            $table->date('tanggal_pencatatan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_kondisi');
    }
};
