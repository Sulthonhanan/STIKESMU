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
        Schema::create('pmb_fees', function (Blueprint $table) {
            $table->id();
            $table->string('prodi');
            $table->string('gelombang');
            $table->unsignedBigInteger('biaya_registrasi')->default(0);
            $table->unsignedBigInteger('ukt_semester_1')->default(0);
            $table->unsignedBigInteger('jas_almamater')->default(0);
            $table->unsignedBigInteger('osmb')->default(0);
            $table->unsignedBigInteger('ktm')->default(0);
            $table->timestamps();

            $table->unique(['prodi', 'gelombang']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmb_fees');
    }
};
