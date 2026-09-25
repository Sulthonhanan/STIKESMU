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
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">
            {{ $programStudis->count() }} program studi unggulan yang siap mencetak tenaga kesehatan profesional, Islami, dan berdaya saing global.
        </p>
        <div class="w-24 h-1 bg-accent mx-auto rounded-full mt-6"></div>
    </div>
</div>

@forelse($programStudis as $loop_prodi)
<!-- Prodi Section -->
<section class="py-20 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col {{ $loop->even ? 'lg:flex-row-reverse' : 'lg:flex-row' }} items-center gap-12">
            <!-- Image / Banner -->
            <div class="lg:w-1/2 relative">
                <div class="absolute -inset-4 bg-gradient-to-tr from-primary/20 to-primary/5 rounded-[2rem] {{ $loop->even ? '-rotate-3' : 'rotate-3' }}"></div>
                <div class="relative bg-gray-100 rounded-[2rem] overflow-hidden shadow-2xl h-80 lg:h-96">
                    @if($loop_prodi->thumbnail)
                        <img src="{{ asset('storage/' . $loop_prodi->thumbnail) }}" alt="{{ $loop_prodi->nama_prodi }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" class="w-full h-full object-cover">
                    @endif
                    <div class="flex items-center justify-center h-full bg-gradient-to-br from-primary/10 to-secondary/20" @if($loop_prodi->thumbnail) style="display:none;" @endif>
                        <div class="text-center px-8">
                            <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <p class="text-gray-500 font-display font-bold text-xl">{{ $loop_prodi->nama_prodi }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="lg:w-1/2">
                <span class="inline-block py-1 px-3 rounded-full bg-primary/10 text-primary font-semibold text-sm mb-2">
                    Program {{ $loop_prodi->jenjang }}
                </span>
                @if($loop_prodi->akreditasi)
                <span class="inline-block py-1 px-3 rounded-full bg-accent/20 text-secondary font-semibold text-sm mb-2 ml-2">
                    Akreditasi: {{ $loop_prodi->akreditasi }}
                </span>
                @endif
                <h2 class="text-3xl md:text-4xl font-display font-bold text-secondary mb-2 mt-2">
                    {{ $loop_prodi->nama_prodi }}
                </h2>
                @if($loop_prodi->gelar)
                <p class="text-primary font-semibold mb-4">Gelar: {{ $loop_prodi->gelar }}</p>
                @endif

                @if($loop_prodi->deskripsi)
                <p class="text-gray-600 mb-6 leading-relaxed">{{ $loop_prodi->deskripsi }}</p>
                @endif

                @if($loop_prodi->visi)
                <div class="mb-4 bg-primary/5 border-l-4 border-primary rounded-r-xl p-4">
                    <h4 class="font-bold text-gray-800 text-sm mb-1 flex items-center gap-1">
                        <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        Visi
                    </h4>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $loop_prodi->visi }}</p>
                </div>
                @endif

                @if($loop_prodi->prospek_karir)
                <h3 class="text-lg font-display font-bold text-gray-800 mb-3 mt-5">Prospek Karir Lulusan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 mb-6">
                    @foreach(explode(',', $loop_prodi->prospek_karir) as $karir)
                    <div class="flex items-start gap-2.5 bg-gray-50 rounded-xl p-3.5 border border-gray-100">
                        <svg class="w-4 h-4 text-primary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm text-gray-700">{{ trim($karir) }}</span>
                    </div>
                    @endforeach
                </div>
                @endif

                <a href="{{ route('pmb.create') }}?jalur=Jalur+Nilai+Rapor" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-full font-bold hover:bg-primary/90 transition shadow-lg hover:shadow-primary/30">
                    Daftar ke {{ $loop_prodi->nama_prodi }}
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </a>
            </div>
        </div>
    </div>
</section>

@if(!$loop->last)
<div class="max-w-7xl mx-auto px-4"><hr class="border-gray-200"></div>
@endif

@empty
<!-- Fallback if no program studi yet -->
<section class="py-24 bg-white text-center">
    <div class="max-w-md mx-auto">
        <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-5">
            <svg class="w-10 h-10 text-primary opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Data Program Studi Belum Tersedia</h2>
        <p class="text-gray-500 text-sm">Silakan hubungi admin untuk informasi lebih lanjut.</p>
    </div>
</section>
@endforelse

<!-- CTA Daftar PMB -->
<section class="bg-gradient-to-r from-secondary to-primary py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-display font-bold text-white mb-4">Siap Bergabung Bersama Kami?</h2>
        <p class="text-gray-200 mb-8 text-lg">Daftarkan dirimu sekarang dan wujudkan impian menjadi tenaga kesehatan profesional.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('pmb.jalur') }}" class="px-8 py-4 rounded-full bg-white text-primary font-bold text-lg hover:bg-gray-100 transition duration-300 shadow-xl">
                Daftar PMB Online
            </a>
            <a href="{{ route('posts.index') }}" class="px-8 py-4 rounded-full bg-white/10 text-white font-bold text-lg hover:bg-white/20 backdrop-blur-sm border border-white/20 transition duration-300">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>
@endsection
