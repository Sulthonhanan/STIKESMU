@extends('layouts.admin')
@section('title', 'Kelola Program Studi')
@section('content')

{{-- Flash Messages --}}
@if(session('success'))
<div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm font-medium">
    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    {{ session('success') }}
</div>
@endif

<div class="flex justify-between items-center mb-6">
    <div>
        <p class="text-gray-500 text-sm">Kelola master data program studi. Perubahan di sini otomatis memperbarui formulir PMB, generator NIM, dan halaman publik.</p>
    </div>
    <a href="{{ route('admin.program-studi.create') }}" class="inline-flex items-center gap-2 bg-primary text-white px-4 py-2.5 rounded-xl font-semibold hover:bg-primary/80 transition text-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Tambah Program Studi
    </a>
</div>

{{-- Info Banner --}}
<div class="mb-6 bg-blue-50 border border-blue-200 rounded-2xl p-4 flex gap-3 items-start">
    <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    <div class="text-sm text-blue-800">
        <strong>Catatan Penting:</strong> Kode NIM (4 digit) bersifat <strong>unik dan permanen</strong> setelah ada mahasiswa yang terdaftar. Mengubah Kode NIM dapat menyebabkan inkonsistensi data. Pastikan kode sudah benar sebelum membuka pendaftaran.
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
    @forelse($programStudis as $prodi)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition">
        {{-- Thumbnail / Banner --}}
        <div class="h-36 bg-gradient-to-br from-primary/20 to-secondary/10 relative overflow-hidden">
            @if($prodi->thumbnail)
                <img src="{{ Storage::url($prodi->thumbnail) }}" alt="{{ $prodi->nama_prodi }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-primary/40">
                    <svg class="w-14 h-14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </div>
            @endif
            {{-- Status Badge --}}
            <div class="absolute top-3 right-3">
                @if($prodi->is_active)
                <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full border border-green-200 shadow-sm">● Aktif PMB</span>
                @else
                <span class="px-2.5 py-1 bg-gray-100 text-gray-500 text-xs font-bold rounded-full border border-gray-200 shadow-sm">○ Nonaktif</span>
                @endif
            </div>
            {{-- Jenjang Badge --}}
            <div class="absolute top-3 left-3">
                <span class="px-2.5 py-1 bg-white/90 backdrop-blur text-primary text-xs font-bold rounded-full border border-primary/20">{{ $prodi->jenjang }}</span>
            </div>
        </div>

        <div class="p-5 flex-grow flex flex-col">
            <div class="mb-3">
                <h3 class="text-lg font-display font-bold text-gray-900 leading-tight">{{ $prodi->nama_prodi }}</h3>
                @if($prodi->gelar)
                <p class="text-sm text-primary font-semibold mt-0.5">Gelar: {{ $prodi->gelar }}</p>
                @endif
            </div>

            <div class="grid grid-cols-2 gap-2 mb-4 text-xs">
                <div class="bg-gray-50 rounded-lg px-3 py-2">
                    <p class="text-gray-500">Kode NIM</p>
                    <p class="font-bold font-mono text-gray-800 text-sm">{{ $prodi->kode_nim }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg px-3 py-2">
                    <p class="text-gray-500">Akreditasi</p>
                    <p class="font-bold text-gray-800 truncate">{{ $prodi->akreditasi ?? '-' }}</p>
                </div>
            </div>

            @if($prodi->deskripsi)
            <p class="text-xs text-gray-500 line-clamp-2 mb-4 flex-grow">{{ $prodi->deskripsi }}</p>
            @endif

            <div class="flex items-center justify-between gap-2 mt-auto pt-3 border-t border-gray-100">
                {{-- Toggle Active --}}
                <form action="{{ route('admin.program-studi.toggle_active', $prodi) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="text-xs font-semibold px-3 py-1.5 rounded-lg border transition
                        {{ $prodi->is_active ? 'border-red-200 text-red-600 bg-red-50 hover:bg-red-100' : 'border-green-200 text-green-600 bg-green-50 hover:bg-green-100' }}">
                        {{ $prodi->is_active ? 'Nonaktifkan' : 'Aktifkan PMB' }}
                    </button>
                </form>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.program-studi.edit', $prodi) }}" class="text-xs font-semibold text-primary hover:underline px-3 py-1.5 bg-primary/10 rounded-lg hover:bg-primary/20 transition">Edit</a>
                    <form action="{{ route('admin.program-studi.destroy', $prodi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus prodi {{ $prodi->nama_prodi }}? Data yang terhubung (PMB, NIM) bisa terdampak!')">
                        @csrf @method('DELETE')
                        <button class="text-xs font-semibold text-red-500 hover:underline px-3 py-1.5 bg-red-50 rounded-lg hover:bg-red-100 transition">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-16 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
        </div>
        <p class="text-gray-700 font-semibold mb-1">Belum Ada Program Studi</p>
        <p class="text-gray-500 text-sm mb-4">Tambahkan program studi pertama untuk mulai menggunakan sistem PMB.</p>
        <a href="{{ route('admin.program-studi.create') }}" class="inline-block px-5 py-2.5 bg-primary text-white rounded-xl font-semibold text-sm hover:bg-primary/80 transition">Tambah Program Studi</a>
    </div>
    @endforelse
</div>
@endsection
