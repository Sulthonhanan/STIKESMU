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
        Schema::create('program_studis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prodi')->unique(); // Contoh: "S1 Farmasi"
            $table->string('jenjang')->default('S1'); // S1, D3, Profesi
            $table->string('kode_nim', 10)->unique(); // 0101, 0201, 0301
            $table->string('kode_dikti', 10)->nullable(); // 48201, 51201
            $table->string('gelar')->nullable(); // S.Farm, S.Gz, S.Kep
            $table->string('akreditasi')->nullable()->default('Baik Sekali'); // Unggul, Baik Sekali, B
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('prospek_karir')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed data awal prodi eksisting
        DB::table('program_studis')->insert([
            [
                'nama_prodi'    => 'S1 Farmasi',
                'jenjang'       => 'S1',
                'kode_nim'      => '0101',
                'kode_dikti'    => '48201',
                'gelar'         => 'S.Farm',
                'akreditasi'    => 'Baik Sekali',
                'deskripsi'     => 'Program Studi Sarjana Farmasi STIKES Muhammadiyah Wonosobo mendidik calon sarjana farmasi yang unggul, berjiwa entrepreneur, dan berlandaskan nilai-nilai keislaman.',
                'visi'          => 'Menjadi Program Studi Sarjana Farmasi yang unggul dalam bidang pelayanan farmasi klinis dan komunitas berbasis kearifan lokal pada tingkat nasional tahun 2030.',
                'misi'          => 'Menyelenggarakan pendidikan kefarmasian yang bermutu, melaksanakan penelitian inovatif berbasis bahan alam lokal, dan melakukan pengabdian masyarakat.',
                'prospek_karir' => 'Apotek, Rumah Sakit, Industri Farmasi, BPOM/Kemenkes, Pendidik & Peneliti, Wirausaha Kefarmasian.',
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_prodi'    => 'S1 Gizi',
                'jenjang'       => 'S1',
                'kode_nim'      => '0201',
                'kode_dikti'    => '51201',
                'gelar'         => 'S.Gz',
                'akreditasi'    => 'Baik Sekali',
                'deskripsi'     => 'Program Studi Sarjana Gizi STIKES Muhammadiyah Wonosobo mencetak ahli gizi profesional yang kompeten di bidang gizi klinis, gizi masyarakat, dan kuliner sehat.',
                'visi'          => 'Menjadi Program Studi Sarjana Gizi yang berdaya saing unggul dalam penanganan masalah gizi masyarakat berbasis kearifan lokal tingkat nasional tahun 2030.',
                'misi'          => 'Menyelenggarakan pendidikan gizi terstandar, penelitian gizi berbasis pangan lokal, dan pengabdian masyarakat dalam percepatan perbaikan gizi.',
                'prospek_karir' => 'Nutritionist Rumah Sakit & Puskesmas, Konsultan Gizi & Kebugaran, Industri Makanan & Minuman, Dinas Kesehatan, Food Service Manager.',
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studis');
    }
};
