@extends('layouts.public')

@section('title', 'Berita & Informasi - STIKES Muhammadiyah Wonosobo')

@section('content')
<div class="bg-primary/5 py-12 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-display font-bold text-secondary mb-4">Berita & Informasi Terbaru</h1>
        <p class="text-lg text-gray-600">Dapatkan informasi terkini seputar kegiatan akademik, kemahasiswaan, dan pengumuman penting.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Dummy Card 1 -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition duration-300 flex flex-col">
            <div class="h-52 bg-gray-200 relative">
                <div class="absolute top-4 left-4 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">Pengumuman</div>
            </div>
            <div class="p-6 flex-grow flex flex-col">
                <p class="text-sm text-gray-500 mb-2">20 Juni 2026</p>
                <h3 class="text-xl font-display font-bold text-gray-900 mb-3 hover:text-primary transition">Jadwal Seleksi PMB Gelombang 1</h3>
                <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-3">Pemberitahuan kepada seluruh calon mahasiswa baru yang telah mendaftar di gelombang pertama agar mempersiapkan diri untuk ujian CBT.</p>
                <a href="{{ route('posts.show', 'jadwal-seleksi-pmb') }}" class="text-primary font-semibold hover:text-secondary inline-flex items-center mt-auto">
                    Baca selengkapnya <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </a>
            </div>
        </div>

        <!-- Dummy Card 2 -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition duration-300 flex flex-col">
            <div class="h-52 bg-gray-200 relative">
                <div class="absolute top-4 left-4 bg-accent text-primary text-xs font-bold px-3 py-1 rounded-full">Akademik</div>
            </div>
            <div class="p-6 flex-grow flex flex-col">
                <p class="text-sm text-gray-500 mb-2">18 Juni 2026</p>
                <h3 class="text-xl font-display font-bold text-gray-900 mb-3 hover:text-primary transition">Panduan Pengisian KRS Semester Ganjil</h3>
                <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-3">Mahasiswa diharapkan segera melakukan konsultasi dengan Dosen Pembimbing Akademik masing-masing sebelum masa pengisian KRS berakhir.</p>
                <a href="{{ route('posts.show', 'panduan-pengisian-krs') }}" class="text-primary font-semibold hover:text-secondary inline-flex items-center mt-auto">
                    Baca selengkapnya <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </a>
            </div>
        </div>

        <!-- Dummy Card 3 -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition duration-300 flex flex-col">
            <div class="h-52 bg-gray-200 relative">
                <div class="absolute top-4 left-4 bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full">Kegiatan</div>
            </div>
            <div class="p-6 flex-grow flex flex-col">
                <p class="text-sm text-gray-500 mb-2">15 Juni 2026</p>
                <h3 class="text-xl font-display font-bold text-gray-900 mb-3 hover:text-primary transition">Bakti Sosial Mahasiswa Keperawatan</h3>
                <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-3">Sebagai bentuk implementasi catur dharma perguruan tinggi Muhammadiyah, BEM mengadakan baksos di desa binaan.</p>
                <a href="{{ route('posts.show', 'bakti-sosial-mahasiswa') }}" class="text-primary font-semibold hover:text-secondary inline-flex items-center mt-auto">
                    Baca selengkapnya <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Pagination Placeholder -->
    <div class="mt-12 flex justify-center">
        <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
            <a href="#" class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">Previous</a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-primary text-sm font-medium text-white">1</a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">Next</a>
        </nav>
    </div>
</div>
@endsection
