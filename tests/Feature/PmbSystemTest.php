<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\PmbRegistration;
use App\Models\PmbWave;
use App\Models\PmbFee;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PmbSystemTest extends TestCase
{
    use DatabaseMigrations;
    public function test_nomor_pendaftaran_generation()
    {
        $nomor = PmbRegistration::generateNomorPendaftaran();
        $this->assertMatchesRegularExpression('/^\d{4}-\d{4}$/', $nomor);
    }

    public function test_nim_generation_format()
    {
        $nimFarmasi = PmbRegistration::generateNim('S1 Farmasi', 2026);
        $this->assertEquals(12, strlen($nimFarmasi));
        $this->assertTrue(str_starts_with($nimFarmasi, '008260101'));

        $nimGizi = PmbRegistration::generateNim('S1 Gizi', 2026);
        $this->assertEquals(12, strlen($nimGizi));
        $this->assertTrue(str_starts_with($nimGizi, '008260201'));
    }

    public function test_active_wave_retrieval()
    {
        PmbWave::create([
            'nama_gelombang' => 'Gelombang 1',
            'tahun_akademik' => '2026/2027',
            'tanggal_mulai' => now()->subDays(5)->toDateString(),
            'tanggal_selesai' => now()->addDays(20)->toDateString(),
            'is_active' => true,
        ]);

        $activeWave = PmbWave::getActiveWave();
        $this->assertNotNull($activeWave);
        $this->assertEquals('Gelombang 1', $activeWave->nama_gelombang);
    }

    public function test_check_expired_command()
    {
        $exitCode = Artisan::call('pmb:check-expired');
        $this->assertEquals(0, $exitCode);
    }

    public function test_beasiswa_registration_and_validation()
    {
        $reg = PmbRegistration::create([
            'nomor_pendaftaran' => PmbRegistration::generateNomorPendaftaran(),
            'jalur_seleksi' => 'Jalur Beasiswa & Prestasi',
            'prodi' => 'S1 Farmasi',
            'gelombang' => 'Gelombang 1',
            'nama_lengkap' => 'Tes Beasiswa User',
            'nomor_ktp' => '3307010101990001',
            'nisn' => '0012345678',
            'npsn' => '12345678',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Wonosobo',
            'tanggal_lahir' => '2005-01-01',
            'asal_sekolah' => 'SMA N 1 Wonosobo',
            'jurusan' => 'IPA',
            'tahun_lulus' => 2025,
            'no_hp' => '081234567890',
            'alamat_dusun' => 'Dusun A',
            'alamat_rt' => '01',
            'alamat_rw' => '02',
            'alamat_desa' => 'Desa B',
            'alamat_kecamatan_kabupaten' => 'Wonosobo',
            'nama_ayah' => 'Ayah Tes',
            'ktp_ayah' => '3307010101700001',
            'pekerjaan_ayah' => 'PNS',
            'penghasilan_ayah' => '3.000.000',
            'nama_ibu' => 'Ibu Tes',
            'ktp_ibu' => '3307010101750001',
            'pekerjaan_ibu' => 'IRT',
            'penghasilan_ibu' => '0',
            'alamat_orangtua_dusun' => 'Dusun A',
            'alamat_orangtua_rt' => '01',
            'alamat_orangtua_rw' => '02',
            'alamat_orangtua_desa' => 'Desa B',
            'alamat_orangtua_kecamatan_kabupaten' => 'Wonosobo',
            'no_hp_orangtua' => '081234567891',
            'jenis_beasiswa' => 'Beasiswa Kader Muhammadiyah / Aisyiyah',
            'link_berkas_beasiswa' => 'https://forms.gle/sampleLink123',
            'status' => 'Menunggu Seleksi',
            'pas_foto' => 'dummy.jpg',
            'raport_path' => 'dummy.jpg',
            'ijazah_path' => 'dummy.jpg',
        ]);

        $this->assertNotNull($reg->id);
        $this->assertEquals('Beasiswa Kader Muhammadiyah / Aisyiyah', $reg->jenis_beasiswa);

        $reg->forceDelete();
    }

    public function test_utbk_registration_and_validation()
    {
        $reg = PmbRegistration::create([
            'nomor_pendaftaran' => PmbRegistration::generateNomorPendaftaran(),
            'jalur_seleksi' => 'Jalur Nilai UTBK-SNBT',
            'prodi' => 'S1 Gizi',
            'gelombang' => 'Gelombang 1',
            'nama_lengkap' => 'Tes UTBK User',
            'nomor_ktp' => '3307010101990002',
            'nisn' => '0012345679',
            'npsn' => '12345678',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'Wonosobo',
            'tanggal_lahir' => '2005-02-02',
            'asal_sekolah' => 'SMA N 2 Wonosobo',
            'jurusan' => 'IPA',
            'tahun_lulus' => 2025,
            'no_hp' => '081234567892',
            'alamat_dusun' => 'Dusun C',
            'alamat_rt' => '02',
            'alamat_rw' => '03',
            'alamat_desa' => 'Desa D',
            'alamat_kecamatan_kabupaten' => 'Wonosobo',
            'nama_ayah' => 'Ayah Utbk',
            'ktp_ayah' => '3307010101700002',
            'pekerjaan_ayah' => 'Wiraswasta',
            'penghasilan_ayah' => '5.000.000',
            'nama_ibu' => 'Ibu Utbk',
            'ktp_ibu' => '3307010101750002',
            'pekerjaan_ibu' => 'PNS',
            'penghasilan_ibu' => '4.000.000',
            'alamat_orangtua_dusun' => 'Dusun C',
            'alamat_orangtua_rt' => '02',
            'alamat_orangtua_rw' => '03',
            'alamat_orangtua_desa' => 'Desa D',
            'alamat_orangtua_kecamatan_kabupaten' => 'Wonosobo',
            'no_hp_orangtua' => '081234567893',
            'utbk_pu' => 650.50,
            'utbk_ppu' => 620.00,
            'utbk_pbm' => 580.25,
            'utbk_pk' => 610.00,
            'utbk_lbid' => 640.00,
            'utbk_lbing' => 600.50,
            'utbk_pm' => 590.00,
            'link_sertifikat_utbk' => 'https://drive.google.com/sampleLinkUtbk',
            'status' => 'Menunggu Seleksi',
            'pas_foto' => 'dummy.jpg',
            'raport_path' => 'dummy.jpg',
            'ijazah_path' => 'dummy.jpg',
        ]);

        $this->assertNotNull($reg->id);
        $this->assertEquals(650.50, (float) $reg->utbk_pu);
        $this->assertEquals(590.00, (float) $reg->utbk_pm);

        $reg->forceDelete();
    }

    public function test_public_pages_render_successfully()
    {
        PmbWave::create([
            'nama_gelombang' => 'Gelombang 1',
            'tahun_akademik' => '2026/2027',
            'tanggal_mulai' => now()->subDays(5)->toDateString(),
            'tanggal_selesai' => now()->addDays(20)->toDateString(),
            'is_active' => true,
        ]);

        $resJalur = $this->get(route('pmb.jalur'));
        $resJalur->assertStatus(200);
        $resJalur->assertSee('Jalur Beasiswa');
        $resJalur->assertSee('Jalur Nilai UTBK');

        $resDaftar = $this->get(route('pmb.create', ['jalur' => 'Jalur Beasiswa & Prestasi']));
        $resDaftar->assertStatus(200);
        $resDaftar->assertSee('Jenis Beasiswa');
        $resDaftar->assertSee('Tautan (Link) Google Form');

        $resStatus = $this->get(route('pmb.status_check'));
        $resStatus->assertStatus(200);

        $resBerita = $this->get(route('posts.index'));
        $resBerita->assertStatus(200);

        $resDokumen = $this->get(route('documents.index'));
        $resDokumen->assertStatus(200);
    }
}
