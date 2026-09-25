@extends('layouts.admin')

@section('title', 'Kelola Gelombang PMB')

@section('content')
<div class="space-y-6" x-data="{ showAddModal: false }">

    <!-- Header Section -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-display font-bold text-secondary">Pengaturan Gelombang PMB</h2>
            <p class="text-sm text-gray-500 mt-1">
                Atur jumlah gelombang pendaftaran, nama gelombang, serta rentang tanggal aktif pendaftaran PMB online.
            </p>
        </div>
        
        <div class="flex items-center gap-3">
            @php
                $activeWave = \App\Models\PmbWave::getActiveWave();
            @endphp
            @if($activeWave)
                <div class="bg-primary/10 border border-primary/20 rounded-2xl px-4 py-2 text-xs text-primary font-bold shrink-0 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></span>
                    <span>Aktif: <strong>{{ $activeWave->nama_gelombang }}</strong></span>
                </div>
            @endif

            <button type="button" @click="showAddModal = true" class="px-5 py-2.5 bg-primary hover:bg-primary/95 text-white font-bold text-sm rounded-xl shadow-md flex items-center gap-2 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                <span>Tambah Gelombang</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-2xl text-green-800 text-sm font-bold flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form Edit All Waves -->
    <form action="{{ route('admin.pmb_waves.update') }}" method="POST">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6">
                <div class="space-y-6">
                    @forelse($waves as $index => $wave)
                        @php
                            $today = now()->timezone('Asia/Jakarta')->toDateString();
                            $isCurrentActive = $wave->is_active && ($wave->tanggal_mulai->toDateString() <= $today && $wave->tanggal_selesai->toDateString() >= $today);
                        @endphp
                        
                        <div class="p-5 rounded-2xl border transition {{ $isCurrentActive ? 'bg-primary/5 border-primary/30 ring-2 ring-primary/20' : 'bg-gray-50/50 border-gray-200' }}">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                                <div class="flex items-center gap-3 flex-1">
                                    <span class="w-3 h-3 rounded-full {{ $isCurrentActive ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                    <div class="w-full max-w-xs">
                                        <input type="text" 
                                               name="waves[{{ $wave->id }}][nama_gelombang]" 
                                               value="{{ old("waves.{$wave->id}.nama_gelombang", $wave->nama_gelombang) }}" 
                                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-base font-extrabold text-secondary py-1.5 px-3"
                                               required>
                                    </div>
                                    @if($isCurrentActive)
                                        <span class="px-3 py-1 rounded-full text-xxs font-extrabold bg-green-100 text-green-800 border border-green-300 shrink-0">
                                            ● BERLANGSUNG
                                        </span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-4">
                                    <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-gray-700 select-none">
                                        <input type="checkbox" 
                                               name="waves[{{ $wave->id }}][is_active]" 
                                               value="1" 
                                               {{ old("waves.{$wave->id}.is_active", $wave->is_active) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring w-4 h-4">
                                        <span>Status Aktif</span>
                                    </label>

                                    <!-- Tombol Hapus Gelombang -->
                                    <button type="button" 
                                            onclick="if(confirm('Yakin ingin menghapus {{ $wave->nama_gelombang }}?')) { document.getElementById('delete-wave-{{ $wave->id }}').submit(); }"
                                            class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition"
                                            title="Hapus Gelombang">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Tanggal Mulai Pendaftaran</label>
                                    <input type="date" 
                                           name="waves[{{ $wave->id }}][tanggal_mulai]" 
                                           value="{{ old("waves.{$wave->id}.tanggal_mulai", $wave->tanggal_mulai->format('Y-m-d')) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-sm font-medium"
                                           required>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Tanggal Selesai Pendaftaran</label>
                                    <input type="date" 
                                           name="waves[{{ $wave->id }}][tanggal_selesai]" 
                                           value="{{ old("waves.{$wave->id}.tanggal_selesai", $wave->tanggal_selesai->format('Y-m-d')) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-sm font-medium"
                                           required>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-400">
                            <p class="font-bold">Belum ada gelombang pendaftaran.</p>
                            <p class="text-xs mt-1">Klik tombol "+ Tambah Gelombang" di atas untuk membuat gelombang baru.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        @if($waves->count() > 0)
        <!-- Floating Submit Button Footer -->
        <div class="sticky bottom-6 mt-8 bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-4 border border-gray-200 flex items-center justify-between gap-4">
            <div class="text-xs text-gray-500 hidden sm:block">
                💡 Jumlah gelombang dan rentang tanggal akan otomatis mengatur jadwal di Beranda dan Formulir PMB Online.
            </div>
            <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-primary hover:bg-primary/90 text-white font-extrabold rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <span>Simpan Seluruh Perubahan Gelombang</span>
            </button>
        </div>
        @endif

    </form>

    <!-- Hidden Delete Forms -->
    @foreach($waves as $wave)
        <form id="delete-wave-{{ $wave->id }}" action="{{ route('admin.pmb_waves.destroy', $wave->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

    <!-- MODAL TAMBAH GELOMBANG BARU -->
    <div x-show="showAddModal" 
         x-transition.opacity.duration.300ms
         style="display: none;" 
         class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-gray-100 transform transition-all"
             @click.away="showAddModal = false">
            
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    </div>
                    <h3 class="font-display font-extrabold text-secondary text-lg">Tambah Gelombang Baru</h3>
                </div>
                <button type="button" @click="showAddModal = false" class="text-gray-400 hover:text-gray-600 p-1.5 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <form action="{{ route('admin.pmb_waves.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Nama Gelombang <span class="text-red-500">*</span></label>
                    <input type="text" 
                           name="nama_gelombang" 
                           value="Gelombang {{ $waves->count() + 1 }}" 
                           placeholder="Contoh: Gelombang {{ $waves->count() + 1 }} atau Gelombang Khusus" 
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-sm font-bold" 
                           required>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" 
                               name="tanggal_mulai" 
                               value="{{ date('Y-m-d') }}" 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-sm font-medium" 
                               required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Tanggal Selesai <span class="text-red-500">*</span></label>
                        <input type="date" 
                               name="tanggal_selesai" 
                               value="{{ date('Y-m-d', strtotime('+30 days')) }}" 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring text-sm font-medium" 
                               required>
                    </div>
                </div>

                <div class="pt-2">
                    <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-gray-700 select-none">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring w-4 h-4">
                        <span>Aktifkan gelombang ini langsung</span>
                    </label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                    <button type="button" @click="showAddModal = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-sm rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-primary hover:bg-primary/95 text-white font-extrabold text-sm rounded-xl shadow-md transition flex items-center gap-2">
                        <span>Tambah Gelombang</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

