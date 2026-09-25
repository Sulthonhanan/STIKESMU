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
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Isi Berita & Konten Multimedia <span class="text-red-500">*</span></label>
                        <span class="text-xs text-gray-400">Mendukung Paragraf, Gambar, Tabel, & Video YouTube</span>
                    </div>

                    <!-- Guidance Info -->
                    <div class="mb-3 bg-blue-50 border border-blue-200 rounded-xl p-3 text-xs text-blue-800 flex items-start gap-2">
                        <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <div>
                            <strong>Tips Menyisipkan Media:</strong>
                            <ul class="list-disc list-inside mt-0.5 space-y-0.5 text-blue-700">
                                <li><strong>Video:</strong> Klik ikon <svg class="w-3.5 h-3.5 inline text-gray-700" viewBox="0 0 18 18"><rect class="ql-stroke" height="12" width="12" x="3" y="3"></rect><path class="ql-fill" d="M7 6l5 3-5 3z"></path></svg> pada toolbar lalu tempel link YouTube/Vimeo (contoh: <code>https://www.youtube.com/watch?v=...</code>).</li>
                                <li><strong>Gambar:</strong> Klik ikon gambar <svg class="w-3.5 h-3.5 inline text-gray-700" viewBox="0 0 18 18"><rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect><circle class="ql-fill" cx="6" cy="7" r="1"></circle><polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline></svg> untuk mengunggah foto langsung dari laptop ke dalam isi berita.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Quill Container -->
                    <div class="bg-white rounded-xl border border-gray-300 overflow-hidden shadow-sm">
                        <div id="editor-container" class="min-h-[350px] text-gray-800 text-base">
                            {!! old('body', $post->body ?? '') !!}
                        </div>
                    </div>
                    <!-- Hidden textarea that stores HTML for form submission -->
                    <textarea name="body" id="body" class="hidden">{{ old('body', $post->body ?? '') }}</textarea>
                    @error('body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Foto Utama (Thumbnail Sampul)</label>
                    @if(isset($post) && $post->thumbnail && file_exists(public_path('storage/' . $post->thumbnail)))
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" class="h-36 rounded-xl object-cover border shadow-sm">
                            <p class="text-xs text-gray-500 mt-1">Thumbnail saat ini. Upload foto baru untuk mengganti.</p>
                        </div>
                    @endif
                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border text-sm">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP. Maks 2MB. Tampil di halaman depan berita.</p>
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

<!-- Quill Styles & Scripts -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow {
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
        border-color: #e5e7eb;
        background-color: #f9fafb;
    }
    .ql-container.ql-snow {
        border-bottom-left-radius: 0.75rem;
        border-bottom-right-radius: 0.75rem;
        border-color: #e5e7eb;
        font-family: inherit;
    }
    .ql-editor {
        min-height: 350px;
        font-size: 1rem;
        line-height: 1.75;
    }
    .ql-editor iframe.ql-video {
        width: 100%;
        max-width: 680px;
        height: 380px;
        border-radius: 0.75rem;
        margin: 1rem 0;
    }
    .ql-editor img {
        border-radius: 0.75rem;
        margin: 1rem 0;
        max-width: 100%;
    }
</style>
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Tulis isi artikel/berita di sini... Anda bisa mengetik teks, menempel gambar, atau menyisipkan video YouTube.',
            modules: {
                toolbar: {
                    container: [
                        [{ 'header': [1, 2, 3, 4, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['blockquote', 'code-block'],
                        ['link', 'image', 'video'],
                        ['clean']
                    ],
                    handlers: {
                        image: imageHandler
                    }
                }
            }
        });

        // Custom Image Handler for uploading directly to server
        function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = async () => {
                const file = input.files[0];
                if (file) {
                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    try {
                        const response = await fetch('{{ route('admin.posts.upload_image') }}', {
                            method: 'POST',
                            body: formData
                        });
                        const result = await response.json();
                        if (result.url) {
                            const range = quill.getSelection(true);
                            quill.insertEmbed(range.index, 'image', result.url);
                        } else {
                            alert('Gagal mengunggah gambar. Silakan coba lagi.');
                        }
                    } catch (error) {
                        console.error('Upload error:', error);
                        alert('Terjadi kesalahan saat mengunggah gambar.');
                    }
                }
            };
        }

        // Sync Quill HTML content to hidden textarea
        const bodyInput = document.getElementById('body');
        quill.on('text-change', function () {
            bodyInput.value = quill.root.innerHTML;
        });

        // Form Submit listener
        const form = document.querySelector('form');
        form.addEventListener('submit', function () {
            bodyInput.value = quill.root.innerHTML;
        });
    });
</script>
@endsection
