@extends('layouts.public')

@section('title', 'Pendaftaran PMB Online - STIKES Muhammadiyah Wonosobo')

@section('content')
<section class="py-16 bg-gradient-to-br from-gray-50 via-gray-100 to-white min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-block py-1 px-3 rounded-full bg-primary/10 text-primary font-bold text-sm mb-4 border border-primary/20">
                Penerimaan Mahasiswa Baru TA 2026/2027
            </span>
            <h1 class="text-3xl md:text-4xl font-display font-extrabold text-secondary mb-3">
                Formulir Pendaftaran PMB Online
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Silakan lengkapi formulir pendaftaran di bawah ini secara cermat. Hubungi panitia jika Anda mengalami kesulitan.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-8 bg-red-50 border border-red-200 text-red-800 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-bold text-lg">Terdapat kesalahan pengisian:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card Container -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden" 
             x-data="{ 
                step: 1, 
                showWali: false,
                sameAddress: false,
                syncAddress() {
                    if(this.sameAddress) {
                        $refs.parentDusun.value = $refs.studentDusun.value;
                        $refs.parentRt.value = $refs.studentRt.value;
                        $refs.parentRw.value = $refs.studentRw.value;
                        $refs.parentDesa.value = $refs.studentDesa.value;
                        $refs.parentKecKab.value = $refs.studentKecKab.value;
                    }
                }
             }">
            
            <!-- Step Indicators -->
            <div class="bg-secondary px-6 py-6 sm:px-10 flex justify-between items-center border-b border-white/10 relative overflow-hidden">
                <div class="absolute inset-0 opacity-5 pointer-events-none">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary rounded-full blur-2xl"></div>
                </div>
                
                <div class="flex items-center w-full z-10">
                    <!-- Step 1 Info -->
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition duration-300"
                             :class="step === 1 ? 'bg-accent text-primary scale-110 shadow-lg' : (step > 1 ? 'bg-primary text-white' : 'bg-white/10 text-gray-400')">
                            <span x-show="step <= 1">1</span>
                            <svg x-show="step > 1" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <span class="hidden md:inline text-sm font-semibold transition" :class="step === 1 ? 'text-white' : 'text-gray-400'">Calon Mahasiswa</span>
                    </div>

                    <!-- Line 1-2 -->
                    <div class="flex-grow h-0.5 bg-white/10 mx-4 max-w-xs">
                        <div class="h-full bg-primary transition-all duration-300" :style="step > 1 ? 'width: 100%' : 'width: 0%'"></div>
                    </div>

                    <!-- Step 2 Info -->
                    <div class="flex items-center gap-3 flex-1 justify-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition duration-300"
                             :class="step === 2 ? 'bg-accent text-primary scale-110 shadow-lg' : (step > 2 ? 'bg-primary text-white' : 'bg-white/10 text-gray-400')">
                            <span x-show="step <= 2">2</span>
                            <svg x-show="step > 2" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <span class="hidden md:inline text-sm font-semibold transition" :class="step === 2 ? 'text-white' : 'text-gray-400'">Orang Tua & Wali</span>
                    </div>

                    <!-- Line 2-3 -->
                    <div class="flex-grow h-0.5 bg-white/10 mx-4 max-w-xs">
                        <div class="h-full bg-primary transition-all duration-300" :style="step > 2 ? 'width: 100%' : 'width: 0%'"></div>
                    </div>

                    <!-- Step 3 Info -->
                    <div class="flex items-center gap-3 flex-1 justify-end">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition duration-300"
                             :class="step === 3 ? 'bg-accent text-primary scale-110 shadow-lg' : 'bg-white/10 text-gray-400'">
                            3
                        </div>
                        <span class="hidden md:inline text-sm font-semibold transition" :class="step === 3 ? 'text-white' : 'text-gray-400'">Unggah Berkas</span>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('pmb.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-10" novalidate>
                @csrf
                <input type="hidden" name="jalur_seleksi" value="{{ old('jalur_seleksi', $selectedJalur ?? 'Jalur Nilai Rapor') }}">

                <!-- STEP 1: CALON MAHASISWA -->
                <div x-show="step === 1" x-transition.opacity.duration.300ms>
                    
                    <!-- Selected Jalur Banner -->
                    <div class="mb-6 p-4 rounded-2xl bg-gradient-to-r from-red-900 to-red-800 text-white flex items-center justify-between shadow-md">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center border border-white/20">
                                <svg class="w-5 h-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs text-yellow-200 font-bold uppercase tracking-wider">Jalur Seleksi Terpilih</p>
                                <p class="text-lg font-display font-extrabold text-white">{{ old('jalur_seleksi', $selectedJalur ?? 'Jalur Nilai Rapor') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('pmb.jalur') }}" class="px-3.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-bold text-white border border-white/20 transition">
                            Ubah Jalur
                        </a>
                    </div>

                    <h3 class="text-xl font-display font-bold text-secondary mb-6 flex items-center gap-2 border-b pb-3">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        I. Data Calon Mahasiswa Baru
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Program Studi Pilihan <span class="text-red-500">*</span></label>
                            <select name="prodi" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-gray-900" required>
                                <option value="" disabled selected>-- Pilih Program Studi --</option>
                                @foreach($programStudis ?? \App\Models\ProgramStudi::active()->get() as $prodi)
                                <option value="{{ $prodi->nama_prodi }}" {{ old('prodi') === $prodi->nama_prodi ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}{{ $prodi->gelar ? ' (' . $prodi->gelar . ')' : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            @php
                                $activeWave = \App\Models\PmbWave::getActiveWave();
                                if ($activeWave) {
                                    $gelombangLabel   = $activeWave->nama_gelombang;
                                    $gelombangPeriode = $activeWave->tanggal_mulai->translatedFormat('d M') . ' – ' . $activeWave->tanggal_selesai->translatedFormat('d M Y');
                                    $gelombangColor   = 'text-primary bg-primary/10 border-primary/30';
                                } else {
                                    $gelombangLabel   = 'Gelombang 1';
                                    $gelombangPeriode = '1 – 31 Juli ' . date('Y');
                                    $gelombangColor   = 'text-primary bg-primary/10 border-primary/30';
                                }
                            @endphp
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gelombang Pendaftaran</label>
                            <div class="w-full rounded-xl border px-4 py-3 {{ $gelombangColor }} font-bold flex items-center justify-between shadow-sm">
                                <span>{{ $gelombangLabel }}</span>
                                <span class="text-xs font-semibold opacity-90">{{ $gelombangPeriode }}</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Terisi otomatis berdasarkan tanggal pendaftaran.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap (Sesuai Ijazah) <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Contoh: Budi Santoso" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor KTP / NIK <span class="text-red-500">*</span></label>
                            <input type="text" name="nomor_ktp" value="{{ old('nomor_ktp') }}" placeholder="16 Digit NIK" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required minlength="16" maxlength="16" pattern="\d{16}" title="NIK harus berupa 16 digit angka" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">NISN <span class="text-red-500">*</span></label>
                            <input type="text" name="nisn" value="{{ old('nisn') }}" placeholder="10 Digit NISN" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required minlength="10" maxlength="10" pattern="\d{10}" title="NISN harus berupa 10 digit angka" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">NPSN <span class="text-red-500">*</span></label>
                            <input type="text" name="npsn" value="{{ old('npsn') }}" placeholder="8 Digit NPSN" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required minlength="8" maxlength="8" pattern="\d{8}" title="NPSN harus berupa 8 digit angka" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div class="flex gap-6 mt-3">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') === 'Laki-laki' ? 'checked' : '' }} class="text-primary focus:ring-primary" required>
                                    <span class="ml-2 text-gray-700 font-medium">Laki-laki</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'checked' : '' }} class="text-primary focus:ring-primary" required>
                                    <span class="ml-2 text-gray-700 font-medium">Perempuan</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Contoh: Wonosobo" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Asal Sekolah <span class="text-red-500">*</span></label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" placeholder="Contoh: SMA N 1 Wonosobo" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jurusan di Sekolah <span class="text-red-500">*</span></label>
                            <input type="text" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: IPA / Farmasi / IPS" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tahun Lulus <span class="text-red-500">*</span></label>
                            <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus') }}" placeholder="Contoh: 2026" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">No. Telp / HP (WhatsApp) <span class="text-red-500">*</span></label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 08123456789" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                    </div>

                    <h4 class="text-lg font-display font-bold text-secondary mb-4">Alamat Tempat Tinggal</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Dusun / Jalan <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_dusun" x-ref="studentDusun" value="{{ old('alamat_dusun') }}" placeholder="Nama Dusun, Gang, atau Jalan" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">RT <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_rt" x-ref="studentRt" value="{{ old('alamat_rt') }}" placeholder="RT" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">RW <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_rw" x-ref="studentRw" value="{{ old('alamat_rw') }}" placeholder="RW" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Desa / Kelurahan <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_desa" x-ref="studentDesa" value="{{ old('alamat_desa') }}" placeholder="Nama Desa/Kelurahan" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kecamatan / Kabupaten / Provinsi <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_kecamatan_kabupaten" x-ref="studentKecKab" value="{{ old('alamat_kecamatan_kabupaten') }}" placeholder="Contoh: Kalikajar, Wonosobo, Jawa Tengah" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-end pt-4">
                        <button type="button" @click="step = 2" class="px-8 py-3.5 bg-primary text-white font-bold rounded-xl hover:bg-primary/95 shadow-md flex items-center gap-2 transform hover:-translate-y-0.5 transition">
                            Lanjut ke Data Orang Tua
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: DATA ORANG TUA / WALI -->
                <div x-show="step === 2" style="display: none;" x-transition.opacity.duration.300ms>
                    <h3 class="text-xl font-display font-bold text-secondary mb-6 flex items-center gap-2 border-b pb-3">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        II. Data Orang Tua / Wali
                    </h3>

                    <!-- DATA AYAH -->
                    <h4 class="text-lg font-display font-bold text-primary mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-accent"></span> Data Ayah Kandung
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" placeholder="Nama Lengkap Ayah" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor KTP / NIK Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="ktp_ayah" value="{{ old('ktp_ayah') }}" placeholder="16 Digit NIK Ayah" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required minlength="16" maxlength="16" pattern="\d{16}" title="NIK harus berupa 16 digit angka" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pekerjaan Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" placeholder="Contoh: PNS / Wiraswasta / Petani" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Penghasilan Bulanan Ayah <span class="text-red-500">*</span></label>
                            <select name="penghasilan_ayah" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-gray-900" required>
                                <option value="" disabled selected>-- Pilih Penghasilan Ayah --</option>
                                <option value="Kurang dari Rp 500.000" {{ old('penghasilan_ayah') === 'Kurang dari Rp 500.000' ? 'selected' : '' }}>Kurang dari Rp 500.000</option>
                                <option value="Rp 500.000 - Rp 999.000" {{ old('penghasilan_ayah') === 'Rp 500.000 - Rp 999.000' ? 'selected' : '' }}>Rp 500.000 - Rp 999.000</option>
                                <option value="Rp 1.000.000 - Rp 1.999.000" {{ old('penghasilan_ayah') === 'Rp 1.000.000 - Rp 1.999.000' ? 'selected' : '' }}>Rp 1.000.000 - Rp 1.999.000</option>
                                <option value="Rp 2.000.000 - Rp 4.999.000" {{ old('penghasilan_ayah') === 'Rp 2.000.000 - Rp 4.999.000' ? 'selected' : '' }}>Rp 2.000.000 - Rp 4.999.000</option>
                                <option value="Rp 5.000.000 - Rp 20.000.000" {{ old('penghasilan_ayah') === 'Rp 5.000.000 - Rp 20.000.000' ? 'selected' : '' }}>Rp 5.000.000 - Rp 20.000.000</option>
                                <option value="Lebih dari Rp 20.000.000" {{ old('penghasilan_ayah') === 'Lebih dari Rp 20.000.000' ? 'selected' : '' }}>Lebih dari Rp 20.000.000</option>
                            </select>
                        </div>
                    </div>

                    <!-- DATA IBU -->
                    <h4 class="text-lg font-display font-bold text-primary mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-accent"></span> Data Ibu Kandung
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" placeholder="Nama Lengkap Ibu" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor KTP / NIK Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="ktp_ibu" value="{{ old('ktp_ibu') }}" placeholder="16 Digit NIK Ibu" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required minlength="16" maxlength="16" pattern="\d{16}" title="NIK harus berupa 16 digit angka" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pekerjaan Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" placeholder="Contoh: Ibu Rumah Tangga / Guru / Pedagang" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Penghasilan Bulanan Ibu <span class="text-red-500">*</span></label>
                            <select name="penghasilan_ibu" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-gray-900" required>
                                <option value="" disabled selected>-- Pilih Penghasilan Ibu --</option>
                                <option value="Kurang dari Rp 500.000" {{ old('penghasilan_ibu') === 'Kurang dari Rp 500.000' ? 'selected' : '' }}>Kurang dari Rp 500.000</option>
                                <option value="Rp 500.000 - Rp 999.000" {{ old('penghasilan_ibu') === 'Rp 500.000 - Rp 999.000' ? 'selected' : '' }}>Rp 500.000 - Rp 999.000</option>
                                <option value="Rp 1.000.000 - Rp 1.999.000" {{ old('penghasilan_ibu') === 'Rp 1.000.000 - Rp 1.999.000' ? 'selected' : '' }}>Rp 1.000.000 - Rp 1.999.000</option>
                                <option value="Rp 2.000.000 - Rp 4.999.000" {{ old('penghasilan_ibu') === 'Rp 2.000.000 - Rp 4.999.000' ? 'selected' : '' }}>Rp 2.000.000 - Rp 4.999.000</option>
                                <option value="Rp 5.000.000 - Rp 20.000.000" {{ old('penghasilan_ibu') === 'Rp 5.000.000 - Rp 20.000.000' ? 'selected' : '' }}>Rp 5.000.000 - Rp 20.000.000</option>
                                <option value="Lebih dari Rp 20.000.000" {{ old('penghasilan_ibu') === 'Lebih dari Rp 20.000.000' ? 'selected' : '' }}>Lebih dari Rp 20.000.000</option>
                            </select>
                        </div>
                    </div>

                    <!-- ALAMAT ORANG TUA -->
                    <div class="flex items-center justify-between mb-4 border-t pt-6">
                        <h4 class="text-lg font-display font-bold text-primary flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-accent"></span> Alamat Orang Tua Kandung
                        </h4>
                        <label class="inline-flex items-center text-sm font-semibold text-gray-600 bg-gray-50 px-3 py-1.5 rounded-lg border cursor-pointer hover:bg-gray-100 select-none">
                            <input type="checkbox" x-model="sameAddress" @change="syncAddress()" class="rounded text-primary focus:ring-primary mr-2">
                            Sama dengan Alamat Calon Siswa
                        </label>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Dusun / Jalan <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_orangtua_dusun" x-ref="parentDusun" value="{{ old('alamat_orangtua_dusun') }}" placeholder="Nama Dusun, Gang, atau Jalan" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">RT <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_orangtua_rt" x-ref="parentRt" value="{{ old('alamat_orangtua_rt') }}" placeholder="RT" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">RW <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_orangtua_rw" x-ref="parentRw" value="{{ old('alamat_orangtua_rw') }}" placeholder="RW" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Desa / Kelurahan <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_orangtua_desa" x-ref="parentDesa" value="{{ old('alamat_orangtua_desa') }}" placeholder="Nama Desa/Kelurahan" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kecamatan / Kabupaten / Provinsi <span class="text-red-500">*</span></label>
                            <input type="text" name="alamat_orangtua_kecamatan_kabupaten" x-ref="parentKecKab" value="{{ old('alamat_orangtua_kecamatan_kabupaten') }}" placeholder="Contoh: Kalikajar, Wonosobo, Jawa Tengah" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">No. Telp / HP (WhatsApp) Orang Tua <span class="text-red-500">*</span></label>
                            <input type="text" name="no_hp_orangtua" value="{{ old('no_hp_orangtua') }}" placeholder="Nomor HP Aktif Orang Tua" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20" required>
                        </div>
                    </div>

                    <!-- WALI (OPTIONAL) -->
                    <div class="border-t pt-6 mb-4">
                        <label class="inline-flex items-center text-lg font-display font-bold text-secondary cursor-pointer select-none">
                            <input type="checkbox" x-model="showWali" class="rounded text-primary focus:ring-primary mr-2 h-5 w-5">
                            Tambahkan Data Wali (Opsional / Jika ada)
                        </label>
                    </div>

                    <div x-show="showWali" x-transition.opacity.duration.300ms style="display: none;" class="bg-gray-50 p-6 rounded-2xl border mb-8">
                        <h4 class="text-lg font-display font-bold text-primary mb-4">Data Wali</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Wali</label>
                                <input type="text" name="nama_wali" value="{{ old('nama_wali') }}" placeholder="Nama Lengkap Wali" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nomor KTP / NIK Wali</label>
                                <input type="text" name="ktp_wali" value="{{ old('ktp_wali') }}" placeholder="16 Digit NIK Wali" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900" minlength="16" maxlength="16" pattern="\d{16}" title="NIK harus berupa 16 digit angka" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pekerjaan Wali</label>
                                <input type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}" placeholder="Pekerjaan Wali" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">No. Telp / HP Wali</label>
                                <input type="text" name="no_hp_wali" value="{{ old('no_hp_wali') }}" placeholder="Nomor HP Aktif Wali" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900">
                            </div>
                        </div>

                        <h5 class="text-md font-bold text-gray-700 mb-3">Alamat Wali</h5>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-3">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Dusun / Jalan</label>
                                <input type="text" name="alamat_wali_dusun" value="{{ old('alamat_wali_dusun') }}" placeholder="Nama Dusun, Gang, atau Jalan" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">RT</label>
                                <input type="text" name="alamat_wali_rt" value="{{ old('alamat_wali_rt') }}" placeholder="RT" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">RW</label>
                                <input type="text" name="alamat_wali_rw" value="{{ old('alamat_wali_rw') }}" placeholder="RW" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Desa / Kelurahan</label>
                                <input type="text" name="alamat_wali_desa" value="{{ old('alamat_wali_desa') }}" placeholder="Nama Desa/Kelurahan" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900">
                            </div>
                            <div class="md:col-span-3">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Kecamatan / Kabupaten / Provinsi</label>
                                <input type="text" name="alamat_wali_kecamatan_kabupaten" value="{{ old('alamat_wali_kecamatan_kabupaten') }}" placeholder="Contoh: Kalikajar, Wonosobo, Jawa Tengah" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900">
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between pt-4">
                        <button type="button" @click="step = 1" class="px-8 py-3.5 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 flex items-center gap-2 transition">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                            Sebelumnya
                        </button>
                        <button type="button" @click="step = 3" class="px-8 py-3.5 bg-primary text-white font-bold rounded-xl hover:bg-primary/95 shadow-md flex items-center gap-2 transform hover:-translate-y-0.5 transition">
                            Lanjut ke Unggah Berkas
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: UNGGAH BERKAS -->
                <div x-show="step === 3" style="display: none;" x-transition.opacity.duration.300ms>
                    <h3 class="text-xl font-display font-bold text-secondary mb-6 flex items-center gap-2 border-b pb-3">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                        III. Dokumen Khusus & Unggah Berkas
                    </h3>

                    @php
                        $isBeasiswa = ($selectedJalur === 'Jalur Beasiswa & Prestasi' || old('jalur_seleksi') === 'Jalur Beasiswa & Prestasi');
                        $isUtbk = ($selectedJalur === 'Jalur Nilai UTBK-SNBT' || old('jalur_seleksi') === 'Jalur Nilai UTBK-SNBT');
                    @endphp

                    @if($isBeasiswa)
                    <!-- SECTION KHUSUS JALUR BEASISWA & PRESTASI -->
                    <div class="mb-8 p-6 bg-amber-50 rounded-2xl border border-amber-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-base">Kelengkapan Jalur Beasiswa & Prestasi</h4>
                                <p class="text-xs text-gray-600">Pilih jenis beasiswa dan cantumkan tautan Google Form pengumpulan berkas Anda.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Beasiswa / Prestasi <span class="text-red-500">*</span></label>
                                <select name="jenis_beasiswa" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900" required>
                                    <option value="" disabled selected>-- Pilih Jenis Beasiswa --</option>
                                    <option value="Beasiswa KIP-Kuliah (Kemendikbud)" {{ old('jenis_beasiswa') === 'Beasiswa KIP-Kuliah (Kemendikbud)' ? 'selected' : '' }}>Beasiswa KIP-Kuliah (Kemendikbud)</option>
                                    <option value="Beasiswa Tahfizh Al-Qur'an (Min. 3 Juz)" {{ old('jenis_beasiswa') === "Beasiswa Tahfizh Al-Qur'an (Min. 3 Juz)" ? 'selected' : '' }}>Beasiswa Tahfizh Al-Qur'an (Min. 3 Juz)</option>
                                    <option value="Beasiswa Kader Muhammadiyah / Aisyiyah" {{ old('jenis_beasiswa') === 'Beasiswa Kader Muhammadiyah / Aisyiyah' ? 'selected' : '' }}>Beasiswa Kader Muhammadiyah / Aisyiyah</option>
                                    <option value="Beasiswa Prestasi Akademik (OSN/KTI)" {{ old('jenis_beasiswa') === 'Beasiswa Prestasi Akademik (OSN/KTI)' ? 'selected' : '' }}>Beasiswa Prestasi Akademik (OSN/KTI)</option>
                                    <option value="Beasiswa Prestasi Non-Akademik (Olahraga/Seni)" {{ old('jenis_beasiswa') === 'Beasiswa Prestasi Non-Akademik (Olahraga/Seni)' ? 'selected' : '' }}>Beasiswa Prestasi Non-Akademik (Olahraga/Seni)</option>
                                    <option value="Beasiswa Yayasan / Kemitraan Khusus" {{ old('jenis_beasiswa') === 'Beasiswa Yayasan / Kemitraan Khusus' ? 'selected' : '' }}>Beasiswa Yayasan / Kemitraan Khusus</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tautan (Link) Google Form Bukti Berkas <span class="text-red-500">*</span></label>
                                <input type="url" name="link_berkas_beasiswa" value="{{ old('link_berkas_beasiswa') }}" placeholder="https://forms.gle/... atau https://drive.google.com/..." class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-gray-900" required>
                                <p class="text-xs text-gray-500 mt-1">Masukkan URL Google Form yang sudah diisi atau link folder Google Drive berkas beasiswa Anda.</p>
                                {{-- Peringatan akses link --}}
                                <div class="mt-2 flex items-start gap-2 bg-yellow-50 border border-yellow-300 rounded-xl px-4 py-3">
                                    <svg class="w-5 h-5 text-yellow-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                    </svg>
                                    <div class="text-xs text-yellow-800 leading-relaxed">
                                        <p class="font-bold mb-0.5">⚠️ Penting — Pastikan Link Dapat Diakses!</p>
                                        <p>Sebelum menempelkan tautan di sini, pastikan pengaturan berbagi (<em>share</em>) sudah diubah menjadi <strong>"Anyone with the link"</strong> (Siapa saja yang memiliki tautan). Panitia tidak akan bisa membuka berkas Anda jika link masih bersifat <em>private</em> atau memerlukan izin akses.</p>
                                        <ul class="mt-1.5 space-y-0.5 list-disc list-inside text-yellow-700">
                                            <li><strong>Google Drive:</strong> Klik kanan file → <em>Share</em> → ubah ke <em>"Anyone with the link – Viewer"</em></li>
                                            <li><strong>Google Form:</strong> Pastikan form tidak memerlukan login akun Google untuk membukanya</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($isUtbk)
                    <!-- SECTION KHUSUS JALUR UTBK-SNBT -->
                    <div class="mb-8 p-6 bg-blue-50/70 rounded-2xl border border-blue-200 shadow-sm"
                         x-data="{
                            pu: '{{ old('utbk_pu', '') }}',
                            ppu: '{{ old('utbk_ppu', '') }}',
                            pbm: '{{ old('utbk_pbm', '') }}',
                            pk: '{{ old('utbk_pk', '') }}',
                            lbid: '{{ old('utbk_lbid', '') }}',
                            lbing: '{{ old('utbk_lbing', '') }}',
                            pm: '{{ old('utbk_pm', '') }}',
                            get rataRata() {
                                let list = [parseFloat(this.pu)||0, parseFloat(this.ppu)||0, parseFloat(this.pbm)||0, parseFloat(this.pk)||0, parseFloat(this.lbid)||0, parseFloat(this.lbing)||0, parseFloat(this.pm)||0];
                                let filled = list.filter(v => v > 0);
                                if (filled.length === 0) return '0.00';
                                let sum = filled.reduce((a, b) => a + b, 0);
                                return (sum / 7).toFixed(2);
                            }
                         }">
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-blue-200">
                            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-sm shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-base">Tabel Nilai Sertifikat UTBK-SNBT</h4>
                                <p class="text-xs text-gray-600">Masukkan nilai 7 sub-tes sesuai Sertifikat Resmi UTBK BPPP Kemendikbudristek (Skor 200 - 900).</p>
                            </div>
                        </div>

                        <!-- Table Design for Neat Alignment -->
                        <div class="bg-white rounded-xl border border-blue-200 overflow-hidden shadow-sm mb-6">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-blue-600 text-white text-xs uppercase font-bold tracking-wider">
                                        <th class="py-3 px-4 w-12 text-center">No</th>
                                        <th class="py-3 px-4">Sub-Tes UTBK-SNBT</th>
                                        <th class="py-3 px-4 w-44 md:w-56 text-center">Skor (200 - 900) <span class="text-red-300">*</span></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                                    <!-- Header TPS -->
                                    <tr class="bg-blue-50/50 font-bold text-blue-900 text-xs tracking-wide">
                                        <td colspan="3" class="py-2 px-4 uppercase">
                                            A. Tes Potensi Skolastik (TPS)
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="py-2.5 px-4 text-center font-bold text-gray-500">1</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-800">
                                            Kemampuan Penalaran Umum (PU)
                                        </td>
                                        <td class="py-2 px-4">
                                            <input type="number" step="0.01" min="200" max="900" name="utbk_pu" x-model="pu" placeholder="Contoh: 650.50" class="w-full text-center font-bold rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5" required>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="py-2.5 px-4 text-center font-bold text-gray-500">2</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-800">
                                            Pengetahuan dan Pemahaman Umum (PPU)
                                        </td>
                                        <td class="py-2 px-4">
                                            <input type="number" step="0.01" min="200" max="900" name="utbk_ppu" x-model="ppu" placeholder="Contoh: 620.00" class="w-full text-center font-bold rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5" required>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="py-2.5 px-4 text-center font-bold text-gray-500">3</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-800">
                                            Kemampuan Memahami Bacaan dan Menulis (PBM)
                                        </td>
                                        <td class="py-2 px-4">
                                            <input type="number" step="0.01" min="200" max="900" name="utbk_pbm" x-model="pbm" placeholder="Contoh: 580.25" class="w-full text-center font-bold rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5" required>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="py-2.5 px-4 text-center font-bold text-gray-500">4</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-800">
                                            Pengetahuan Kuantitatif (PK)
                                        </td>
                                        <td class="py-2 px-4">
                                            <input type="number" step="0.01" min="200" max="900" name="utbk_pk" x-model="pk" placeholder="Contoh: 610.00" class="w-full text-center font-bold rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5" required>
                                        </td>
                                    </tr>

                                    <!-- Header Literasi -->
                                    <tr class="bg-blue-50/50 font-bold text-blue-900 text-xs tracking-wide">
                                        <td colspan="3" class="py-2 px-4 uppercase">
                                            B. Tes Literasi dan Penalaran Matematika
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="py-2.5 px-4 text-center font-bold text-gray-500">5</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-800">
                                            Literasi dalam Bahasa Indonesia (LBID)
                                        </td>
                                        <td class="py-2 px-4">
                                            <input type="number" step="0.01" min="200" max="900" name="utbk_lbid" x-model="lbid" placeholder="Contoh: 640.00" class="w-full text-center font-bold rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5" required>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="py-2.5 px-4 text-center font-bold text-gray-500">6</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-800">
                                            Literasi dalam Bahasa Inggris (LBING)
                                        </td>
                                        <td class="py-2 px-4">
                                            <input type="number" step="0.01" min="200" max="900" name="utbk_lbing" x-model="lbing" placeholder="Contoh: 600.50" class="w-full text-center font-bold rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5" required>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="py-2.5 px-4 text-center font-bold text-gray-500">7</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-800">
                                            Penalaran Matematika (PM)
                                        </td>
                                        <td class="py-2 px-4">
                                            <input type="number" step="0.01" min="200" max="900" name="utbk_pm" x-model="pm" placeholder="Contoh: 590.00" class="w-full text-center font-bold rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-1.5" required>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-blue-100/70 border-t-2 border-blue-300 font-bold">
                                        <td colspan="2" class="py-3 px-4 text-right text-blue-900 text-sm uppercase tracking-wider">
                                            Nilai Rata-Rata UTBK:
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <span class="text-xl font-extrabold text-blue-800 font-mono tracking-wider" x-text="rataRata">0.00</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Link Sertifikat UTBK -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tautan (Link) Sertifikat UTBK (Google Drive / Cloud) <span class="text-red-500">*</span></label>
                            <input type="url" name="link_sertifikat_utbk" value="{{ old('link_sertifikat_utbk') }}" placeholder="https://drive.google.com/file/d/... atau https://..." class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring text-gray-900" required>
                            <p class="text-xs text-gray-500 mt-1">Masukkan URL link file PDF sertifikat nilai UTBK resmi Anda.</p>
                            {{-- Peringatan akses link --}}
                            <div class="mt-2 flex items-start gap-2 bg-yellow-50 border border-yellow-300 rounded-xl px-4 py-3">
                                <svg class="w-5 h-5 text-yellow-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                </svg>
                                <div class="text-xs text-yellow-800 leading-relaxed">
                                    <p class="font-bold mb-0.5">⚠️ Penting — Pastikan Link Dapat Diakses!</p>
                                    <p>Pastikan pengaturan berbagi (<em>share</em>) file sertifikat di Google Drive sudah disetel ke <strong>"Anyone with the link"</strong> (Siapa saja yang memiliki link). Panitia tidak dapat memvalidasi nilai jika file tidak dapat dibuka.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- FILE PAS FOTO -->
                    <div class="mb-8" x-data="{ photoPreview: null }">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pas Foto Resmi 3x4 (Latar Belakang Biru/Merah) <span class="text-red-500">*</span></label>
                        <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-2xl hover:border-primary transition">
                            <div class="space-y-2 text-center">
                                <!-- No Preview -->
                                <div x-show="!photoPreview" class="flex flex-col items-center">
                                    <svg class="mx-auto h-16 w-16 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 mt-2">
                                        <label class="relative cursor-pointer bg-white rounded-md font-bold text-primary hover:text-primary/80 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                            <span>Pilih file pas foto</span>
                                            <input type="file" name="pas_foto" accept="image/*" class="sr-only" required
                                                   @change="
                                                     const file = $event.target.files[0];
                                                     if (file) {
                                                         const reader = new FileReader();
                                                         reader.onload = (e) => { photoPreview = e.target.result; };
                                                         reader.readAsDataURL(file);
                                                     }
                                                   ">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG hingga 2MB (Direkomendasikan ukuran 3x4)</p>
                                </div>
                                
                                <!-- With Preview -->
                                <div x-show="photoPreview" style="display: none;" class="flex flex-col items-center">
                                    <div class="relative w-36 h-48 rounded-xl overflow-hidden border shadow-lg bg-gray-100">
                                        <img :src="photoPreview" class="w-full h-full object-cover" alt="Pratinjau Foto">
                                        <button type="button" @click="photoPreview = null; $refs.pas_foto.value = ''" class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full p-1 shadow-md transition">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                    <p class="text-sm font-semibold text-green-600 mt-3">Pas Foto berhasil dipilih!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FILE RAPORT -->
                    <div class="mb-8" x-data="{ raportPreview: null }">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Scan/Foto Nilai Raport <span class="text-red-500">*</span></label>
                        <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-2xl hover:border-primary transition">
                            <div class="space-y-2 text-center">
                                <!-- No Preview -->
                                <div x-show="!raportPreview" class="flex flex-col items-center">
                                    <svg class="mx-auto h-16 w-16 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 mt-2">
                                        <label class="relative cursor-pointer bg-white rounded-md font-bold text-primary hover:text-primary/80 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                            <span>Pilih file raport</span>
                                            <input type="file" name="raport" accept="image/*" class="sr-only" required
                                                   @change="
                                                     const file = $event.target.files[0];
                                                     if (file) {
                                                         const reader = new FileReader();
                                                         reader.onload = (e) => { raportPreview = e.target.result; };
                                                         reader.readAsDataURL(file);
                                                     }
                                                   ">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG hingga 2MB</p>
                                </div>
                                
                                <!-- With Preview -->
                                <div x-show="raportPreview" style="display: none;" class="flex flex-col items-center">
                                    <div class="relative w-full max-w-sm h-48 rounded-xl overflow-hidden border shadow-lg bg-gray-100">
                                        <img :src="raportPreview" class="w-full h-full object-contain" alt="Pratinjau Raport">
                                        <button type="button" @click="raportPreview = null; $refs.raport.value = ''" class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full p-1 shadow-md transition">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                    <p class="text-sm font-semibold text-green-600 mt-3">Raport berhasil dipilih!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FILE IJAZAH -->
                    <div class="mb-8" x-data="{ ijazahPreview: null }">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Scan/Foto Ijazah (SKL jika belum ada) <span class="text-red-500">*</span></label>
                        <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-2xl hover:border-primary transition">
                            <div class="space-y-2 text-center">
                                <!-- No Preview -->
                                <div x-show="!ijazahPreview" class="flex flex-col items-center">
                                    <svg class="mx-auto h-16 w-16 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 mt-2">
                                        <label class="relative cursor-pointer bg-white rounded-md font-bold text-primary hover:text-primary/80 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                            <span>Pilih file ijazah/SKL</span>
                                            <input type="file" name="ijazah" accept="image/*" class="sr-only" required
                                                   @change="
                                                     const file = $event.target.files[0];
                                                     if (file) {
                                                         const reader = new FileReader();
                                                         reader.onload = (e) => { ijazahPreview = e.target.result; };
                                                         reader.readAsDataURL(file);
                                                     }
                                                   ">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG hingga 2MB</p>
                                </div>
                                
                                <!-- With Preview -->
                                <div x-show="ijazahPreview" style="display: none;" class="flex flex-col items-center">
                                    <div class="relative w-full max-w-sm h-48 rounded-xl overflow-hidden border shadow-lg bg-gray-100">
                                        <img :src="ijazahPreview" class="w-full h-full object-contain" alt="Pratinjau Ijazah">
                                        <button type="button" @click="ijazahPreview = null; $refs.ijazah.value = ''" class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full p-1 shadow-md transition">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                    <p class="text-sm font-semibold text-green-600 mt-3">Ijazah berhasil dipilih!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DEKLARASI -->
                    <div class="bg-primary/5 border border-primary/20 rounded-2xl p-6 mb-8">
                        <h4 class="font-display font-bold text-secondary mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            Pernyataan Kebenaran Data
                        </h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Dengan mengirimkan formulir ini, saya menyatakan bahwa seluruh data yang diisi adalah benar, asli, dan dapat dipertanggungjawabkan kebenarannya. Apabila ditemukan data yang tidak benar di kemudian hari, saya bersedia menerima sanksi pembatalan kelayakan pendaftaran sesuai ketentuan STIKES Muhammadiyah Wonosobo.
                        </p>
                        <label class="inline-flex items-start cursor-pointer select-none">
                            <input type="checkbox" name="pernyataan" class="rounded text-primary focus:ring-primary mt-1 mr-3 h-5 w-5" required>
                            <span class="text-sm font-semibold text-gray-700">Saya menyetujui pernyataan kebenaran data di atas. <span class="text-red-500">*</span></span>
                        </label>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between pt-4">
                        <button type="button" @click="step = 2" class="px-8 py-3.5 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 flex items-center gap-2 transition">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                            Sebelumnya
                        </button>
                        <button type="submit" class="px-8 py-3.5 bg-accent hover:bg-yellow-500 text-primary font-extrabold text-lg rounded-xl shadow-[0_0_20px_rgba(251,197,49,0.4)] flex items-center gap-2 transform hover:-translate-y-0.5 transition">
                            Kirim Pendaftaran Online
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</section>
@endsection
