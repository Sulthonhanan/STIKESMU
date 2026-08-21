@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <!-- Total Berita -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Total Berita</p>
            <p class="text-3xl font-display font-bold text-gray-900">{{ \App\Models\Post::count() ?? 0 }}</p>
        </div>
    </div>

    <!-- Total Dokumen -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-accent/20 flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Total Dokumen</p>
            <p class="text-3xl font-display font-bold text-gray-900">{{ \App\Models\Document::count() ?? 0 }}</p>
        </div>
    </div>

    <!-- Total Pengguna -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium">Total Pengguna</p>
            <p class="text-3xl font-display font-bold text-gray-900">{{ \App\Models\User::count() }}</p>
        </div>
    </div>

    <!-- Akreditasi -->
    <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl p-6 shadow-sm flex items-center gap-4 text-white">
        <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center flex-shrink-0">
            <svg class="w-7 h-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
        </div>
        <div>
            <p class="text-white/70 text-sm font-medium">Akreditasi BAN-PT</p>
            <p class="text-2xl font-display font-bold text-accent">Baik Sekali</p>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-lg font-display font-bold text-gray-800 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('admin.posts.create') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-primary/5 hover:bg-primary/10 border border-primary/20 text-primary text-sm font-semibold transition text-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Tambah Berita
            </a>
            <a href="{{ route('admin.documents.create') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-accent/10 hover:bg-accent/20 border border-accent/30 text-yellow-700 text-sm font-semibold transition text-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                Upload Dokumen
            </a>
            <a href="{{ route('admin.users.create') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 text-sm font-semibold transition text-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                Tambah Pengguna
            </a>
            <a href="/" target="_blank" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-600 text-sm font-semibold transition text-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                Lihat Website
            </a>
        </div>
    </div>

    <!-- System Info -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h2 class="text-lg font-display font-bold text-gray-800 mb-4">Informasi Sistem</h2>
        <ul class="space-y-3 text-sm">
            <li class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-gray-500">Versi Laravel</span>
                <span class="font-semibold text-gray-800">{{ app()->version() }}</span>
            </li>
            <li class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-gray-500">Versi PHP</span>
                <span class="font-semibold text-gray-800">{{ PHP_VERSION }}</span>
            </li>
            <li class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-gray-500">Database</span>
                <span class="font-semibold text-gray-800">PostgreSQL</span>
            </li>
            <li class="flex justify-between items-center py-2">
                <span class="text-gray-500">Environment</span>
                <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ config('app.env') === 'production' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ strtoupper(config('app.env')) }}
                </span>
            </li>
        </ul>
    </div>
</div>
@endsection
