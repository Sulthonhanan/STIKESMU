<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir PMB - {{ $registration->nomor_pendaftaran }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700|courier-prime:400,700&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0e7040',
                        secondary: '#073c22',
                        accent: '#fbc531',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }
        .box-letter {
            width: 14px;
            height: 17px;
            border: 1px solid #6b7280;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Courier Prime', monospace;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            margin-right: 1.5px;
            background-color: white;
            line-height: 1;
        }
        .print-area {
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            max-width: 850px;
            margin: 0 auto;
        }
        .kop-table {
            width: 100%;
            border-bottom: 3px double #073c22;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }
        .kop-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        @media print {
            body {
                background-color: white !important;
                color: black !important;
                font-size: 9.5pt !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .print-area {
                box-shadow: none !important;
                border: none !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .box-letter {
                border-color: #000000 !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body class="bg-gray-100 py-6">

    <!-- Floating Top Bar for Print Trigger -->
    <div class="max-w-4xl mx-auto mb-6 px-4 no-print flex justify-between items-center bg-white p-4 rounded-2xl shadow-md border border-gray-200">
        <div class="flex items-center gap-3">
            <a href="/" class="text-sm font-bold text-gray-600 hover:text-primary transition">&larr; Kembali ke Beranda</a>
            <span class="text-gray-300">|</span>
            <span class="text-sm font-bold text-gray-800">Nomor Pendaftaran: <strong class="text-primary">{{ $registration->nomor_pendaftaran }}</strong></span>
        </div>
        <button onclick="window.print()" class="px-6 py-2.5 bg-primary text-white font-bold text-sm rounded-xl hover:bg-secondary flex items-center gap-2 shadow-md transition" style="background-color: #0e7040; color: white;">
            <svg class="w-4 h-4" style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
            <span>Cetak Formulir</span>
        </button>
    </div>

    <!-- Main Printable Area -->
    <div class="print-area bg-white p-8 md:p-10 border border-gray-200 rounded-xl shadow-lg">
        
        <!-- Header Kop Surat (Menggunakan Tabel Stabil) -->
        <table class="kop-table">
            <tr>
                <td style="width: 90px; vertical-align: middle; text-align: center;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo STIKESMU" class="kop-logo" style="width: 80px; height: 80px;">
                </td>
                <td style="text-align: center; vertical-align: middle; padding-left: 10px;">
                    <p style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #374151; margin: 0; letter-spacing: 0.5px;">Majelis Pendidikan Tinggi, Penelitian dan Pengembangan</p>
                    <p style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #1f2937; margin: 2px 0 0 0; letter-spacing: 0.5px;">Pimpinan Pusat Muhammadiyah</p>
                    <h1 style="font-size: 20px; font-weight: 900; color: #0e7040; margin: 3px 0; letter-spacing: 0.8px;">STIKES MUHAMMADIYAH WONOSOBO</h1>
                    <p style="font-size: 11px; font-style: italic; font-weight: 600; color: #4b5563; margin: 0;">"Cerdas, Berkarakter, Islami"</p>
                    <p style="font-size: 9.5px; color: #6b7280; margin: 3px 0 0 0;">Jl. Lingkar Luar KM. 02, Jogoyitnan, Wonosobo Telp./WA: +62 895-3852-50680 | Website: https://stikesmuhwonosobo.ac.id</p>
                </td>
            </tr>
        </table>

        <div class="text-center mb-6">
            <h2 class="text-base font-extrabold text-gray-900 border-b-2 border-gray-800 inline-block px-4 pb-0.5 uppercase tracking-wide">FORMULIR PENDAFTARAN MAHASISWA BARU</h2>
            <p class="text-xs font-bold text-gray-700 mt-1">TAHUN AKADEMIK {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        </div>

        @php
            $renderBoxes = function($string, $length = 30) {
                $str = (string) ($string ?? '');
                $str = strtoupper(trim($str));
                $chars = mb_str_split(str_pad(mb_substr($str, 0, $length), $length, ' '));
                $html = '';
                foreach ($chars as $char) {
                    $html .= '<span class="box-letter">' . ($char === ' ' ? '&nbsp;' : e($char)) . '</span>';
                }
                return $html;
            };

            $rawNomor = (string) ($registration->nomor_pendaftaran ?? '');
            $numParts = explode('-', $rawNomor);
            if (count($numParts) >= 3) {
                $yearStr = $numParts[1];
                $seqStr = $numParts[2];
            } elseif (count($numParts) === 2) {
                $yearStr = $numParts[0];
                $seqStr = $numParts[1];
            } else {
                $yearStr = date('Y');
                $seqStr = $rawNomor ?: '0001';
            }
        @endphp

        <!-- DATA CALON MAHASISWA BARU -->
        <div class="mb-6">
            <h3 class="text-sm font-bold bg-gray-100 px-3 py-1 text-gray-800 uppercase mb-3">I. Data Calon Mahasiswa Baru</h3>
            <table class="w-full text-xs space-y-2">
                <tbody>
                    <tr class="align-middle">
                        <td class="w-1/4 py-1.5 font-bold text-gray-700">NOMOR PENDAFTARAN</td>
                        <td class="w-2 py-1.5 text-gray-500">:</td>
                        <td class="py-1.5 flex items-center gap-1">
                            {!! $renderBoxes($yearStr, 4) !!}
                            <span class="mx-1 text-gray-500 font-bold">-</span>
                            {!! $renderBoxes($seqStr, 4) !!}
                            <span class="text-xxs text-gray-400 ml-2">(diisi otomatis)</span>
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="w-1/4 py-1.5 font-bold text-gray-700">GELOMBANG</td>
                        <td class="w-2 py-1.5 text-gray-500">:</td>
                        <td class="py-1.5 font-bold text-gray-900">{{ $registration->gelombang ?? 'Luar Gelombang' }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td class="w-1/4 py-1.5 font-bold text-gray-700">JALUR SELEKSI</td>
                        <td class="w-2 py-1.5 text-gray-500">:</td>
                        <td class="py-1.5 font-bold text-gray-900">{{ $registration->jalur_seleksi ?? 'Jalur Nilai Rapor' }}</td>
                    </tr>
                    @if(!empty($registration->jenis_beasiswa))
                    <tr class="align-middle">
                        <td class="w-1/4 py-1.5 font-bold text-gray-700">JENIS BEASISWA</td>
                        <td class="w-2 py-1.5 text-gray-500">:</td>
                        <td class="py-1.5 font-bold text-primary">{{ $registration->jenis_beasiswa }}</td>
                    </tr>
                    @endif
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">PROGRAM STUDI</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 flex items-center gap-4 font-bold flex-wrap">
                            @php
                                $prodiList = class_exists('\App\Models\ProgramStudi') && \Illuminate\Support\Facades\Schema::hasTable('program_studis')
                                    ? \App\Models\ProgramStudi::orderBy('kode_nim')->get()
                                    : collect();
                            @endphp
                            @if($prodiList->isNotEmpty())
                                @foreach($prodiList as $ps)
                                <label class="inline-flex items-center">
                                    <span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">
                                        {{ $registration->prodi === $ps->nama_prodi ? 'v' : '' }}
                                    </span>
                                    {{ $ps->nama_prodi }}
                                </label>
                                @endforeach
                            @else
                                <span class="text-gray-900 font-bold">{{ $registration->prodi }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">NAMA LENGKAP</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->nama_lengkap, 38) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">NOMOR KTP / NIK</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->nomor_ktp, 16) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">NISN</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->nisn ?? '', 10) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">NPSN</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->npsn ?? '', 8) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">JENIS KELAMIN</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 flex items-center gap-4 font-semibold">
                            <label class="inline-flex items-center">
                                <span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">
                                    {{ $registration->jenis_kelamin === 'Laki-laki' ? 'v' : '' }}
                                </span>
                                Laki-laki
                            </label>
                            <label class="inline-flex items-center">
                                <span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">
                                    {{ $registration->jenis_kelamin === 'Perempuan' ? 'v' : '' }}
                                </span>
                                Perempuan
                            </label>
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">TEMPAT / TGL. LAHIR</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 font-semibold text-gray-800">
                            {{ $registration->tempat_lahir ?? '-' }} / {{ !empty($registration->tanggal_lahir) ? \Carbon\Carbon::parse($registration->tanggal_lahir)->translatedFormat('d-m-Y') : '-' }}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">ASAL SEKOLAH</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->asal_sekolah, 38) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">JURUSAN</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->jurusan, 20) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">TAHUN LULUS</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->tahun_lulus, 4) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">NOMOR TELP/HP</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->no_hp, 14) !!}
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td class="py-1.5 font-bold text-gray-700">ALAMAT TEMPAT TINGGAL</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 space-y-2">
                            <div class="flex items-center gap-1">
                                <span class="w-16 text-gray-500">Dusun/Jalan</span>
                                <span class="mr-1">:</span>
                                <span class="font-semibold text-gray-800">{{ $registration->alamat_dusun }}</span>
                                <span class="mx-3 text-gray-500">RT:</span>
                                <span class="font-bold border border-gray-400 px-2 py-0.5 min-w-[30px] text-center bg-gray-50">{{ $registration->alamat_rt }}</span>
                                <span class="mx-3 text-gray-500">RW:</span>
                                <span class="font-bold border border-gray-400 px-2 py-0.5 min-w-[30px] text-center bg-gray-50">{{ $registration->alamat_rw }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="w-16 text-gray-500">Desa/Kel</span>
                                <span class="mr-1">:</span>
                                <span class="font-semibold text-gray-800">{{ $registration->alamat_desa }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="w-16 text-gray-500">Kec/Kab</span>
                                <span class="mr-1">:</span>
                                <span class="font-semibold text-gray-800">{{ $registration->alamat_kecamatan_kabupaten }}</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- DATA ORANG TUA / WALI -->
        <div class="mb-6">
            <h3 class="text-sm font-bold bg-gray-100 px-3 py-1 text-gray-800 uppercase mb-3">II. Data Orang Tua / Wali</h3>
            <table class="w-full text-xs space-y-2">
                <tbody>
                    <tr class="align-middle">
                        <td class="w-1/4 py-1.5 font-bold text-gray-700">NAMA AYAH</td>
                        <td class="w-2 py-1.5 text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->nama_ayah, 38) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">NOMOR KTP AYAH</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->ktp_ayah, 16) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">PEKERJAAN AYAH</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->pekerjaan_ayah, 25) !!}
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td class="py-1.5 font-bold text-gray-700">PENGHASILAN AYAH</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 grid grid-cols-2 gap-x-4 gap-y-1 font-semibold">
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ayah === 'Kurang dari Rp 500.000' ? 'v' : '' }}</span> Kurang dari Rp 500.000</span>
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ayah === 'Rp 2.000.000 - Rp 4.999.000' ? 'v' : '' }}</span> Rp 2.000.000 - Rp 4.999.000</span>
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ayah === 'Rp 500.000 - Rp 999.000' ? 'v' : '' }}</span> Rp 500.000 - Rp 999.000</span>
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ayah === 'Rp 5.000.000 - Rp 20.000.000' ? 'v' : '' }}</span> Rp 5.000.000 - Rp 20.000.000</span>
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ayah === 'Rp 1.000.000 - Rp 1.999.000' ? 'v' : '' }}</span> Rp 1.000.000 - Rp 1.999.000</span>
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ayah === 'Lebih dari Rp 20.000.000' ? 'v' : '' }}</span> Lebih dari Rp 20.000.000</span>
                        </td>
                    </tr>
                    
                    <tr class="align-middle border-t border-dashed mt-2">
                        <td class="py-1.5 font-bold text-gray-700">NAMA IBU</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->nama_ibu, 38) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">NOMOR KTP IBU</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->ktp_ibu, 16) !!}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td class="py-1.5 font-bold text-gray-700">PEKERJAAN IBU</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 leading-none">
                            {!! $renderBoxes($registration->pekerjaan_ibu, 25) !!}
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td class="py-1.5 font-bold text-gray-700">PENGHASILAN IBU</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 grid grid-cols-2 gap-x-4 gap-y-1 font-semibold">
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ibu === 'Kurang dari Rp 500.000' ? 'v' : '' }}</span> Kurang dari Rp 500.000</span>
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ibu === 'Rp 2.000.000 - Rp 4.999.000' ? 'v' : '' }}</span> Rp 2.000.000 - Rp 4.999.000</span>
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ibu === 'Rp 500.000 - Rp 999.000' ? 'v' : '' }}</span> Rp 500.000 - Rp 999.000</span>
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ibu === 'Rp 5.000.000 - Rp 20.000.000' ? 'v' : '' }}</span> Rp 5.000.000 - Rp 20.000.000</span>
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ibu === 'Rp 1.000.000 - Rp 1.999.000' ? 'v' : '' }}</span> Rp 1.000.000 - Rp 1.999.000</span>
                            <span class="flex items-center"><span class="w-3.5 h-3.5 border border-black flex items-center justify-center mr-1 text-xxs font-bold">{{ $registration->penghasilan_ibu === 'Lebih dari Rp 20.000.000' ? 'v' : '' }}</span> Lebih dari Rp 20.000.000</span>
                        </td>
                    </tr>

                    <tr class="align-top border-t border-dashed">
                        <td class="py-1.5 font-bold text-gray-700">ALAMAT ORANG TUA</td>
                        <td class="text-gray-500">:</td>
                        <td class="py-1.5 space-y-2">
                            <div class="flex items-center gap-1">
                                <span class="w-16 text-gray-500">Dusun/Jalan</span>
                                <span class="mr-1">:</span>
                                <span class="font-semibold text-gray-800">{{ $registration->alamat_orangtua_dusun }}</span>
                                <span class="mx-3 text-gray-500">RT:</span>
                                <span class="font-bold border border-gray-400 px-2 py-0.5 min-w-[30px] text-center bg-gray-50">{{ $registration->alamat_orangtua_rt }}</span>
                                <span class="mx-3 text-gray-500">RW:</span>
                                <span class="font-bold border border-gray-400 px-2 py-0.5 min-w-[30px] text-center bg-gray-50">{{ $registration->alamat_orangtua_rw }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="w-16 text-gray-500">Desa/Kel</span>
                                <span class="mr-1">:</span>
                                <span class="font-semibold text-gray-800">{{ $registration->alamat_orangtua_desa }}</span>
                                <span class="mx-3 text-gray-500">No. HP:</span>
                                <span class="font-semibold text-gray-800">{{ $registration->no_hp_orangtua }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="w-16 text-gray-500">Kec/Kab</span>
                                <span class="mr-1">:</span>
                                <span class="font-semibold text-gray-800">{{ $registration->alamat_orangtua_kecamatan_kabupaten }}</span>
                            </div>
                        </td>
                    </tr>

                    <!-- WALI (IF FILLED) -->
                    @if($registration->nama_wali)
                        <tr class="align-middle border-t border-dashed">
                            <td class="py-1.5 font-bold text-gray-700">NAMA WALI</td>
                            <td class="text-gray-500">:</td>
                            <td class="py-1.5 leading-none">
                                {!! $renderBoxes($registration->nama_wali, 38) !!}
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td class="py-1.5 font-bold text-gray-700">NOMOR KTP WALI</td>
                            <td class="text-gray-500">:</td>
                            <td class="py-1.5 leading-none">
                                {!! $renderBoxes($registration->ktp_wali, 16) !!}
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td class="py-1.5 font-bold text-gray-700">PEKERJAAN WALI</td>
                            <td class="text-gray-500">:</td>
                            <td class="py-1.5 leading-none">
                                {!! $renderBoxes($registration->pekerjaan_wali, 25) !!}
                            </td>
                        </tr>
                        <tr class="align-top">
                            <td class="py-1.5 font-bold text-gray-700">ALAMAT WALI</td>
                            <td class="text-gray-500">:</td>
                            <td class="py-1.5 space-y-2">
                                <div class="flex items-center gap-1">
                                    <span class="w-16 text-gray-500">Dusun/Jalan</span>
                                    <span class="mr-1">:</span>
                                    <span class="font-semibold text-gray-800">{{ $registration->alamat_wali_dusun }}</span>
                                    <span class="mx-3 text-gray-500">RT:</span>
                                    <span class="font-bold border border-gray-400 px-2 py-0.5 min-w-[30px] text-center bg-gray-50">{{ $registration->alamat_wali_rt }}</span>
                                    <span class="mx-3 text-gray-500">RW:</span>
                                    <span class="font-bold border border-gray-400 px-2 py-0.5 min-w-[30px] text-center bg-gray-50">{{ $registration->alamat_wali_rw }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="w-16 text-gray-500">Desa/Kel</span>
                                    <span class="mr-1">:</span>
                                    <span class="font-semibold text-gray-800">{{ $registration->alamat_wali_desa }}</span>
                                    <span class="mx-3 text-gray-500">No. HP:</span>
                                    <span class="font-semibold text-gray-800">{{ $registration->no_hp_wali }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="w-16 text-gray-500">Kec/Kab</span>
                                    <span class="mr-1">:</span>
                                    <span class="font-semibold text-gray-800">{{ $registration->alamat_wali_kecamatan_kabupaten }}</span>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- FOOTER / SIGNATURE SECTION -->
        <div class="mt-12 flex justify-between items-end">
            <!-- Pas Foto Area -->
            <div class="w-28 h-36 border-2 border-dashed border-gray-400 flex items-center justify-center p-1 bg-gray-50 relative">
                @if($registration->pas_foto)
                    <img src="{{ asset('storage/' . $registration->pas_foto) }}" alt="Foto Siswa" class="w-full h-full object-cover">
                @else
                    <div class="text-center text-gray-400 text-xxs font-bold">
                        Pas Foto<br>3 x 4
                    </div>
                @endif
            </div>

            <!-- Signature Block -->
            <div class="text-center w-56 text-xs">
                <p class="mb-1 text-gray-700">Wonosobo, {{ $registration->created_at ? $registration->created_at->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }}</p>
                <p class="font-bold text-gray-700">Pendaftar</p>
                <div class="h-20 flex items-center justify-center italic text-gray-300">
                    ( Tanda Tangan )
                </div>
                <p class="font-bold border-t border-black pt-1 text-gray-900">{{ $registration->nama_lengkap }}</p>
            </div>
        </div>

        <!-- Note instruction for printer -->
        <div class="mt-8 pt-4 border-t border-gray-200 text-xxs text-gray-400 italic text-center">
            * Cetak formulir ini dan bawa saat melakukan verifikasi berkas di kampus STIKES Muhammadiyah Wonosobo.
        </div>

    </div>

</body>
</html>
