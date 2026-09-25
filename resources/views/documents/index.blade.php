@extends('layouts.public')

@section('title', 'Dokumen & Repositori - STIKES Muhammadiyah Wonosobo')

@section('content')
<div class="bg-primary py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">Repositori Dokumen</h1>
        <p class="text-lg text-primary-100 max-w-2xl mx-auto opacity-90">Akses dokumen publik, surat keputusan, panduan akademik, dan sertifikat akreditasi secara transparan.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Filter Bar -->
    <form method="GET" action="{{ route('documents.index') }}" class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div class="w-full md:w-1/3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama dokumen..." class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2 border">
        </div>
        <div class="flex gap-2 w-full md:w-auto">
            <select name="category" onchange="this.form.submit()" class="rounded-lg border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2 border w-full md:w-auto">
                <option value="">Semua Kategori</option>
                <option value="Akademik" {{ request('category') == 'Akademik' ? 'selected' : '' }}>Panduan Akademik</option>
                <option value="Surat Keputusan" {{ request('category') == 'Surat Keputusan' ? 'selected' : '' }}>Surat Keputusan</option>
                <option value="Akreditasi" {{ request('category') == 'Akreditasi' ? 'selected' : '' }}>Sertifikat Akreditasi</option>
                <option value="Umum" {{ request('category') == 'Umum' ? 'selected' : '' }}>Umum</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary/90 transition text-sm">Filter</button>
            @if(request('search') || request('category'))
                <a href="{{ route('documents.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition text-sm">Reset</a>
            @endif
        </div>
    </form>

    <!-- Document Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Dokumen</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Diperbarui</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($documents as $doc)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-red-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $doc->title }}</div>
                                    @if($doc->description)
                                    <div class="text-xs text-gray-500">{{ Str::limit($doc->description, 60) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $doc->category ?? 'Umum' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $doc->updated_at->translatedFormat('d F Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('documents.download', $doc) }}" class="text-primary hover:text-secondary inline-flex items-center font-bold">
                                <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> Unduh
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            Belum ada dokumen yang dipublikasikan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($documents->hasPages())
        <div class="p-4 border-t border-gray-200">
            {{ $documents->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
