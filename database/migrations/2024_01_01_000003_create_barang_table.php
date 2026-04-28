<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor_barang')->unique();
            $table->string('nomor_inventaris')->unique();
            $table->string('jenis_barang');
            $table->year('tahun_pengadaan');
            $table->foreignId('id_lokasi')
                  ->constrained('lokasi', 'id')
                  ->restrictOnDelete();
            $table->string('foto')->nullable();
            $table->string('qr_code')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
