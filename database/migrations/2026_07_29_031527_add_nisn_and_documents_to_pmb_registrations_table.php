<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pmb_registrations', function (Blueprint $table) {
            $table->string('nisn')->nullable()->after('nik');
            $table->string('npsn')->nullable()->after('nisn');
            $table->string('raport_path')->nullable()->after('pas_foto_path');
            $table->string('ijazah_path')->nullable()->after('raport_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pmb_registrations', function (Blueprint $table) {
            $table->dropColumn(['nisn', 'npsn', 'raport_path', 'ijazah_path']);
        });
    }
};
