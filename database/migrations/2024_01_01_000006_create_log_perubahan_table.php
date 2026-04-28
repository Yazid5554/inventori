<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_perubahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')
                  ->constrained('barang', 'id')
                  ->cascadeOnDelete();
            $table->foreignId('id_pengguna')
                  ->constrained('users', 'id')
                  ->restrictOnDelete();
            $table->enum('jenis_kejadian', [
                'ditambahkan',
                'diubah',
                'dihapus',
                'kondisi_diubah',
                'komponen_diubah'
            ]);
            $table->text('deskripsi');
            $table->string('nilai_lama')->nullable();
            $table->string('nilai_baru')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_perubahan');
    }
};
