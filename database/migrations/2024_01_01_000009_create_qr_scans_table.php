<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_scans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')
                  ->constrained('barang', 'id')
                  ->cascadeOnDelete();
            $table->string('scanned_by_ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('scanned_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_scans');
    }
};
