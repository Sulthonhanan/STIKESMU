@extends('layouts.admin')
@section('title', isset($document) ? 'Edit Dokumen' : 'Upload Dokumen')
@section('content')
<div class="max-w-2xl mx-auto">
    <form action="{{ isset($document) ? route('admin.documents.update', $document) : route('admin.documents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if(isset($document)) @method('PUT') @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">
            <h2 class="text-lg font-display font-bold text-gray-800">Detail Dokumen</h2>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Dokumen <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $document->title ?? '') }}" required
                    class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border"
                    placeholder="Contoh: Pedoman Akademik 2026/2027">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border"
                    placeholder="Deskripsi singkat isi dokumen (opsional)...">{{ old('description', $document->description ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori</label>
                    <select name="category" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border">
                        <option value="Akademik" {{ old('category', $document->category ?? '') == 'Akademik' ? 'selected' : '' }}>Panduan Akademik</option>
                        <option value="Akreditasi" {{ old('category', $document->category ?? '') == 'Akreditasi' ? 'selected' : '' }}>Sertifikat Akreditasi</option>
                        <option value="Surat Keputusan" {{ old('category', $document->category ?? '') == 'Surat Keputusan' ? 'selected' : '' }}>Surat Keputusan</option>
                        <option value="Umum" {{ old('category', $document->category ?? '') == 'Umum' ? 'selected' : '' }}>Umum</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Visibilitas</label>
                    <select name="is_public" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border">
                        <option value="1" {{ old('is_public', $document->is_public ?? 1) == '1' ? 'selected' : '' }}>Publik (Bisa diunduh semua)</option>
                        <option value="0" {{ old('is_public', $document->is_public ?? 1) == '0' ? 'selected' : '' }}>Internal (Hanya Admin)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">File Dokumen (PDF) <span class="text-red-500">*</span></label>
                @if(isset($document) && $document->file_path)
                    <p class="text-sm text-green-600 mb-2">✓ File sudah ada. Upload baru untuk mengganti.</p>
                @endif
                <input type="file" name="file" accept=".pdf,.doc,.docx"
                    {{ !isset($document) ? 'required' : '' }}
                    class="w-full rounded-xl border-gray-300 shadow-sm px-4 py-2.5 border text-sm">
                <p class="text-xs text-gray-400 mt-1">Format: PDF, DOC, DOCX. Maks 10MB.</p>
                @error('file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.documents.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-white font-semibold hover:bg-primary/80 transition">
                {{ isset($document) ? 'Simpan Perubahan' : 'Upload Dokumen' }}
            </button>
        </div>
    </form>
</div>
@endsection
