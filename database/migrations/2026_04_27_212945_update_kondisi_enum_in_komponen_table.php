<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE komponen MODIFY kondisi ENUM('baik','rusak') NOT NULL DEFAULT 'baik'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE komponen MODIFY kondisi ENUM('baik','rusak_ringan','rusak_berat') NOT NULL DEFAULT 'baik'");
    }
};
