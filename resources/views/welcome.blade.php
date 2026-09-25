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
            @php
                $todayStr = now()->timezone('Asia/Jakarta')->toDateString();
                $wavesDb = \App\Models\PmbWave::orderBy('id', 'asc')->get();
                $waveCount = $wavesDb->count();
                
                $colors = [
                    'from-blue-500 to-blue-700',
                    'from-purple-500 to-purple-700',
                    'from-orange-500 to-orange-700',
                    'from-teal-500 to-teal-700',
                    'from-pink-500 to-pink-700',
                    'from-emerald-500 to-emerald-700',
                    'from-indigo-500 to-indigo-700',
                ];
            @endphp
            <p class="text-gray-300 max-w-2xl mx-auto">Pendaftaran PMB STIKESMU Wonosobo dibuka dalam {{ $waveCount }} gelombang. Segera daftarkan diri Anda sebelum kuota penuh!</p>
        </div>

        <div class="flex flex-wrap justify-center gap-5 mb-12">
            @foreach($wavesDb as $index => $w)
                @php
                    $startStr = $w->tanggal_mulai->toDateString();
                    $endStr   = $w->tanggal_selesai->toDateString();
                    
                    $isActive = $w->is_active && ($startStr <= $todayStr && $endStr >= $todayStr);
                    $isDone   = $endStr < $todayStr;
                    $colorBg  = $colors[$index % count($colors)];
                @endphp
                <div class="w-full sm:w-60 md:w-64 max-w-[270px] relative rounded-2xl overflow-hidden border transition duration-300 {{ $isActive ? 'border-accent shadow-[0_0_24px_rgba(251,197,49,0.4)] scale-105' : ($isDone ? 'border-white/10 opacity-50' : 'border-white/10 hover:border-white/30 hover:scale-105') }}">
                    {{-- Gradient header --}}
                    <div class="bg-gradient-to-br {{ $colorBg }} p-4 text-white text-center">
                        <p class="text-[11px] font-bold uppercase tracking-widest opacity-80 mb-0.5">Gelombang</p>
                        <p class="text-3xl font-display font-extrabold">{{ $index + 1 }}</p>
                        @if($isActive)
                            <span class="inline-block mt-1.5 bg-accent text-secondary text-[11px] font-extrabold px-2.5 py-0.5 rounded-full animate-pulse">
                                ● Berlangsung
                            </span>
                        @elseif($isDone)
                            <span class="inline-block mt-1.5 bg-white/20 text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                                ✓ Selesai
                            </span>
                        @else
                            <span class="inline-block mt-1.5 bg-white/20 text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                                Segera Dibuka
                            </span>
                        @endif
                    </div>
                    {{-- Body --}}
                    <div class="bg-white/5 backdrop-blur-sm p-4 text-center text-white space-y-1.5">
                        <p class="text-xs font-semibold opacity-90 truncate">{{ $w->nama_gelombang }}</p>
                        <p class="text-[11px] text-gray-300">
                            {{ $w->tanggal_mulai->translatedFormat('d M Y') }} - {{ $w->tanggal_selesai->translatedFormat('d M Y') }}
                        </p>
                        @if(!empty($w->keterangan))
                            <p class="text-[11px] text-accent font-medium pt-1 border-t border-white/10 line-clamp-1">{{ $w->keterangan }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Call to action under waves --}}
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="text-white text-center md:text-left">
                <p class="font-display font-bold text-lg">Siap Bergabung dengan STIKES Muhammadiyah Wonosobo?</p>
                <p class="text-gray-300 text-sm">Pendaftaran dilakukan 100% secara online. Cepat, transparan, dan mudah.</p>
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
            <p class="text-gray-600 max-w-2xl mx-auto">Kami fokus pada pengembangan ilmu kesehatan yang inovatif dan terdepan melalui program studi unggulan kami.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-7 max-w-6xl mx-auto">
            @forelse($programStudis ?? [] as $prodi)
            <div class="w-full sm:w-[320px] md:w-[340px] max-w-[350px] group relative rounded-3xl overflow-hidden shadow-xl transition duration-500 hover:shadow-2xl hover:-translate-y-1 flex flex-col min-h-[350px] bg-secondary">
                <!-- Background Image (Thumbnail) -->
                @if($prodi->thumbnail)
                    <img src="{{ asset('storage/' . $prodi->thumbnail) }}" alt="{{ $prodi->nama_prodi }}" onerror="this.style.display='none'" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                @endif
                <div class="absolute inset-0 bg-gradient-to-br from-primary/30 to-secondary group-hover:scale-110 transition duration-700 -z-0"></div>
                
                <!-- Dark Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-secondary via-secondary/85 to-transparent z-10"></div>
                
                <!-- Badge Top Right -->
                <div class="absolute top-4 right-4 z-20 flex gap-2">
                    <span class="px-3 py-1 bg-primary/90 text-white text-xs font-bold rounded-full shadow-md backdrop-blur-sm">
                        {{ $prodi->jenjang }}
                    </span>
                    @if($prodi->akreditasi)
                    <span class="px-3 py-1 bg-accent/90 text-secondary text-xs font-bold rounded-full shadow-md backdrop-blur-sm">
                        {{ $prodi->akreditasi }}
                    </span>
                    @endif
                </div>

                <!-- Content Bottom -->
                <div class="mt-auto p-6 z-20">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-3 border border-white/30 text-white shadow-inner">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-display font-bold text-white mb-1.5 leading-snug">{{ $prodi->nama_prodi }}</h3>
                    <p class="text-gray-300 text-xs mb-4 line-clamp-2 leading-relaxed">
                        {{ $prodi->deskripsi ?? 'Program studi unggulan STIKES Muhammadiyah Wonosobo mencetak tenaga profesional berkarakter Islami.' }}
                    </p>
                    <a href="{{ route('prodi.index') }}" class="inline-flex items-center text-accent font-bold hover:text-white transition group-hover:underline text-xs">
                        Lihat Profil & Kurikulum <svg class="w-3.5 h-3.5 ml-1.5 group-hover:translate-x-1 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="w-full text-center py-12 text-gray-500">
                Belum ada program studi yang ditampilkan.
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

        <div class="flex flex-wrap justify-center gap-8 max-w-6xl mx-auto">
            @forelse($latestPosts ?? [] as $post)
            <div class="w-full sm:w-[320px] md:w-[350px] max-w-[360px] bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 group flex flex-col">
                <div class="h-48 bg-gray-100 relative overflow-hidden">
                    @if($post->thumbnail && file_exists(public_path('storage/' . $post->thumbnail)))
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/10 to-primary/20 text-primary">
                            <svg class="w-12 h-12 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4 bg-primary/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                        {{ $post->category ?? 'Berita' }}
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <p class="text-xs text-gray-400 mb-2">{{ $post->created_at->translatedFormat('d F Y') }}</p>
                    <h3 class="text-xl font-display font-bold text-gray-900 mb-3 group-hover:text-primary transition line-clamp-2">
                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 100) }}
                    </p>
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-primary font-bold hover:text-secondary flex items-center gap-1 transition text-sm mt-auto">
                        Baca selengkapnya 
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="w-full py-8 text-center text-gray-500">
                Belum ada berita terbaru yang dipublikasikan.
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="/berita" class="inline-block px-6 py-3 rounded-full border-2 border-secondary text-secondary font-bold hover:bg-secondary hover:text-white transition duration-300">Lihat Semua Berita</a>
        </div>
    </div>
</section>
@endsection
