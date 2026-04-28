<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komponen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')
                  ->constrained('barang', 'id')
                  ->cascadeOnDelete();
            $table->enum('jenis_komponen', [
                'processor',
                'ram',
                'storage',
                'gpu',
                'monitor',
                'keyboard',
                'mouse',
                'lainnya'
            ]);
            $table->string('spesifikasi');
            $table->enum('kondisi', [
                'baik',
                'rusak_ringan',
                'rusak_berat'
            ])->default('baik');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komponen');
    }
};
