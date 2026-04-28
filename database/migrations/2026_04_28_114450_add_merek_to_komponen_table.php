<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('komponen', function (Blueprint $table) {
            $table->string('merek', 100)->nullable()->after('jenis_komponen');
        });
    }

    public function down(): void
    {
        Schema::table('komponen', function (Blueprint $table) {
            $table->dropColumn('merek');
        });
    }
};
