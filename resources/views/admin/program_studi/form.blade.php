@extends('layouts.admin')
@section('title', isset($programStudi) ? 'Edit Program Studi' : 'Tambah Program Studi')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.program-studi.index') }}" class="text-gray-500 hover:text-primary transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <h2 class="text-xl font-display font-bold text-gray-800">
            {{ isset($programStudi) ? 'Edit: ' . $programStudi->nama_prodi : 'Tambah Program Studi Baru' }}
        </h2>
    </div>

    <form action="{{ isset($programStudi) ? route('admin.program-studi.update', $programStudi) : route('admin.program-studi.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if(isset($programStudi)) @method('PUT') @endif

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-800">
            <p class="font-bold mb-2">Terdapat {{ $errors->count() }} kesalahan input:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Identitas Prodi --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-base font-bold text-gray-800 mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                Identitas Program Studi
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Program Studi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_prodi" value="{{ old('nama_prodi', $programStudi->nama_prodi ?? '') }}" required
                        class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border"
                        placeholder="Contoh: S1 Farmasi, D3 Kebidanan, Profesi Ners">
                    @error('nama_prodi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jenjang <span class="text-red-500">*</span></label>
                    <select name="jenjang" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border" required>
                        @foreach(['S1', 'D3', 'D4', 'Profesi'] as $j)
                        <option value="{{ $j }}" {{ old('jenjang', $programStudi->jenjang ?? 'S1') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                    @error('jenjang')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gelar Kelulusan</label>
                    <input type="text" name="gelar" value="{{ old('gelar', $programStudi->gelar ?? '') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border"
                        placeholder="Contoh: S.Farm, S.Gz, S.Kep, Ns.">
                    @error('gelar')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Kode NIM (4 Digit) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kode_nim" value="{{ old('kode_nim', $programStudi->kode_nim ?? '') }}"
                        required maxlength="4" pattern="[0-9]{4}"
                        class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border font-mono"
                        placeholder="Contoh: 0101 (Farmasi), 0301 (Keperawatan)">
                    <p class="text-xs text-amber-600 mt-1 font-medium">⚠ Kode ini digunakan sebagai bagian dari NIM resmi mahasiswa. Pastikan unik dan tidak berubah setelah ada mahasiswa terdaftar.</p>
                    @error('kode_nim')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kode DIKTI/PDDIKTI</label>
                    <input type="text" name="kode_dikti" value="{{ old('kode_dikti', $programStudi->kode_dikti ?? '') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border font-mono"
                        placeholder="Contoh: 48201">
                    @error('kode_dikti')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status Akreditasi</label>
                    <select name="akreditasi" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border">
                        @foreach(['Unggul', 'Baik Sekali', 'Baik', 'B', 'C', 'Belum Terakreditasi'] as $akr)
                        <option value="{{ $akr }}" {{ old('akreditasi', $programStudi->akreditasi ?? 'Baik Sekali') == $akr ? 'selected' : '' }}>{{ $akr }}</option>
                        @endforeach
                    </select>
                    @error('akreditasi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status Buka di PMB</label>
                    <select name="is_active" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border">
                        <option value="1" {{ old('is_active', $programStudi->is_active ?? 1) == '1' ? 'selected' : '' }}>✅ Aktif (Menerima Pendaftaran)</option>
                        <option value="0" {{ old('is_active', $programStudi->is_active ?? 1) == '0' ? 'selected' : '' }}>❌ Nonaktif (Tidak Menerima Pendaftaran)</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Profil Akademik --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-base font-bold text-gray-800 mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Profil Akademik (Tampil di Website Publik)
            </h3>
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border text-sm"
                        placeholder="Tuliskan deskripsi singkat profil program studi...">{{ old('deskripsi', $programStudi->deskripsi ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Visi Program Studi</label>
                    <textarea name="visi" rows="3" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border text-sm"
                        placeholder="Tuliskan visi program studi...">{{ old('visi', $programStudi->visi ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Misi Program Studi</label>
                    <textarea name="misi" rows="3" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border text-sm"
                        placeholder="Tuliskan misi program studi...">{{ old('misi', $programStudi->misi ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Prospek Karir Lulusan</label>
                    <textarea name="prospek_karir" rows="3" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring-primary shadow-sm px-4 py-2.5 border text-sm"
                        placeholder="Contoh: Apotek, Rumah Sakit, BPOM, Industri Farmasi, Wirausaha...">{{ old('prospek_karir', $programStudi->prospek_karir ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Foto / Banner Program Studi</label>
                    @if(isset($programStudi) && $programStudi->thumbnail && file_exists(public_path('storage/' . $programStudi->thumbnail)))
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $programStudi->thumbnail) }}" alt="{{ $programStudi->nama_prodi }}"
                            class="h-36 rounded-xl object-cover border shadow-sm">
                        <p class="text-xs text-gray-500 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                    </div>
                    @endif
                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full rounded-xl border-gray-300 shadow-sm px-4 py-2.5 border text-sm">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP. Maks 2MB. Disarankan foto laboratorium atau kegiatan perkuliahan.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.program-studi.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-white font-semibold hover:bg-primary/80 transition">
                {{ isset($programStudi) ? 'Simpan Perubahan' : 'Tambah Program Studi' }}
            </button>
        </div>
    </form>
</div>
@endsection
