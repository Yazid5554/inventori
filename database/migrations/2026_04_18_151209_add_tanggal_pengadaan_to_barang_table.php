<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->date('tanggal_pengadaan')->nullable()->after('tahun_pengadaan');
        });
    }

    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('tanggal_pengadaan');
        });
    }
};  