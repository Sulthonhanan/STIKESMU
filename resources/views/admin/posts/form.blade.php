@extends('layouts.admin')
@section('title', isset($post) ? 'Edit Berita' : 'Tambah Berita')
@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if(isset($post)) @method('PUT') @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-display font-bold text-gray-800 mb-6">Informasi Berita</h2>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Berita <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" required
                        class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border"
                        placeholder="Masukkan judul berita...">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori</label>
                        <select name="category" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border">
                            <option value="Pengumuman" {{ old('category', $post->category ?? '') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="Akademik" {{ old('category', $post->category ?? '') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                            <option value="Kegiatan" {{ old('category', $post->category ?? '') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="Prestasi" {{ old('category', $post->category ?? '') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                            <option value="Umum" {{ old('category', $post->category ?? '') == 'Umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status Publikasi</label>
                        <select name="is_published" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border">
                            <option value="0" {{ old('is_published', $post->is_published ?? 0) == '0' ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ old('is_published', $post->is_published ?? 0) == '1' ? 'selected' : '' }}>Dipublikasi</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ringkasan / Excerpt</label>
                    <textarea name="excerpt" rows="2" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border"
                        placeholder="Tulis ringkasan singkat berita (opsional)...">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Isi Berita <span class="text-red-500">*</span></label>
                    <textarea name="body" rows="12" required class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border font-mono text-sm"
                        placeholder="Tulis isi lengkap berita di sini...">{{ old('body', $post->body ?? '') }}</textarea>
                    @error('body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Foto Thumbnail</label>
                    @if(isset($post) && $post->thumbnail)
                        <img src="{{ Storage::url($post->thumbnail) }}" class="h-32 rounded-xl object-cover mb-3 border">
                    @endif
                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border text-sm">
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.posts.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-white font-semibold hover:bg-primary/80 transition">
                {{ isset($post) ? 'Simpan Perubahan' : 'Publikasikan Berita' }}
            </button>
        </div>
    </form>
</div>
@endsection
