@extends('layouts.admin')

@section('title', 'Detail Pendaftar: ' . $registration->nama_lengkap)

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <a href="{{ route('admin.pmb.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-primary transition">
        &larr; Kembali ke Daftar Pendaftar
    </a>
    
    <div class="flex gap-3 w-full sm:w-auto">
        <a href="{{ route('pmb.print', $registration->id) }}" target="_blank" class="px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-sm rounded-xl flex items-center gap-2 shadow-sm transition w-full sm:w-auto justify-center">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
            Cetak Formulir PMB
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- LEFT COLUMN: Profile Summary & Action Box -->
    <div class="space-y-6">
        
        <!-- Summary Box -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
            <div class="relative w-32 h-44 rounded-xl overflow-hidden border shadow-md bg-gray-100 mx-auto mb-4">
                @if($registration->pas_foto)
                    <img src="{{ asset('storage/' . $registration->pas_foto) }}" class="w-full h-full object-cover" alt="Pas Foto">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100 font-bold text-xs uppercase">
                        No Photo
                    </div>
                @endif
            </div>

            <h2 class="text-xl font-display font-bold text-secondary truncate">{{ $registration->nama_lengkap }}</h2>
            <p class="text-sm font-bold text-primary font-mono tracking-wider mt-1">{{ $registration->nomor_pendaftaran }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Mendaftar pada {{ $registration->created_at->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</p>

            <div class="mt-4 pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-400 font-bold uppercase block mb-1">Pilihan Program Studi</span>
                <span class="text-md font-bold text-secondary bg-gray-100 px-4 py-1.5 rounded-full inline-block">
                    {{ $registration->prodi }}
                </span>
            </div>
            <div class="mt-3">
                <span class="text-xs text-gray-400 font-bold uppercase block mb-1">Gelombang Pendaftaran</span>
                @php
                    $gelombangColors = [
                        'Gelombang 1' => 'bg-blue-100 text-blue-800',
                        'Gelombang 2' => 'bg-purple-100 text-purple-800',
                        'Gelombang 3' => 'bg-orange-100 text-orange-800',
                        'Gelombang 4' => 'bg-teal-100 text-teal-800',
                        'Gelombang 5' => 'bg-pink-100 text-pink-800',
                    ];
                    $colorClass = $gelombangColors[$registration->gelombang] ?? 'bg-gray-100 text-gray-700';
                @endphp
                <span class="text-sm font-bold px-4 py-1.5 rounded-full inline-block {{ $colorClass }}">
                    {{ $registration->gelombang ?? 'Luar Gelombang' }}
                </span>
            </div>
            <div class="mt-3">
                <span class="text-xs text-gray-400 font-bold uppercase block mb-1">Jalur Seleksi</span>
                <span class="text-sm font-bold px-4 py-1.5 rounded-full inline-block bg-red-100 text-red-900 border border-red-200">
                    {{ $registration->jalur_seleksi ?? 'Jalur Nilai Rapor' }}
                </span>
            </div>
        </div>

        <!-- Status Action Box -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-display font-bold text-secondary mb-4 text-md flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Ubah Status Kelulusan (Panitia PMB)
            </h3>

            <div class="mb-4">
                <span class="text-xs text-gray-500 font-semibold block mb-1">Status Kelulusan Saat Ini:</span>
                @if($registration->status === 'Lulus Seleksi')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                        Lulus Seleksi
                    </span>
                @elseif($registration->status === 'Tidak Lulus Seleksi')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                        Tidak Lulus Seleksi
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                        Pending (Sedang Diproses)
                    </span>
                @endif
            </div>

            @if(auth()->user()->hasRole(['Super Admin', 'Admin CMS', 'Staff Panitia PMB']))
                <form action="{{ route('admin.pmb.status', $registration->id) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Pilih Status Kelulusan Baru:</label>
                        <select name="status" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm text-gray-900">
                            <option value="Pending" {{ $registration->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Lulus Seleksi" {{ $registration->status === 'Lulus Seleksi' ? 'selected' : '' }}>Lulus Seleksi</option>
                            <option value="Tidak Lulus Seleksi" {{ $registration->status === 'Tidak Lulus Seleksi' ? 'selected' : '' }}>Tidak Lulus Seleksi</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-primary text-white font-bold text-sm rounded-xl hover:bg-primary/95 shadow-md transition">
                        Simpan Status Kelulusan
                    </button>
                </form>
            @else
                <p class="text-[10px] text-gray-400 italic text-center">
                    * Pengubahan kelulusan khusus Staff Panitia PMB / Super Admin.
                </p>
            @endif
        </div>

        <!-- Verifikasi Keuangan & Payment Action Box -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
            <h3 class="font-display font-bold text-secondary mb-2 text-md flex items-center gap-2 border-b pb-3">
                <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Verifikasi Pembayaran Daftar Ulang
            </h3>

            <div>
                <span class="text-xs text-gray-500 font-semibold block mb-1">Status Pembayaran:</span>
                @php
                    $statusBayar = $registration->status_pembayaran_daftar_ulang ?? 'Belum Bayar';
                    $badgeColor = match($statusBayar) {
                        'Cicilan 1 Lunas' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                        'Lunas Total' => 'bg-green-100 text-green-800 border-green-300',
                        'Menunggu Verifikasi Cicilan 1', 'Menunggu Verifikasi Cicilan 2' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                        'Ditolak' => 'bg-red-100 text-red-800 border-red-300',
                        default => 'bg-gray-100 text-gray-700 border-gray-200'
                    };
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold border {{ $badgeColor }}">
                    {{ $statusBayar }}
                </span>
            </div>

            <!-- PRATINJAU FOTO STRUK TRANSFER -->
            <div class="space-y-3 pt-2">
                <span class="text-xs font-bold text-gray-700 uppercase block">Bukti Transfer Bank:</span>
                <div class="grid grid-cols-2 gap-3">
                    <!-- Cicilan 1 -->
                    <div class="border rounded-xl p-2 text-center bg-gray-50">
                        <span class="text-[10px] font-bold text-gray-500 uppercase block mb-1">Cicilan 1 (50%)</span>
                        @if($registration->foto_bukti_cicilan_1)
                            <a href="{{ asset('storage/' . $registration->foto_bukti_cicilan_1) }}" target="_blank" class="block group relative rounded-lg overflow-hidden border h-24 shadow-xs">
                                <img src="{{ asset('storage/' . $registration->foto_bukti_cicilan_1) }}" class="w-full h-full object-cover group-hover:scale-105 transition" alt="Struk Cicilan 1">
                                <span class="absolute inset-0 bg-black/40 text-white text-[10px] font-bold flex items-center justify-center opacity-0 group-hover:opacity-100 transition">Lihat Foto 🔍</span>
                            </a>
                            <span class="text-[10px] text-gray-600 block mt-1">Rp {{ number_format($registration->nominal_cicilan_1 ?? 0, 0, ',', '.') }}</span>
                        @else
                            <div class="h-24 rounded-lg border border-dashed flex items-center justify-center text-gray-400 text-[10px] italic">Belum Ada Foto</div>
                        @endif
                    </div>

                    <!-- Cicilan 2 -->
                    <div class="border rounded-xl p-2 text-center bg-gray-50">
                        <span class="text-[10px] font-bold text-gray-500 uppercase block mb-1">Cicilan 2 (Pelunasan)</span>
                        @if($registration->foto_bukti_cicilan_2)
                            <a href="{{ asset('storage/' . $registration->foto_bukti_cicilan_2) }}" target="_blank" class="block group relative rounded-lg overflow-hidden border h-24 shadow-xs">
                                <img src="{{ asset('storage/' . $registration->foto_bukti_cicilan_2) }}" class="w-full h-full object-cover group-hover:scale-105 transition" alt="Struk Cicilan 2">
                                <span class="absolute inset-0 bg-black/40 text-white text-[10px] font-bold flex items-center justify-center opacity-0 group-hover:opacity-100 transition">Lihat Foto 🔍</span>
                            </a>
                            <span class="text-[10px] text-gray-600 block mt-1">Rp {{ number_format($registration->nominal_cicilan_2 ?? 0, 0, ',', '.') }}</span>
                        @else
                            <div class="h-24 rounded-lg border border-dashed flex items-center justify-center text-gray-400 text-[10px] italic">Belum Ada Foto</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- FORM PENGESAHAN STAFF KEUANGAN -->
            @if(auth()->user()->hasRole(['Super Admin', 'Admin CMS', 'Staff Keuangan']))
                <form action="{{ route('admin.pmb.verify_payment', $registration->id) }}" method="POST" class="space-y-3 pt-3 border-t">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Sahkan Status Pembayaran:</label>
                        <select name="status_pembayaran" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-amber-500 focus:ring focus:ring-amber-200 text-xs font-bold text-gray-900">
                            <option value="Cicilan 1 Lunas" {{ $statusBayar === 'Cicilan 1 Lunas' ? 'selected' : '' }}>🟢 Sahkan Cicilan 1 Lunas (Buka KRS SIA)</option>
                            <option value="Lunas Total" {{ $statusBayar === 'Lunas Total' ? 'selected' : '' }}>🟢 Sahkan Lunas Total (Buka UTS SIA)</option>
                            <option value="Ditolak" {{ $statusBayar === 'Ditolak' ? 'selected' : '' }}>🔴 Tolak Bukti Transfer (Minta Ulang)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Catatan Keuangan (opsional):</label>
                        <textarea name="catatan" rows="2" placeholder="Contoh: Bukti transfer terverifikasi lunas di rekening Bank BRI." class="w-full rounded-xl border-gray-300 shadow-sm text-xs p-2.5">{{ $registration->catatan_pembayaran }}</textarea>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                        Update & Sync Keuangan ke SIA
                    </button>
                </form>
            @else
                <p class="text-[10px] text-gray-400 italic text-center pt-2">
                    * Pengesahan pembayaran khusus untuk Staff Keuangan & Super Admin.
                </p>
            @endif
        </div>

    </div>

    <!-- RIGHT COLUMN: Detailed Applicant & Family Information -->
    <div class="lg:col-span-2 space-y-6">

        <!-- Section 1: Data Diri Calon Mahasiswa -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                <h3 class="font-display font-bold text-secondary text-md flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Data Calon Mahasiswa Baru
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">Nama Lengkap</span>
                        <span class="font-semibold text-gray-900">{{ $registration->nama_lengkap }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">Nomor KTP / NIK</span>
                        <span class="font-semibold text-gray-900">{{ $registration->nomor_ktp }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">NISN</span>
                        <span class="font-semibold text-gray-900">{{ $registration->nisn ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">NPSN</span>
                        <span class="font-semibold text-gray-900">{{ $registration->npsn ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">Jenis Kelamin</span>
                        <span class="font-semibold text-gray-900">{{ $registration->jenis_kelamin }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">Tempat / Tanggal Lahir</span>
                        <span class="font-semibold text-gray-900">
                            {{ $registration->tempat_lahir }} / {{ \Carbon\Carbon::parse($registration->tanggal_lahir)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">Asal Sekolah</span>
                        <span class="font-semibold text-gray-900">{{ $registration->asal_sekolah }} (Jurusan: {{ $registration->jurusan }})</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">Tahun Lulus</span>
                        <span class="font-semibold text-gray-900">{{ $registration->tahun_lulus }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block">Nomor Telp / WhatsApp</span>
                        <span class="font-semibold text-gray-900">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $registration->no_hp) }}" target="_blank" class="text-primary hover:underline font-bold">
                                {{ $registration->no_hp }} &rarr;
                            </a>
                        </span>
                    </div>
                    <div class="md:col-span-2 pt-2 border-t border-gray-50">
                        <span class="text-xs text-gray-400 font-bold uppercase block mb-1">Alamat Rumah</span>
                        <div class="bg-gray-50 p-4 rounded-xl text-gray-700">
                            <p><span class="font-semibold text-gray-500">Dusun/Jalan:</span> {{ $registration->alamat_dusun }} (RT: {{ $registration->alamat_rt }} / RW: {{ $registration->alamat_rw }})</p>
                            <p class="mt-1"><span class="font-semibold text-gray-500">Desa/Kelurahan:</span> {{ $registration->alamat_desa }}</p>
                            <p class="mt-1"><span class="font-semibold text-gray-500">Kecamatan/Kabupaten:</span> {{ $registration->alamat_kecamatan_kabupaten }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Data Orang Tua Kandung -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                <h3 class="font-display font-bold text-secondary text-md flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    Data Orang Tua Kandung
                </h3>
            </div>
            <div class="p-6">
                <!-- Ayah -->
                <div class="mb-6">
                    <h4 class="text-sm font-bold text-primary mb-3 flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-accent"></span> Ayah Kandung
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Nama Lengkap Ayah</span>
                            <span class="font-semibold text-gray-900">{{ $registration->nama_ayah }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Nomor KTP Ayah</span>
                            <span class="font-semibold text-gray-900">{{ $registration->ktp_ayah }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Pekerjaan Ayah</span>
                            <span class="font-semibold text-gray-900">{{ $registration->pekerjaan_ayah }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Penghasilan Ayah</span>
                            <span class="font-semibold text-gray-900">{{ $registration->penghasilan_ayah }}</span>
                        </div>
                    </div>
                </div>

                <!-- Ibu -->
                <div class="mb-6 pt-6 border-t border-gray-100">
                    <h4 class="text-sm font-bold text-primary mb-3 flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-accent"></span> Ibu Kandung
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Nama Lengkap Ibu</span>
                            <span class="font-semibold text-gray-900">{{ $registration->nama_ibu }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Nomor KTP Ibu</span>
                            <span class="font-semibold text-gray-900">{{ $registration->ktp_ibu }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Pekerjaan Ibu</span>
                            <span class="font-semibold text-gray-900">{{ $registration->pekerjaan_ibu }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Penghasilan Ibu</span>
                            <span class="font-semibold text-gray-900">{{ $registration->penghasilan_ibu }}</span>
                        </div>
                    </div>
                </div>

                <!-- Alamat Orang Tua -->
                <div class="pt-6 border-t border-gray-100 text-sm">
                    <span class="text-xs text-gray-400 font-bold uppercase block mb-1">Alamat Orang Tua Kandung</span>
                    <div class="bg-gray-50 p-4 rounded-xl text-gray-700">
                        <p><span class="font-semibold text-gray-500">Dusun/Jalan:</span> {{ $registration->alamat_orangtua_dusun }} (RT: {{ $registration->alamat_orangtua_rt }} / RW: {{ $registration->alamat_orangtua_rw }})</p>
                        <p class="mt-1"><span class="font-semibold text-gray-500">Desa/Kelurahan:</span> {{ $registration->alamat_orangtua_desa }}</p>
                        <p class="mt-1"><span class="font-semibold text-gray-500">Kecamatan/Kabupaten:</span> {{ $registration->alamat_orangtua_kecamatan_kabupaten }}</p>
                        <p class="mt-2 pt-2 border-t border-gray-200/50"><span class="font-bold text-gray-600">No. HP Orang Tua:</span> {{ $registration->no_hp_orangtua }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Data Wali (Jika Ada) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                <h3 class="font-display font-bold text-secondary text-md flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    Data Wali Pendaftar
                </h3>
            </div>
            <div class="p-6 text-sm">
                @if($registration->nama_wali)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Nama Lengkap Wali</span>
                            <span class="font-semibold text-gray-900">{{ $registration->nama_wali }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Nomor KTP Wali</span>
                            <span class="font-semibold text-gray-900">{{ $registration->ktp_wali }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">Pekerjaan Wali</span>
                            <span class="font-semibold text-gray-900">{{ $registration->pekerjaan_wali }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase block">No. HP Wali</span>
                            <span class="font-semibold text-gray-900">{{ $registration->no_hp_wali }}</span>
                        </div>
                        <div class="md:col-span-2 pt-2 border-t border-gray-50">
                            <span class="text-xs text-gray-400 font-bold uppercase block mb-1">Alamat Wali</span>
                            <div class="bg-gray-50 p-4 rounded-xl text-gray-700">
                                <p><span class="font-semibold text-gray-500">Dusun/Jalan:</span> {{ $registration->alamat_wali_dusun }} (RT: {{ $registration->alamat_wali_rt }} / RW: {{ $registration->alamat_wali_rw }})</p>
                                <p class="mt-1"><span class="font-semibold text-gray-500">Desa/Kelurahan:</span> {{ $registration->alamat_wali_desa }}</p>
                                <p class="mt-1"><span class="font-semibold text-gray-500">Kecamatan/Kabupaten:</span> {{ $registration->alamat_wali_kecamatan_kabupaten }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic text-center py-4">Pendaftar tidak mencantumkan data wali (alamat orang tua tetap digunakan).</p>
                @endif
            </div>
        </div>

        <!-- Section 4: Berkas Dokumen -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                <h3 class="font-display font-bold text-secondary text-md flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Berkas Akademik Pendaftar
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block mb-3">Scan/Foto Nilai Raport</span>
                        @if($registration->raport_path)
                            <a href="{{ asset('storage/' . $registration->raport_path) }}" target="_blank" class="block overflow-hidden rounded-xl border border-gray-200 hover:border-primary transition group relative">
                                <img src="{{ asset('storage/' . $registration->raport_path) }}" class="w-full h-48 object-cover" alt="Raport">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                    <span class="text-white font-semibold flex items-center gap-2"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg> Lihat Penuh</span>
                                </div>
                            </a>
                        @else
                            <p class="text-gray-500 italic text-sm">Tidak ada berkas raport terunggah.</p>
                        @endif
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-bold uppercase block mb-3">Scan/Foto Ijazah / SKL</span>
                        @if($registration->ijazah_path)
                            <a href="{{ asset('storage/' . $registration->ijazah_path) }}" target="_blank" class="block overflow-hidden rounded-xl border border-gray-200 hover:border-primary transition group relative">
                                <img src="{{ asset('storage/' . $registration->ijazah_path) }}" class="w-full h-48 object-cover" alt="Ijazah">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                    <span class="text-white font-semibold flex items-center gap-2"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg> Lihat Penuh</span>
                                </div>
                            </a>
                        @else
                            <p class="text-gray-500 italic text-sm">Tidak ada berkas ijazah terunggah.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
