<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            // Tambah kode_barang
            $table->string('kode_barang', 50)->nullable()->after('nama');
            
            // Ubah nomor_inventaris jadi auto-generated (nullable dulu)
            $table->string('nomor_inventaris', 100)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('kode_barang');
        });
    }
};