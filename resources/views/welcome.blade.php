        @extends('layouts.public')

@section('title', 'Beranda - STIKES Muhammadiyah Wonosobo')

@section('content')
<!-- Hero Section -->
<section class="relative bg-secondary overflow-hidden">
    <!-- Decorative background -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -left-24 w-72 h-72 bg-accent rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20 pb-24 lg:pt-32 lg:pb-40 flex flex-col lg:flex-row items-center">
        <div class="lg:w-1/2 text-center lg:text-left">
            <span class="inline-block py-1 px-3 rounded-full bg-primary/20 text-accent font-semibold text-sm mb-6 border border-accent/20">
                Penerimaan Mahasiswa Baru 2026 Dibuka
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-extrabold text-white leading-tight mb-6">
                Wujudkan Cita-cita Menjadi <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-200">Tenaga Kesehatan</span> Profesional
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto lg:mx-0">
                STIKES Muhammadiyah Wonosobo berkomitmen mencetak lulusan berdaya saing global dengan nilai-nilai Islami dan teknologi kesehatan terkini.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="{{ route('pmb.jalur') }}" class="px-8 py-4 rounded-full bg-accent text-secondary font-bold text-lg hover:bg-white transition duration-300 shadow-[0_0_20px_rgba(251,197,49,0.4)] hover:shadow-[0_0_30px_rgba(251,197,49,0.6)] transform hover:-translate-y-1">
                    Daftar Sekarang
                </a>
                <a href="#prodi" class="px-8 py-4 rounded-full bg-white/10 text-white font-bold text-lg hover:bg-white/20 backdrop-blur-sm border border-white/20 transition duration-300">
                    Jelajahi Program Studi
                </a>
            </div>
        </div>
        <div class="lg:w-1/2 mt-16 lg:mt-0 relative hidden md:block">
            <!-- Mockup Image / Graphic -->
            <div class="relative w-full max-w-lg mx-auto transform hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-tr from-primary to-secondary rounded-[2rem] transform rotate-6 opacity-50 blur-lg"></div>
                <div class="relative bg-white/5 backdrop-blur-xl border border-white/20 rounded-[2rem] overflow-hidden shadow-2xl">
                    <img src="{{ asset('images/Foto Dashboard Akreditasi.jpg') }}" alt="Akreditasi STIKESMU Baik Sekali" class="w-full h-auto object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Links / Features -->
<section class="relative -mt-12 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Feature 1 -->
        <a href="https://siakad.stikesmuwsb.ac.id/login" target="_blank" rel="noopener noreferrer" class="group bg-white rounded-2xl shadow-xl p-8 border border-gray-100 hover:border-primary/30 transition duration-300 transform hover:-translate-y-2">
            <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary transition">
                <svg class="w-8 h-8 text-primary group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h3 class="text-xl font-display font-bold text-gray-900 mb-2">SIAKAD</h3>
            <p class="text-gray-600">Sistem Informasi Akademik terintegrasi untuk mahasiswa dan dosen.</p>
        </a>

        <!-- Feature 2 -->
        <a href="{{ route('pmb.create') }}" class="group bg-white rounded-2xl shadow-xl p-8 border border-gray-100 hover:border-accent/50 transition duration-300 transform hover:-translate-y-2 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-2 h-full bg-accent"></div>
            <div class="w-14 h-14 bg-accent/20 rounded-xl flex items-center justify-center mb-6 group-hover:bg-accent transition">
                <svg class="w-8 h-8 text-yellow-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h3 class="text-xl font-display font-bold text-gray-900 mb-2">PMB Online</h3>
            <p class="text-gray-600">Pendaftaran mahasiswa baru mudah, cepat, dan dari mana saja.</p>
        </a>

        <!-- Feature 3 -->
        <a href="#" class="group bg-white rounded-2xl shadow-xl p-8 border border-gray-100 hover:border-secondary/30 transition duration-300 transform hover:-translate-y-2">
            <div class="w-14 h-14 bg-secondary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-secondary transition">
                <svg class="w-8 h-8 text-secondary group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-xl font-display font-bold text-gray-900 mb-2">Perpustakaan</h3>
            <p class="text-gray-600">Akses koleksi buku fisik dan e-book dengan mudah.</p>
        </a>
    </div>
</section>

<!-- PMB Gelombang Info -->
<section id="gelombang-pmb" class="py-20 bg-secondary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="inline-block py-1 px-4 rounded-full bg-accent/20 text-accent font-semibold text-sm mb-4 border border-accent/30">
                Penerimaan Mahasiswa Baru 2026/2027
            </span>
            <h2 class="text-3xl md:text-4xl font-display font-extrabold text-white mb-4">Jadwal Gelombang Pendaftaran</h2>
            <p class="text-gray-300 max-w-2xl mx-auto">Pendaftaran PMB STIKESMU Wonosobo dibuka dalam 5 gelombang. Segera daftarkan diri Anda sebelum kuota penuh!</p>
        </div>

        @php
            $todayStr = now()->timezone('Asia/Jakarta')->toDateString();
            $wavesDb = \App\Models\PmbWave::orderBy('id', 'asc')->get();
            
            $colors = [
                'from-blue-500 to-blue-700',
                'from-purple-500 to-purple-700',
                'from-orange-500 to-orange-700',
                'from-teal-500 to-teal-700',
                'from-pink-500 to-pink-700',
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-12">
            @foreach($wavesDb as $index => $w)
                @php
                    $startStr = $w->tanggal_mulai->toDateString();
                    $endStr   = $w->tanggal_selesai->toDateString();
                    
                    $isActive = $w->is_active && ($startStr <= $todayStr && $endStr >= $todayStr);
                    $isDone   = $endStr < $todayStr;
                    $colorBg  = $colors[$index % count($colors)];
                @endphp
                <div class="relative rounded-2xl overflow-hidden border transition duration-300 {{ $isActive ? 'border-accent shadow-[0_0_24px_rgba(251,197,49,0.4)] scale-105' : ($isDone ? 'border-white/10 opacity-50' : 'border-white/10 hover:border-white/30 hover:scale-105') }}">
                    {{-- Gradient header --}}
                    <div class="bg-gradient-to-br {{ $colorBg }} p-5 text-white text-center">
                        <p class="text-xs font-bold uppercase tracking-widest opacity-80 mb-1">Gelombang</p>
                        <p class="text-4xl font-display font-extrabold">{{ $index + 1 }}</p>
                        @if($isActive)
                            <span class="inline-block mt-2 bg-accent text-secondary text-xs font-extrabold px-3 py-1 rounded-full animate-pulse">
                                ● Sedang Berlangsung
                            </span>
                        @elseif($isDone)
                            <span class="inline-block mt-2 bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full">
                                ✓ Selesai
                            </span>
                        @else
                            <span class="inline-block mt-2 bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full">
                                Akan Datang
                            </span>
                        @endif
                    </div>
                    {{-- Detail --}}
                    <div class="bg-white/5 backdrop-blur-sm p-5 text-center">
                        <p class="text-white font-bold text-sm mb-1">{{ $w->nama_gelombang }}</p>
                        <p class="text-gray-300 text-xs leading-relaxed">{{ $w->tanggal_mulai->translatedFormat('d M') }} – {{ $w->tanggal_selesai->translatedFormat('d M Y') }}</p>
                        @if($isActive)
                            <a href="{{ route('pmb.jalur') }}" class="mt-4 inline-block w-full py-2.5 bg-accent text-secondary font-extrabold text-sm rounded-xl hover:bg-yellow-400 transition shadow-md">
                                Daftar Sekarang
                            </a>
                        @elseif(!$isDone)
                            <p class="mt-4 text-xs text-gray-400 italic">Pendaftaran belum dibuka</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- CTA Banner --}}
        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <p class="text-xs text-accent font-bold uppercase tracking-widest mb-2">Jangan Lewatkan Kesempatan Ini!</p>
                <h3 class="text-2xl font-display font-bold text-white mb-1">Biaya Pendaftaran: <span class="text-accent">Gratis</span></h3>
                <p class="text-gray-300 text-sm">Tidak ada biaya pendaftaran online. Daftar sekarang dan raih impian Anda bersama STIKESMU Wonosobo.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                <a href="{{ route('pmb.jalur') }}" class="px-8 py-4 rounded-full bg-accent text-secondary font-extrabold text-base hover:bg-yellow-400 transition shadow-[0_0_20px_rgba(251,197,49,0.4)] whitespace-nowrap">
                    Daftar Sekarang →
                </a>
                <a href="https://wa.me/62895385250680?text=Halo%20Admin%20PMB%20STIKESMU,%20saya%20ingin%20bertanya%20tentang%20pendaftaran." target="_blank" class="px-8 py-4 rounded-full bg-white/10 text-white font-bold text-base hover:bg-white/20 border border-white/20 transition whitespace-nowrap">
                    Hubungi PMB Center
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Program Studi -->
<section id="prodi" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-secondary mb-4">Program Studi Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Kami fokus pada pengembangan ilmu kesehatan yang inovatif dan terdepan melalui dua program studi unggulan tingkat Sarjana (S1).</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
            <!-- S1 Ilmu Farmasi -->
            <div class="group relative rounded-3xl overflow-hidden shadow-2xl transition duration-500 hover:shadow-[0_20px_50px_rgba(14,112,64,0.3)]">
                <div class="absolute inset-0 bg-gradient-to-t from-secondary via-secondary/80 to-transparent z-10"></div>
                <div class="h-80 bg-gray-200 relative">
                    <!-- Placeholder background image -->
                    <div class="absolute inset-0 bg-primary/20 mix-blend-multiply group-hover:scale-110 transition duration-700"></div>
                </div>
                <div class="absolute bottom-0 left-0 w-full p-8 z-20">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-4 border border-white/30">
                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-display font-bold text-white mb-2">S1 Ilmu Farmasi</h3>
                    <p class="text-gray-300 mb-6 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-y-4 group-hover:translate-y-0 line-clamp-2">Mencetak tenaga farmasis profesional yang unggul dalam pelayanan kefarmasian klinis dan komunitas dengan pendekatan Islami.</p>
                    <a href="{{ route('prodi.index') }}" class="inline-flex items-center text-accent font-semibold hover:text-white transition group-hover:underline">
                        Lihat Kurikulum & Detail <svg class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </a>
                </div>
            </div>

            <!-- S1 Ilmu Gizi -->
            <div class="group relative rounded-3xl overflow-hidden shadow-2xl transition duration-500 hover:shadow-[0_20px_50px_rgba(251,197,49,0.3)]">
                <div class="absolute inset-0 bg-gradient-to-t from-secondary via-secondary/80 to-transparent z-10"></div>
                <div class="h-80 bg-gray-200 relative">
                    <!-- Placeholder background image -->
                    <div class="absolute inset-0 bg-accent/20 mix-blend-multiply group-hover:scale-110 transition duration-700"></div>
                </div>
                <div class="absolute bottom-0 left-0 w-full p-8 z-20">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-4 border border-white/30">
                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-display font-bold text-white mb-2">S1 Ilmu Gizi</h3>
                    <p class="text-gray-300 mb-6 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-y-4 group-hover:translate-y-0 line-clamp-2">Mengembangkan ilmuwan gizi dan dietisien yang kompeten dalam penanganan gizi klinis, masyarakat, dan institusi.</p>
                    <a href="{{ route('prodi.index') }}" class="inline-flex items-center text-accent font-semibold hover:text-white transition group-hover:underline">
                        Lihat Kurikulum & Detail <svg class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Preview -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-secondary mb-4">Berita & Informasi Terbaru</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Ikuti terus perkembangan dan kegiatan terbaru dari STIKES Muhammadiyah Wonosobo.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- News Card Dummy 1 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 group">
                <div class="h-48 bg-gray-200 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/20 group-hover:bg-transparent transition duration-300"></div>
                </div>
                <div class="p-6">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider mb-2 block">Pengumuman</span>
                    <h3 class="text-xl font-display font-bold text-gray-900 mb-3 group-hover:text-primary transition">Jadwal Seleksi PMB Gelombang 1</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">Pemberitahuan kepada seluruh calon mahasiswa baru yang telah mendaftar di gelombang pertama...</p>
                    <a href="#" class="text-primary font-semibold hover:text-secondary flex items-center gap-1 transition">
                        Baca selengkapnya 
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>
                </div>
            </div>
            
            <!-- News Card Dummy 2 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 group">
                <div class="h-48 bg-gray-200 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/20 group-hover:bg-transparent transition duration-300"></div>
                </div>
                <div class="p-6">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider mb-2 block">Akademik</span>
                    <h3 class="text-xl font-display font-bold text-gray-900 mb-3 group-hover:text-primary transition">Panduan Pengisian KRS Semester Ganjil</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">Mahasiswa diharapkan segera melakukan konsultasi dengan Dosen Pembimbing Akademik...</p>
                    <a href="#" class="text-primary font-semibold hover:text-secondary flex items-center gap-1 transition">
                        Baca selengkapnya 
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>
                </div>
            </div>

            <!-- News Card Dummy 3 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 group">
                <div class="h-48 bg-gray-200 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/20 group-hover:bg-transparent transition duration-300"></div>
                </div>
                <div class="p-6">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider mb-2 block">Kegiatan</span>
                    <h3 class="text-xl font-display font-bold text-gray-900 mb-3 group-hover:text-primary transition">Bakti Sosial Mahasiswa Keperawatan</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">Sebagai bentuk implementasi catur dharma perguruan tinggi Muhammadiyah, BEM mengadakan baksos...</p>
                    <a href="#" class="text-primary font-semibold hover:text-secondary flex items-center gap-1 transition">
                        Baca selengkapnya 
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="/berita" class="inline-block px-6 py-3 rounded-full border-2 border-secondary text-secondary font-bold hover:bg-secondary hover:text-white transition duration-300">Lihat Semua Berita</a>
        </div>
    </div>
</section>
@endsection
