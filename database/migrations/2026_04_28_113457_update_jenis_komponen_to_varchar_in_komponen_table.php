<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE komponen MODIFY jenis_komponen VARCHAR(100) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE komponen MODIFY jenis_komponen ENUM('processor','ram','storage','gpu','monitor','keyboard','mouse','lainnya') NOT NULL");
    }
};
