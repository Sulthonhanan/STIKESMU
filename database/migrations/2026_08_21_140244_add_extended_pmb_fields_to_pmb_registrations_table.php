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
            $table->boolean('sia_account_created')->default(false)->after('status');
            $table->timestamp('tgl_lulus_seleksi')->nullable()->after('sia_account_created');
            $table->timestamp('tgl_verifikasi_pembayaran')->nullable()->after('tgl_lulus_seleksi');
            $table->string('nim', 30)->nullable()->after('tgl_verifikasi_pembayaran');

            $table->string('jenis_beasiswa')->nullable()->after('jalur_seleksi');
            $table->string('link_berkas_beasiswa')->nullable()->after('jenis_beasiswa');

            $table->decimal('utbk_pu', 6, 2)->nullable()->after('link_berkas_beasiswa');
            $table->decimal('utbk_ppu', 6, 2)->nullable()->after('utbk_pu');
            $table->decimal('utbk_pbm', 6, 2)->nullable()->after('utbk_ppu');
            $table->decimal('utbk_pk', 6, 2)->nullable()->after('utbk_pbm');
            $table->decimal('utbk_lbid', 6, 2)->nullable()->after('utbk_pk');
            $table->decimal('utbk_lbing', 6, 2)->nullable()->after('utbk_lbid');
            $table->decimal('utbk_pm', 6, 2)->nullable()->after('utbk_lbing');
            $table->string('link_sertifikat_utbk')->nullable()->after('utbk_pm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pmb_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'sia_account_created',
                'tgl_lulus_seleksi',
                'tgl_verifikasi_pembayaran',
                'nim',
                'jenis_beasiswa',
                'link_berkas_beasiswa',
                'utbk_pu',
                'utbk_ppu',
                'utbk_pbm',
                'utbk_pk',
                'utbk_lbid',
                'utbk_lbing',
                'utbk_pm',
                'link_sertifikat_utbk',
            ]);
        });
    }
};
