@extends('layouts.admin')

@section('title', 'Kelola Tanggal Gelombang PMB')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-display font-bold text-secondary">Pengaturan Tanggal Gelombang PMB</h2>
            <p class="text-sm text-gray-500 mt-1">
                Atur rentang tanggal mulai dan selesai untuk 5 Gelombang Pendaftaran. Tanggal ini menentukan jadwal pendaftaran aktif di beranda dan formulir PMB online.
            </p>
        </div>
        @php
            $activeWave = \App\Models\PmbWave::getActiveWave();
        @endphp
        @if($activeWave)
            <div class="bg-primary/10 border border-primary/20 rounded-2xl px-4 py-2.5 text-xs text-primary font-bold shrink-0 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></span>
                <span>Aktif Hari Ini: <strong>{{ $activeWave->nama_gelombang }}</strong> ({{ $activeWave->tanggal_mulai->translatedFormat('d M') }} – {{ $activeWave->tanggal_selesai->translatedFormat('d M Y') }})</span>
            </div>
        @endif
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-2xl text-green-800 text-sm font-bold flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form Edit Waves -->
    <form action="{{ route('admin.pmb_waves.update') }}" method="POST">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6">
                <div class="space-y-6">
                    @foreach($waves as $wave)
                        @php
                            $today = now()->timezone('Asia/Jakarta')->toDateString();
                            $isCurrentActive = $wave->is_active && ($wave->tanggal_mulai->toDateString() <= $today && $wave->tanggal_selesai->toDateString() >= $today);
                        @endphp
                        
                        <div class="p-5 rounded-2xl border transition {{ $isCurrentActive ? 'bg-primary/5 border-primary/30 ring-2 ring-primary/20' : 'bg-gray-50/50 border-gray-200' }}">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-3 h-3 rounded-full {{ $isCurrentActive ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                    <h3 class="font-display font-extrabold text-secondary text-lg">
                                        {{ $wave->nama_gelombang }}
                                    </h3>
                                    @if($isCurrentActive)
                                        <span class="px-3 py-0.5 rounded-full text-xxs font-extrabold bg-green-100 text-green-800 border border-green-300">
                                            ● SEDANG BERLANGSUNG HARI INI
                                        </span>
                                    @endif
                                </div>

                                <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-gray-700">
                                    <input type="checkbox" 
                                           name="waves[{{ $wave->id }}][is_active]" 
                                           value="1" 
                                           {{ old("waves.{$wave->id}.is_active", $wave->is_active) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary/20 w-4 h-4">
                                    <span>Aktifkan Gelombang Ini</span>
                                </label>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Tanggal Mulai Pendaftaran</label>
                                    <input type="date" 
                                           name="waves[{{ $wave->id }}][tanggal_mulai]" 
                                           value="{{ old("waves.{$wave->id}.tanggal_mulai", $wave->tanggal_mulai->format('Y-m-d')) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm font-medium"
                                           required>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Tanggal Selesai Pendaftaran</label>
                                    <input type="date" 
                                           name="waves[{{ $wave->id }}][tanggal_selesai]" 
                                           value="{{ old("waves.{$wave->id}.tanggal_selesai", $wave->tanggal_selesai->format('Y-m-d')) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm font-medium"
                                           required>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Floating Submit Button Footer -->
        <div class="sticky bottom-6 mt-8 bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-4 border border-gray-200 flex items-center justify-between gap-4">
            <div class="text-xs text-gray-500 hidden sm:block">
                💡 Perubahan rentang tanggal akan otomatis mengatur status Gelombang di Beranda dan Formulir PMB.
            </div>
            <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-primary hover:bg-primary/90 text-white font-extrabold rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <span>Simpan Tanggal Gelombang</span>
            </button>
        </div>

    </form>

</div>
@endsection
