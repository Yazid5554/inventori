<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lokasi', function (Blueprint $table) {
            $table->string('gedung', 10)->nullable()->after('nama');
            $table->string('lantai', 10)->nullable()->after('gedung');
        });
    }

    public function down(): void
    {
        Schema::table('lokasi', function (Blueprint $table) {
            $table->dropColumn(['gedung', 'lantai']);
        });
    }
};