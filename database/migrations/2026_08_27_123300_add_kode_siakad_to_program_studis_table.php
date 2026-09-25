<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('program_studis', function (Blueprint $table) {
            if (!Schema::hasColumn('program_studis', 'kode_siakad')) {
                $table->string('kode_siakad', 50)->nullable()->after('kode_dikti');
            }
        });

        // Set default kode_siakad untuk data awal
        DB::table('program_studis')->where('nama_prodi', 'S1 Farmasi')->update(['kode_siakad' => '48201']);
        DB::table('program_studis')->where('nama_prodi', 'S1 Gizi')->update(['kode_siakad' => '51201']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program_studis', function (Blueprint $table) {
            $table->dropColumn('kode_siakad');
        });
    }
};
