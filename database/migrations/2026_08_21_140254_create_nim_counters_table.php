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
        Schema::create('nim_counters', function (Blueprint $table) {
            $table->id();
            $table->char('tahun', 4);
            $table->string('kode_prodi', 10);
            $table->unsignedInteger('last_count')->default(0);
            $table->unique(['tahun', 'kode_prodi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nim_counters');
    }
};
