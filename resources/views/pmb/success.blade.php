@extends('layouts.public')

@section('title', 'Pendaftaran Berhasil - STIKES Muhammadiyah Wonosobo')

@section('content')
<section class="py-16 bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="max-w-2xl w-full mx-auto px-4">
        
        <!-- Success Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden text-center p-8 sm:p-12 relative">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary via-accent to-secondary"></div>
            
            <!-- Success Icon -->
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-green-200">
                <svg class="w-12 h-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <!-- Title -->
            <h1 class="text-3xl font-display font-extrabold text-secondary mb-2">Pendaftaran Berhasil!</h1>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                Terima kasih, berkas pendaftaran online Anda telah berhasil kami terima.
            </p>

            <!-- Registration Number Display -->
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 mb-8 max-w-md mx-auto">
                <p class="text-xs uppercase tracking-wider text-gray-500 font-bold mb-1">Nomor Pendaftaran Anda</p>
                <div class="text-3xl font-display font-extrabold text-primary tracking-widest my-1 select-all">
                    {{ $registration->nomor_pendaftaran }}
                </div>
                <div class="mt-4 pt-4 border-t border-dashed border-gray-200 text-left space-y-2 text-sm text-gray-700">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Nama Pendaftar:</span>
                        <span class="font-bold text-secondary">{{ $registration->nama_lengkap }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Program Studi:</span>
                        <span class="font-bold text-secondary">{{ $registration->prodi }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Jalur Seleksi:</span>
                        <span class="font-bold text-red-900 bg-red-50 px-2.5 py-0.5 rounded-full text-xs border border-red-200">{{ $registration->jalur_seleksi ?? 'Jalur Nilai Rapor' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Gelombang:</span>
                        @php
                            $gelombangColors = [
                                'Gelombang 1' => 'bg-blue-100 text-blue-800',
                                'Gelombang 2' => 'bg-purple-100 text-purple-800',
                                'Gelombang 3' => 'bg-orange-100 text-orange-800',
                                'Gelombang 4' => 'bg-teal-100 text-teal-800',
                                'Gelombang 5' => 'bg-pink-100 text-pink-800',
                            ];
                            $gc = $gelombangColors[$registration->gelombang] ?? 'bg-gray-100 text-gray-600';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $gc }}">
                            {{ $registration->gelombang ?? 'Luar Gelombang' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status Awal:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                            {{ $registration->status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="text-left bg-primary/5 rounded-2xl p-6 border border-primary/10 mb-8 max-w-md mx-auto">
                <h3 class="font-display font-bold text-secondary mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Langkah Selanjutnya:
                </h3>
                <ol class="list-decimal list-inside space-y-2 text-sm text-gray-600">
                    <li>Klik tombol <span class="font-bold text-secondary">Cetak Bukti Pendaftaran</span> di bawah untuk mengunduh bukti PDF/cetak.</li>
                    <li>Simpan bukti pendaftaran ini sebagai syarat mengikuti seleksi.</li>
                    <li>Hubungi PMB Center STIKESMU Wonosobo via WhatsApp:
                        <a href="https://wa.me/62895385250680?text=Halo%20Admin%20PMB%20STIKESMU,%20saya%20sudah%20mendaftar%20online%20dengan%20Nomor%20Pendaftaran%20{{ $registration->nomor_pendaftaran }}" target="_blank" class="font-bold text-primary hover:underline">
                            +62 895-3852-50680
                        </a> untuk konfirmasi cepat dan informasi jadwal ujian seleksi.
                    </li>
                </ol>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('pmb.print', $registration->id) }}" target="_blank" class="w-full sm:w-auto px-8 py-3.5 bg-primary text-white font-bold rounded-xl hover:bg-primary/95 shadow-md flex items-center justify-center gap-2 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    Cetak Bukti Pendaftaran
                </a>
                <a href="/" class="w-full sm:w-auto px-8 py-3.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 flex items-center justify-center gap-2 transition">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
