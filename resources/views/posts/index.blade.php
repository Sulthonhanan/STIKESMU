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
    <!-- Filter & Search Bar -->
    <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
        <div class="w-full md:w-1/3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau topik berita..." class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border text-sm">
        </div>
        <div class="flex flex-wrap gap-2 w-full md:w-auto">
            <select name="category" onchange="this.form.submit()" class="rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border text-sm w-full sm:w-auto">
                <option value="">Semua Kategori</option>
                <option value="Pengumuman" {{ request('category') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                <option value="Akademik" {{ request('category') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                <option value="Kegiatan" {{ request('category') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                <option value="Prestasi" {{ request('category') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                <option value="Umum" {{ request('category') == 'Umum' ? 'selected' : '' }}>Umum</option>
            </select>
            <button type="submit" class="px-5 py-2.5 bg-primary text-white rounded-xl font-semibold hover:bg-primary/90 transition text-sm">Cari</button>
            @if(request('search') || request('category'))
                <a href="{{ route('posts.index') }}" class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition text-sm">Reset</a>
            @endif
        </div>
    </form>

    <!-- Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
        <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100 hover:shadow-xl transition duration-300 flex flex-col group">
            <div class="h-52 bg-gray-100 relative overflow-hidden">
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
                <p class="text-xs text-gray-400 mb-2 flex items-center gap-1">
                    <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    {{ $post->created_at->translatedFormat('d F Y') }}
                </p>
                <h3 class="text-xl font-display font-bold text-gray-900 mb-3 group-hover:text-primary transition line-clamp-2">
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                </h3>
                <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-3">
                    {{ $post->excerpt ?? Str::limit(strip_tags($post->body), 120) }}
                </p>
                <a href="{{ route('posts.show', $post->slug) }}" class="text-primary font-bold hover:text-secondary inline-flex items-center mt-auto text-sm">
                    Baca selengkapnya <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center">
            <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Belum Ada Berita</h3>
            <p class="text-sm text-gray-500">Saat ini belum ada berita atau artikel yang dipublikasikan.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
    <div class="mt-12">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
