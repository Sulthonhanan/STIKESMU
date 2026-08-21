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
            $table->string('foto_bukti_cicilan_1')->nullable()->after('status');
            $table->string('foto_bukti_cicilan_2')->nullable()->after('foto_bukti_cicilan_1');
            $table->bigInteger('nominal_cicilan_1')->nullable()->after('foto_bukti_cicilan_2');
            $table->bigInteger('nominal_cicilan_2')->nullable()->after('nominal_cicilan_1');
            $table->date('tanggal_bayar_cicilan_1')->nullable()->after('nominal_cicilan_2');
            $table->date('tanggal_bayar_cicilan_2')->nullable()->after('tanggal_bayar_cicilan_1');
            $table->enum('status_pembayaran_daftar_ulang', [
                'Belum Bayar',
                'Menunggu Verifikasi Cicilan 1',
                'Cicilan 1 Lunas',
                'Menunggu Verifikasi Cicilan 2',
                'Lunas Total',
                'Ditolak'
            ])->default('Belum Bayar')->after('tanggal_bayar_cicilan_2');
            $table->text('catatan_pembayaran')->nullable()->after('status_pembayaran_daftar_ulang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pmb_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'foto_bukti_cicilan_1',
                'foto_bukti_cicilan_2',
                'nominal_cicilan_1',
                'nominal_cicilan_2',
                'tanggal_bayar_cicilan_1',
                'tanggal_bayar_cicilan_2',
                'status_pembayaran_daftar_ulang',
                'catatan_pembayaran',
            ]);
        });
    }
};

