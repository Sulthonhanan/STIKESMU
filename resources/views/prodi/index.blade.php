@extends('layouts.public')

@section('title', 'Program Studi - STIKES Muhammadiyah Wonosobo')

@section('content')
<!-- Header -->
<div class="relative bg-secondary overflow-hidden py-20">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 -left-24 w-72 h-72 bg-accent rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-display font-bold text-white mb-4">Program Studi</h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">Dua program studi unggulan tingkat Sarjana (S1) yang siap mencetak tenaga kesehatan profesional, Islami, dan berdaya saing global.</p>
        <div class="w-24 h-1 bg-accent mx-auto rounded-full mt-6"></div>
    </div>
</div>

<!-- S1 Farmasi -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <!-- Image -->
            <div class="lg:w-1/2 relative">
                <div class="absolute -inset-4 bg-gradient-to-tr from-primary/20 to-primary/5 rounded-[2rem] transform rotate-3"></div>
                <div class="relative bg-gray-100 rounded-[2rem] overflow-hidden shadow-2xl h-80 lg:h-96 flex items-center justify-center">
                    <div class="text-center px-8">
                        <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 font-display font-bold text-xl">S1 Ilmu Farmasi</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="lg:w-1/2">
                <span class="inline-block py-1 px-3 rounded-full bg-primary/10 text-primary font-semibold text-sm mb-4">Program Sarjana (S1)</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-secondary mb-6">Ilmu Farmasi</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Program Studi S1 Ilmu Farmasi STIKES Muhammadiyah Wonosobo bertujuan mencetak tenaga farmasis yang profesional, berintegritas, dan mampu memberikan pelayanan kefarmasian yang optimal kepada masyarakat dengan berlandaskan nilai-nilai Islam dan Kemuhammadiyahan.
                </p>

                <h3 class="text-lg font-display font-bold text-gray-800 mb-3">Profil Lulusan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <svg class="w-5 h-5 text-primary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm text-gray-700">Farmasis Klinis di Rumah Sakit</span>
                    </div>
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <svg class="w-5 h-5 text-primary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm text-gray-700">Apoteker Komunitas (Apotek)</span>
                    </div>
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <svg class="w-5 h-5 text-primary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm text-gray-700">Peneliti Farmasi & Industri</span>
                    </div>
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <svg class="w-5 h-5 text-primary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm text-gray-700">Regulatory Affairs</span>
                    </div>
                </div>

                <h3 class="text-lg font-display font-bold text-gray-800 mb-3">Keunggulan</h3>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li class="flex items-start gap-2"><span class="text-accent text-lg leading-none">★</span> Kurikulum berbasis kompetensi sesuai standar nasional & internasional</li>
                    <li class="flex items-start gap-2"><span class="text-accent text-lg leading-none">★</span> Laboratorium farmasi lengkap (Farmakologi, Farmasetika, Kimia Farmasi)</li>
                    <li class="flex items-start gap-2"><span class="text-accent text-lg leading-none">★</span> Kerja sama praktik dengan rumah sakit dan apotek terkemuka</li>
                    <li class="flex items-start gap-2"><span class="text-accent text-lg leading-none">★</span> Pembinaan karakter Islami dan Kemuhammadiyahan</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="max-w-7xl mx-auto px-4"><hr class="border-gray-200"></div>

<!-- S1 Gizi -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row-reverse items-center gap-12">
            <!-- Image -->
            <div class="lg:w-1/2 relative">
                <div class="absolute -inset-4 bg-gradient-to-tl from-accent/20 to-accent/5 rounded-[2rem] transform -rotate-3"></div>
                <div class="relative bg-gray-100 rounded-[2rem] overflow-hidden shadow-2xl h-80 lg:h-96">
                    <img src="{{ asset('images/s1_gizi.jpg') }}" alt="Pembukaan Prodi Baru S1 Ilmu Gizi" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Content -->
            <div class="lg:w-1/2">
                <span class="inline-block py-1 px-3 rounded-full bg-accent/20 text-yellow-700 font-semibold text-sm mb-4">Program Sarjana (S1)</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-secondary mb-6">Ilmu Gizi</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Program Studi S1 Ilmu Gizi STIKES Muhammadiyah Wonosobo fokus pada pengembangan sumber daya manusia yang memiliki kompetensi dan keahlian dalam bidang gizi klinis, gizi masyarakat, dan gizi institusi, serta mampu menyelesaikan permasalahan gizi di masyarakat secara holistik.
                </p>

                <h3 class="text-lg font-display font-bold text-gray-800 mb-3">Profil Lulusan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm text-gray-700">Ahli Gizi / Dietisien Klinis</span>
                    </div>
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm text-gray-700">Nutrisionis Puskesmas / RS</span>
                    </div>
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm text-gray-700">Konsultan Gizi Masyarakat</span>
                    </div>
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm text-gray-700">Peneliti Pangan & Gizi</span>
                    </div>
                </div>

                <h3 class="text-lg font-display font-bold text-gray-800 mb-3">Keunggulan</h3>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li class="flex items-start gap-2"><span class="text-accent text-lg leading-none">★</span> Kurikulum terintegrasi dengan pendekatan evidence-based nutrition</li>
                    <li class="flex items-start gap-2"><span class="text-accent text-lg leading-none">★</span> Laboratorium Gizi dan Food Science yang modern</li>
                    <li class="flex items-start gap-2"><span class="text-accent text-lg leading-none">★</span> Praktik kerja lapangan di instansi kesehatan dan pangan</li>
                    <li class="flex items-start gap-2"><span class="text-accent text-lg leading-none">★</span> Pengembangan soft skill kepemimpinan dan dakwah kesehatan</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Daftar -->
<section class="py-20 bg-gradient-to-br from-secondary to-primary relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-48 h-48 bg-accent rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-6">Tertarik Bergabung?</h2>
        <p class="text-lg text-gray-300 mb-10 max-w-2xl mx-auto">
            Masa depan karirmu di dunia kesehatan dimulai dari sini. Daftarkan dirimu sekarang dan jadilah bagian dari keluarga besar STIKES Muhammadiyah Wonosobo!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('pmb.create') }}" class="px-8 py-4 rounded-full bg-accent text-secondary font-bold text-lg hover:bg-white transition duration-300 shadow-[0_0_20px_rgba(251,197,49,0.4)] transform hover:-translate-y-1">
                Daftar PMB Online
            </a>
            <a href="/berita" class="px-8 py-4 rounded-full bg-white/10 text-white font-bold text-lg hover:bg-white/20 backdrop-blur-sm border border-white/20 transition duration-300">
                Informasi Lebih Lanjut
            </a>
        </div>
    </div>
</section>
@endsection
