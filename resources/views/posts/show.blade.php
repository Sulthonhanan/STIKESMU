@extends('layouts.public')

@section('title', $post->title . ' - STIKES Muhammadiyah Wonosobo')

@section('content')
<div class="bg-gray-50 py-12 border-b border-gray-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('posts.index') }}" class="text-primary hover:text-secondary inline-flex items-center mb-6 font-medium transition">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali ke Daftar Berita
        </a>
        
        <span class="inline-block bg-primary/10 text-primary text-sm font-bold px-3.5 py-1 rounded-full mb-4">
            {{ $post->category ?? 'Berita' }}
        </span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-display font-bold text-gray-900 leading-tight mb-6">
            {{ $post->title }}
        </h1>
        
        <div class="flex flex-wrap items-center text-gray-500 text-sm gap-y-2">
            <div class="flex items-center mr-4">
                <svg class="w-5 h-5 mr-1.5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                {{ $post->created_at->translatedFormat('d F Y') }}
            </div>
            <span class="mx-2 hidden sm:inline">•</span>
            <div class="flex items-center mr-4">
                <svg class="w-5 h-5 mr-1.5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                Penulis: {{ $post->user->name ?? 'Humas STIKESMU' }}
            </div>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Featured Image (Thumbnail) -->
    @if($post->thumbnail && file_exists(public_path('storage/' . $post->thumbnail)))
    <div class="w-full max-h-[480px] bg-gray-100 rounded-3xl mb-10 shadow-lg overflow-hidden border border-gray-100">
        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
    </div>
    @endif

    <!-- Content / Body -->
    <article class="prose prose-lg prose-primary max-w-none text-gray-700 leading-relaxed font-sans post-content">
        {!! $post->body !!}
    </article>

    <!-- Share & Footer -->
    <div class="mt-12 pt-8 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
        <span class="text-sm font-semibold text-gray-500">Bagikan artikel ini:</span>
        <div class="flex items-center gap-3">
            <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="px-4 py-2 bg-green-50 text-green-700 rounded-full font-semibold text-sm hover:bg-green-100 transition flex items-center gap-1.5 border border-green-200">
                WhatsApp
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="px-4 py-2 bg-blue-50 text-blue-700 rounded-full font-semibold text-sm hover:bg-blue-100 transition flex items-center gap-1.5 border border-blue-200">
                Facebook
            </a>
        </div>
    </div>

    <!-- Recent Posts Section -->
    @if(isset($recentPosts) && $recentPosts->count() > 0)
    <div class="mt-16 pt-12 border-t-2 border-gray-100">
        <h3 class="text-2xl font-display font-bold text-gray-900 mb-8">Berita & Informasi Lainnya</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($recentPosts as $recent)
            <a href="{{ route('posts.show', $recent->slug) }}" class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition flex gap-4 items-start group">
                @if($recent->thumbnail)
                <img src="{{ Storage::url($recent->thumbnail) }}" alt="{{ $recent->title }}" class="w-24 h-24 rounded-xl object-cover shrink-0">
                @else
                <div class="w-24 h-24 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                    <svg class="w-8 h-8 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                </div>
                @endif
                <div>
                    <span class="text-xs font-bold text-primary">{{ $recent->category ?? 'Berita' }}</span>
                    <h4 class="font-bold text-gray-900 group-hover:text-primary transition line-clamp-2 mt-1">{{ $recent->title }}</h4>
                    <span class="text-xs text-gray-400 mt-2 block">{{ $recent->created_at->translatedFormat('d M Y') }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

<style>
    /* Styling for embedded media in post body */
    .post-content iframe {
        width: 100% !important;
        max-width: 100% !important;
        aspect-ratio: 16 / 9;
        height: auto !important;
        min-height: 280px;
        border-radius: 1rem;
        margin: 1.5rem 0;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    }
    .post-content img {
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        margin: 1.5rem auto;
        max-width: 100%;
        height: auto;
    }
    .post-content blockquote {
        border-left: 4px solid var(--color-primary, #059669);
        padding-left: 1rem;
        font-style: italic;
        color: #4b5563;
        background-color: #f9fafb;
        padding: 0.75rem 1rem;
        border-radius: 0 0.75rem 0.75rem 0;
    }
</style>
@endsection
