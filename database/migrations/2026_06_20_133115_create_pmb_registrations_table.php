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
        Schema::create('pmb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pendaftaran')->unique();
            $table->string('prodi');
            $table->string('nama_lengkap');
            $table->string('nomor_ktp');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('asal_sekolah');
            $table->string('jurusan');
            $table->integer('tahun_lulus');
            $table->string('no_hp');
            
            // Alamat Calon Mahasiswa
            $table->string('alamat_dusun');
            $table->string('alamat_rt', 10);
            $table->string('alamat_rw', 10);
            $table->string('alamat_desa');
            $table->string('alamat_kecamatan_kabupaten');

            // Data Orang Tua
            $table->string('nama_ayah');
            $table->string('ktp_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');
            
            $table->string('nama_ibu');
            $table->string('ktp_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_ibu');
            
            $table->string('alamat_orangtua_dusun');
            $table->string('alamat_orangtua_rt', 10);
            $table->string('alamat_orangtua_rw', 10);
            $table->string('alamat_orangtua_desa');
            $table->string('alamat_orangtua_kecamatan_kabupaten');
            $table->string('no_hp_orangtua');

            // Data Wali (Optional)
            $table->string('nama_wali')->nullable();
            $table->string('ktp_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('alamat_wali_dusun')->nullable();
            $table->string('alamat_wali_rt', 10)->nullable();
            $table->string('alamat_wali_rw', 10)->nullable();
            $table->string('alamat_wali_desa')->nullable();
            $table->string('alamat_wali_kecamatan_kabupaten')->nullable();
            $table->string('no_hp_wali')->nullable();

            // Berkas & Status
            $table->string('pas_foto');
            $table->string('status')->default('Pending'); // Pending, Lulus Seleksi, Tidak Lulus Seleksi
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmb_registrations');
    }
};
