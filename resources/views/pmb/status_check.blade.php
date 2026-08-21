@extends('layouts.public')

@section('title', 'Cek Status Pendaftaran PMB - STIKES Muhammadiyah Wonosobo')

@section('content')
<section class="py-16 md:py-24 bg-gradient-to-b from-gray-50 via-white to-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="inline-block py-1 px-3.5 rounded-full bg-primary/10 text-primary font-bold text-xs uppercase tracking-wider mb-3 border border-primary/20">
                Layanan PMB Online STIKESMU
            </span>
            <h1 class="text-3xl md:text-4xl font-display font-extrabold text-secondary mb-3">
                Cek Status Pendaftaran
            </h1>
            <p class="text-gray-600 text-sm md:text-base">
                Masukkan <span class="font-bold text-gray-800">Nomor Pendaftaran</span> atau <span class="font-bold text-gray-800">NIK (16 Digit)</span> Anda untuk melihat hasil pengumuman dan kelulusan seleksi PMB.
            </p>
        </div>

        <!-- Search Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 md:p-8 mb-10">
            <form action="{{ route('pmb.status_check') }}" method="GET" class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-grow">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" 
                               name="keyword" 
                               value="{{ $keyword }}" 
                               placeholder="Masukkan Nomor Pendaftaran (contoh: 2026-0001) atau NIK KTP..." 
                               class="w-full pl-12 pr-4 py-4 rounded-2xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-gray-900 font-medium placeholder-gray-400"
                               required>
                    </div>
                    <button type="submit" 
                            class="px-8 py-4 bg-primary hover:bg-primary/95 text-white font-extrabold rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 shrink-0">
                        <span>Cari Status</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500 px-1">
                    <span>Contoh Format NIK: <strong class="text-gray-700">330701xxxxxxxxxx</strong></span>
                    <span class="text-gray-300 hidden sm:inline">&bull;</span>
                    <span>Format No. Reg: <strong class="text-gray-700">2026-XXXX</strong></span>
                </div>
            </form>
        </div>

        <!-- SEARCH RESULTS -->
        @if($searched)
            @if(!$registration)
                <!-- Not Found Alert -->
                <div class="bg-red-50 border border-red-200 rounded-3xl p-8 text-center shadow-sm">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-200">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-display font-bold text-red-900 mb-2">Data Pendaftaran Tidak Ditemukan</h3>
                    <p class="text-red-700 text-sm max-w-md mx-auto mb-6">
                        Mohon periksa kembali pencarian Anda dengan kata kunci "<strong class="underline">{{ $keyword }}</strong>". Pastikan NIK atau Nomor Pendaftaran yang Anda masukkan sudah sesuai saat mendaftar.
                    </p>
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('pmb.status_check') }}" class="px-6 py-2.5 bg-white text-gray-700 border border-gray-300 font-bold rounded-xl text-sm hover:bg-gray-50 transition">
                            Coba Lagi
                        </a>
                        <a href="https://wa.me/62895385250680?text=Halo%20Admin%20PMB,%20saya%20kesulitan%20mengecek%20status%20pendaftaran%20dengan%20keyword:%20{{ $keyword }}" target="_blank" class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl text-sm hover:bg-green-700 shadow-md transition flex items-center gap-2">
                            Bantuan WhatsApp PMB
                        </a>
                    </div>
                </div>
            @else
                <!-- Applicant Result Card -->
                <div class="space-y-6">
                    
                    <!-- Applicant Identity Header Card -->
                    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xl border border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-gray-100">
                            <div>
                                <span class="text-xs uppercase font-bold text-primary font-mono tracking-widest block mb-1">
                                    NOMOR PENDAFTARAN: {{ $registration->nomor_pendaftaran }}
                                </span>
                                <h2 class="text-2xl font-display font-extrabold text-secondary">
                                    {{ $registration->nama_lengkap }}
                                </h2>
                                <p class="text-xs text-gray-500 mt-1">
                                    NIK: {{ $registration->nomor_ktp }} &bull; Tanggal Daftar: {{ $registration->created_at->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB
                                </p>
                            </div>
                            <div class="text-left md:text-right shrink-0">
                                <span class="text-xs text-gray-400 font-bold block uppercase mb-1">Status Pendaftaran</span>
                                @if($registration->status === 'Lulus Seleksi')
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-extrabold bg-green-100 text-green-800 border border-green-300">
                                        ✓ LULUS SELEKSI
                                    </span>
                                @elseif($registration->status === 'Tidak Lulus Seleksi')
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-extrabold bg-red-100 text-red-800 border border-red-300">
                                        ✕ TIDAK LULUS
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-extrabold bg-yellow-100 text-yellow-800 border border-yellow-300">
                                        ⏳ PENDING (VERIFIKASI BERKAS)
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6 text-sm">
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                <span class="text-xs text-gray-400 font-bold uppercase block mb-1">Program Studi</span>
                                <span class="font-bold text-secondary">{{ $registration->prodi }}</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                <span class="text-xs text-gray-400 font-bold uppercase block mb-1">Jalur Seleksi</span>
                                <span class="font-bold text-red-900">{{ $registration->jalur_seleksi ?? 'Jalur Nilai Rapor' }}</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                <span class="text-xs text-gray-400 font-bold uppercase block mb-1">Gelombang</span>
                                <span class="font-bold text-primary">{{ $registration->gelombang ?? 'Luar Gelombang' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- DYNAMIC STATUS INSTRUCTION CARD -->

                    <!-- 1. PENDING STATUS -->
                    @if($registration->status === 'Pending')
                        <div class="bg-gradient-to-br from-amber-500/10 via-yellow-500/5 to-white rounded-3xl p-6 md:p-8 border border-amber-200 shadow-xl">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-amber-500 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-md">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="space-y-3">
                                    <h3 class="text-xl font-display font-extrabold text-amber-900">
                                        Pendaftaran Sedang Menunggu Verifikasi
                                    </h3>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        Formulir pendaftaran Anda telah berhasil diterima oleh sistem. Saat ini Panitia PMB STIKESMU Wonosobo sedang memverifikasi kelengkapan berkas akademik (Raport/Ijazah). Silakan cek halaman ini secara berkala untuk melihat pembaruan status kelulusan.
                                    </p>
                                    <div class="pt-2 flex flex-wrap gap-3">
                                        <a href="{{ route('pmb.print', $registration->id) }}" target="_blank" class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl text-xs shadow-md transition flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                                            Cetak Bukti Pendaftaran PDF
                                        </a>
                                        <a href="https://wa.me/62895385250680?text=Halo%20Admin%20PMB,%20saya%20ingin%20menanyakan%20status%20pendaftaran%20No:%20{{ $registration->nomor_pendaftaran }}" target="_blank" class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl text-xs shadow-md transition flex items-center gap-2">
                                            Hubungi PMB Center (WhatsApp)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 2. LULUS SELEKSI STATUS -->
                    @if($registration->status === 'Lulus Seleksi')
                        <div class="bg-gradient-to-br from-emerald-600 via-emerald-700 to-green-900 rounded-3xl p-6 md:p-8 text-white shadow-2xl relative overflow-hidden">
                            <!-- Background decoration -->
                            <div class="absolute -right-10 -bottom-10 opacity-10 text-white pointer-events-none">
                                <svg class="w-80 h-80" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>

                            <div class="relative z-10 space-y-6">
                                <div class="flex items-center gap-3">
                                    <span class="text-3xl">🎉</span>
                                    <div>
                                        <span class="text-xs font-extrabold uppercase tracking-widest text-accent">PENGUMUMAN RESMI KELULUSAN</span>
                                        <h3 class="text-2xl md:text-3xl font-display font-extrabold text-white">
                                            SELAMAT! ANDA DINYATAKAN LULUS SELEKSI
                                        </h3>
                                    </div>
                                </div>

                                @php
                                        $prodi     = $registration->prodi;
                                        $gelombang = $registration->gelombang ?? 'Gelombang 1';
                                        
                                        $feeRecord = \App\Models\PmbFee::where('prodi', $prodi)->where('gelombang', $gelombang)->first();
                                        
                                        if ($feeRecord) {
                                            $komponen = [
                                                'Biaya Registrasi' => $feeRecord->biaya_registrasi,
                                                'UKT Semester 1'   => $feeRecord->ukt_semester_1,
                                                'Jas Almamater'    => $feeRecord->jas_almamater,
                                                'OSMB'             => $feeRecord->osmb,
                                                'KTM'              => $feeRecord->ktm,
                                            ];
                                        } else {
                                            $komponen = [
                                                'Biaya Registrasi' => 500000,
                                                'UKT Semester 1'   => 4500000,
                                                'Jas Almamater'    => 400000,
                                                'OSMB'             => 350000,
                                                'KTM'              => 75000,
                                            ];
                                        }

                                        $totalBiaya = array_sum($komponen);
                                        $cicilan1   = $totalBiaya * 0.5;
                                        $cicilan2   = $totalBiaya * 0.5;

                                        // Info Akun Login SIA
                                        $prodiCode   = ($registration->prodi === 'S1 Gizi') ? '02' : '01';
                                        $idPmbPadded = str_pad((string)$registration->id, 4, '0', STR_PAD_LEFT);
                                        $nimGen      = date('Y') . $prodiCode . $idPmbPadded;

                                        $cleanName   = preg_replace('/[^a-zA-Z0-9\s]/', '', $registration->nama_lengkap);
                                        $cleanName   = strtolower(trim(preg_replace('/\s+/', ' ', $cleanName)));
                                        $nameSlug    = str_replace(' ', '.', $cleanName);
                                        $tahun2Digit = date('y');
                                        $emailSiaGen = "{$nameSlug}.{$tahun2Digit}@stikesmu.ac.id";
                                        $passSiaGen  = $idPmbPadded;
                                    @endphp

                                    <p class="text-emerald-100 text-sm md:text-base leading-relaxed">
                                        Selamat kepada <strong class="text-white underline">{{ $registration->nama_lengkap }}</strong>! Anda secara resmi dinyatakan diterima sebagai Calon Mahasiswa Baru Program Studi <strong>{{ $registration->prodi }}</strong> STIKES Muhammadiyah Wonosobo T.A. 2026/2027.
                                    </p>

                                    {{-- KARTU AKUN LOGIN SIA --}}
                                    <div class="bg-yellow-400 text-gray-900 rounded-2xl p-5 border-2 border-yellow-300 shadow-xl space-y-3">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xl">🔑</span>
                                            <h4 class="font-display font-extrabold text-base uppercase tracking-wider text-secondary">
                                                Akun Login Portal Akademik (SIA) Anda
                                            </h4>
                                        </div>
                                        <p class="text-xs text-gray-800 font-medium">
                                            Data Anda telah otomatis disinkronkan ke Sistem Informasi Akademik. Gunakan akun berikut untuk login ke portal SIA:
                                        </p>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm font-mono">
                                            <div class="bg-white/95 rounded-xl p-3 border border-yellow-500/30 shadow-sm">
                                                <span class="text-xs text-gray-500 font-bold block mb-0.5">NIM Mahasiswa</span>
                                                <span class="font-extrabold text-secondary text-base">{{ $nimGen }}</span>
                                            </div>
                                            <div class="bg-white/95 rounded-xl p-3 border border-yellow-500/30 shadow-sm">
                                                <span class="text-xs text-gray-500 font-bold block mb-0.5">Email Login SIA</span>
                                                <span class="font-extrabold text-primary text-sm break-all">{{ $emailSiaGen }}</span>
                                            </div>
                                            <div class="bg-white/95 rounded-xl p-3 border border-yellow-500/30 shadow-sm">
                                                <span class="text-xs text-gray-500 font-bold block mb-0.5">Password Sementara</span>
                                                <span class="font-extrabold text-red-600 text-base tracking-wider">{{ $passSiaGen }}</span>
                                            </div>
                                        </div>
                                        <div class="pt-1 flex items-center justify-between gap-2 flex-wrap text-xs">
                                            <span class="text-gray-800 font-medium">💡 Disarankan untuk segera mengganti password setelah pertama kali login ke SIA.</span>
                                            <a href="http://127.0.0.1:8000/login" target="_blank" class="px-4 py-2 bg-secondary text-white font-extrabold rounded-lg hover:bg-secondary/90 transition shadow-md flex items-center gap-1.5">
                                                <span>Buka Portal SIA</span>
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                            </a>
                                        </div>
                                    </div>

                                    {{-- RINCIAN BIAYA DAFTAR ULANG --}}
                                    <div class="bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 overflow-hidden">
                                        <div class="px-5 py-4 border-b border-white/15 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-accent shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" /></svg>
                                            <h4 class="font-display font-bold text-accent text-sm uppercase tracking-wider">
                                                Rincian Biaya Daftar Ulang — {{ $prodi }} · {{ $gelombang }}
                                            </h4>
                                        </div>
                                        <div class="p-5 space-y-2">
                                            @foreach($komponen as $namaKomponen => $nominal)
                                                <div class="flex justify-between items-center text-sm py-1.5 border-b border-white/10 last:border-none">
                                                    <span class="text-emerald-100">{{ $namaKomponen }}</span>
                                                    <span class="font-bold text-white font-mono">Rp {{ number_format($nominal, 0, ',', '.') }}</span>
                                                </div>
                                            @endforeach
                                            <div class="flex justify-between items-center pt-3 mt-1 border-t-2 border-accent/50">
                                                <span class="font-extrabold text-accent text-base">TOTAL KESELURUHAN</span>
                                                <span class="font-extrabold text-accent text-lg font-mono">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- SKEMA CICILAN --}}
                                    <div class="bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 overflow-hidden">
                                        <div class="px-5 py-4 border-b border-white/15 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-accent shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            <h4 class="font-display font-bold text-accent text-sm uppercase tracking-wider">
                                                Skema Pembayaran Cicilan (2x)
                                            </h4>
                                        </div>
                                        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div class="bg-accent/20 border border-accent/30 rounded-xl p-4">
                                                <p class="text-xs font-extrabold text-accent uppercase tracking-wider mb-1">Cicilan Tahap 1 — Saat Daftar Ulang</p>
                                                <p class="text-2xl font-extrabold text-white font-mono">Rp {{ number_format($cicilan1, 0, ',', '.') }}</p>
                                                <p class="text-xs text-emerald-200 mt-2">Dibayarkan paling lambat <strong>7 hari</strong> setelah dinyatakan lulus seleksi.</p>
                                            </div>
                                            <div class="bg-white/10 border border-white/20 rounded-xl p-4">
                                                <p class="text-xs font-extrabold text-white/70 uppercase tracking-wider mb-1">Cicilan Tahap 2 — Menjelang UTS</p>
                                                <p class="text-2xl font-extrabold text-white font-mono">Rp {{ number_format($cicilan2, 0, ',', '.') }}</p>
                                                <p class="text-xs text-emerald-200 mt-2">Dibayarkan sebelum <strong>pelaksanaan Ujian Tengah Semester (UTS)</strong> berlangsung.</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- REKENING PEMBAYARAN --}}
                                    <div class="bg-black/20 rounded-2xl p-5 border border-white/10 space-y-3">
                                        <p class="text-xs font-extrabold text-accent uppercase tracking-wider">Rekening Tujuan Pembayaran Daftar Ulang</p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm font-mono">
                                            <div class="bg-white/10 rounded-xl p-3 border border-white/10">
                                                <p class="text-xs text-emerald-300 font-bold mb-1">🏦 Bank BRI</p>
                                                <p class="font-extrabold text-accent text-base tracking-widest">0123-01-000456-53-1</p>
                                                <p class="text-xs text-white/70 mt-1">a.n. STIKES Muhammadiyah Wonosobo</p>
                                            </div>
                                            <div class="bg-white/10 rounded-xl p-3 border border-white/10">
                                                <p class="text-xs text-emerald-300 font-bold mb-1">🏦 Bank BSI</p>
                                                <p class="font-extrabold text-accent text-base tracking-widest">7123456789</p>
                                                <p class="text-xs text-white/70 mt-1">a.n. STIKES Muhammadiyah Wonosobo</p>
                                            </div>
                                        </div>
                                        <p class="text-xs text-yellow-200 bg-yellow-500/20 rounded-lg px-3 py-2 border border-yellow-400/30">
                                            ⚠️ Sertakan keterangan transfer: <strong class="text-white">NAMA LENGKAP + NOMOR PENDAFTARAN</strong> (contoh: <em>YATNO 2026-0002</em>) agar pembayaran dapat diverifikasi dengan cepat.
                                        </p>
                                    </div>

                                    {{-- UPLOAD BUKTI STRUK TRANSFER --}}
                                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/20 space-y-4">
                                        <div class="flex items-center justify-between flex-wrap gap-2">
                                            <h4 class="font-display font-extrabold text-accent text-sm uppercase tracking-wider flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                                Unggah Foto Struk Transfer Daftar Ulang
                                            </h4>
                                            @php
                                                $statusBayar = $registration->status_pembayaran_daftar_ulang ?? 'Belum Bayar';
                                                $badgeColor = match($statusBayar) {
                                                    'Cicilan 1 Lunas' => 'bg-emerald-500 text-white',
                                                    'Lunas Total' => 'bg-green-500 text-white',
                                                    'Menunggu Verifikasi Cicilan 1', 'Menunggu Verifikasi Cicilan 2' => 'bg-yellow-400 text-gray-900',
                                                    'Ditolak' => 'bg-red-500 text-white',
                                                    default => 'bg-gray-700 text-white'
                                                };
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $badgeColor }}">
                                                Status: {{ $statusBayar }}
                                            </span>
                                        </div>

                                        @if(session('success'))
                                            <div class="p-3 bg-green-500/20 border border-green-400 text-green-100 rounded-xl text-xs">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @if($registration->catatan_pembayaran)
                                            <div class="p-3 bg-red-500/20 border border-red-400 text-red-100 rounded-xl text-xs">
                                                <strong>Catatan Keuangan:</strong> {{ $registration->catatan_pembayaran }}
                                            </div>
                                        @endif

                                        {{-- Form Cicilan 1 --}}
                                        @if(in_array($statusBayar, ['Belum Bayar', 'Menunggu Verifikasi Cicilan 1', 'Ditolak']))
                                            <form action="{{ route('pmb.upload_bukti_bayar', $registration->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3 bg-white/5 p-4 rounded-xl border border-white/10">
                                                @csrf
                                                <input type="hidden" name="tahap_cicilan" value="cicilan_1">
                                                <div class="flex items-center justify-between">
                                                    <label class="text-xs font-bold text-white uppercase">Upload Foto Struk Cicilan 1 (Rp {{ number_format($cicilan1, 0, ',', '.') }})</label>
                                                    <span class="text-xs text-amber-300 font-medium">⭐ Syarat Buka KRS</span>
                                                </div>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <input type="file" name="foto_bukti" accept="image/jpeg,image/png,image/jpg" required class="block w-full text-xs text-gray-200 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-accent file:text-secondary hover:file:bg-yellow-300">
                                                    <input type="number" name="nominal" value="{{ (int)$cicilan1 }}" placeholder="Nominal Transfer" class="px-3 py-2 rounded-xl bg-white/10 text-white border border-white/20 text-xs">
                                                </div>
                                                <button type="submit" class="px-5 py-2.5 bg-accent text-secondary font-extrabold rounded-xl text-xs hover:bg-yellow-300 transition shadow-md">
                                                    Kirim Bukti Bayar Cicilan 1
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Form Cicilan 2 --}}
                                        @if(in_array($statusBayar, ['Cicilan 1 Lunas', 'Menunggu Verifikasi Cicilan 2']))
                                            <form action="{{ route('pmb.upload_bukti_bayar', $registration->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3 bg-white/5 p-4 rounded-xl border border-white/10">
                                                @csrf
                                                <input type="hidden" name="tahap_cicilan" value="cicilan_2">
                                                <div class="flex items-center justify-between">
                                                    <label class="text-xs font-bold text-white uppercase">Upload Foto Struk Cicilan 2 / Pelunasan (Rp {{ number_format($cicilan2, 0, ',', '.') }})</label>
                                                    <span class="text-xs text-amber-300 font-medium">🎟️ Syarat Cetak Kartu UTS</span>
                                                </div>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <input type="file" name="foto_bukti" accept="image/jpeg,image/png,image/jpg" required class="block w-full text-xs text-gray-200 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-accent file:text-secondary hover:file:bg-yellow-300">
                                                    <input type="number" name="nominal" value="{{ (int)$cicilan2 }}" placeholder="Nominal Transfer" class="px-3 py-2 rounded-xl bg-white/10 text-white border border-white/20 text-xs">
                                                </div>
                                                <button type="submit" class="px-5 py-2.5 bg-accent text-secondary font-extrabold rounded-xl text-xs hover:bg-yellow-300 transition shadow-md">
                                                    Kirim Bukti Bayar Cicilan 2
                                                </button>
                                            </form>
                                        @endif
                                    </div>

                                    {{-- CHECKLIST BERKAS FISIK --}}
                                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/20 space-y-3">
                                        <p class="text-xs font-extrabold text-accent uppercase tracking-wider flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Berkas Fisik yang Dibawa ke Kampus
                                        </p>
                                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 text-xs text-emerald-100">
                                            @foreach([
                                                'Fotokopi Ijazah/SKL terlegalisir (2 lbr)',
                                                'Fotokopi Raport terlegalisir (2 lbr)',
                                                'Fotokopi KTP calon mahasiswa (2 lbr)',
                                                'Fotokopi Kartu Keluarga / KK (2 lbr)',
                                                'Surat Keterangan Sehat dari RS/Puskesmas',
                                                'Surat Keterangan Bebas Buta Warna',
                                                'Pas Foto 3×4 berlatar merah (4 lbr)',
                                                'Bukti Pembayaran Daftar Ulang (cetak)',
                                            ] as $berkas)
                                                <li class="flex items-start gap-1.5">
                                                    <span class="text-accent font-bold shrink-0 mt-0.5">✓</span>
                                                    <span>{{ $berkas }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    {{-- ACTION BUTTONS --}}
                                    <div class="flex flex-wrap gap-3 pt-1">
                                        <a href="https://wa.me/62895385250680?text=Halo%20Panitia%20Keuangan%20PMB%20STIKESMU,%20saya%20{{ urlencode($registration->nama_lengkap) }}%20(No.%20Reg:%20{{ $registration->nomor_pendaftaran }})%20ingin%20mengonfirmasi%20daftar%20ulang%20dan%20akan%20melakukan%20pembayaran%20Cicilan%20Tahap%201%20sebesar%20Rp%20{{ number_format($cicilan1, 0, ',', '.') }}." target="_blank" class="px-6 py-3.5 bg-accent hover:bg-yellow-400 text-secondary font-extrabold rounded-xl text-sm shadow-xl transition flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.884-6.97C16.538 1.967 14.09 1.937 11.4 1.937c-5.437 0-9.863 4.373-9.868 9.803-.001 1.748.47 3.447 1.365 4.966l-.994 3.633 3.734-.969zm13.167-9.21c-.244-.122-1.444-.712-1.668-.793-.223-.08-.386-.12-.55.122-.162.243-.63.793-.772.955-.143.162-.285.182-.529.06-2.03-.976-3.197-2.03-3.926-3.264-.194-.332-.03-.512.097-.643.115-.118.257-.3.385-.45.128-.15.17-.255.256-.425.085-.17.042-.317-.02-.439-.062-.122-.55-1.32-.753-1.81-.197-.475-.398-.411-.55-.419-.153-.008-.328-.01-.502-.01-.174 0-.457.065-.696.324-.24.26-1.166 1.139-1.166 2.776 0 1.637 1.2 3.216 1.363 3.435.163.22 2.36 3.565 5.717 4.997 2.793 1.19 3.36 1.012 3.97.955.613-.057 1.444-.588 1.648-1.155.203-.566.203-1.052.142-1.153-.06-.101-.223-.162-.467-.284z"/></svg>
                                            Konfirmasi Daftar Ulang (WA)
                                        </a>
                                        <a href="{{ route('pmb.print', $registration->id) }}" target="_blank" class="px-6 py-3.5 bg-white/20 hover:bg-white/30 text-white font-bold rounded-xl text-sm transition flex items-center gap-2 border border-white/20">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                                            Cetak Formulir Pendaftaran (PDF)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 3. TIDAK LULUS STATUS -->
                    @if($registration->status === 'Tidak Lulus Seleksi')
                        <div class="bg-gradient-to-br from-red-500/10 via-rose-500/5 to-white rounded-3xl p-6 md:p-8 border border-red-200 shadow-xl">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-red-600 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-md">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div class="space-y-3">
                                    <h3 class="text-xl font-display font-extrabold text-red-900">
                                        Mohon Maaf, Pendaftaran Belum Memenuhi Syarat
                                    </h3>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        Terima kasih telah mendaftar di STIKES Muhammadiyah Wonosobo. Berdasarkan hasil verifikasi panitia PMB, pendaftaran Anda pada jalur ini belum memenuhi syarat atau memerlukan perbaikan berkas.
                                    </p>
                                    <div class="pt-2 flex flex-wrap gap-3">
                                        <a href="https://wa.me/62895385250680?text=Halo%20Admin%20PMB,%20saya%20ingin%20konsultasi%20mengenai%20hasil%20seleksi%20No:%20{{ $registration->nomor_pendaftaran }}" target="_blank" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-xs shadow-md transition flex items-center gap-2">
                                            Konsultasi Panitia PMB (WA)
                                        </a>
                                        <a href="{{ route('pmb.jalur') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold rounded-xl text-xs transition">
                                            Coba Jalur Seleksi Lain
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            @endif
        @endif

    </div>
</section>
@endsection
