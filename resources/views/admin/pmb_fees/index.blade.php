@extends('layouts.admin')

@section('title', 'Kelola Rincian Biaya PMB')

@section('content')
<div x-data="{ activeProdi: 'S1 Farmasi' }" class="space-y-6">

    <!-- Header Section -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-display font-bold text-secondary">Pengaturan Rincian Biaya PMB</h2>
            <p class="text-sm text-gray-500 mt-1">
                Atur nominal rincian biaya daftar ulang per Program Studi dan per Gelombang. Data ini akan ditampilkan secara otomatis pada halaman <strong>Cek Status Pendaftaran</strong> pendaftar yang lulus seleksi.
            </p>
        </div>
        <div class="flex items-center gap-2 bg-gray-100 p-1.5 rounded-2xl border border-gray-200 shrink-0">
            @foreach($prodis as $prodi)
                <button type="button" 
                        @click="activeProdi = '{{ $prodi }}'" 
                        :class="activeProdi === '{{ $prodi }}' ? 'bg-primary text-white shadow-md' : 'text-gray-600 hover:text-gray-900'"
                        class="px-5 py-2 rounded-xl text-sm font-bold transition duration-200">
                    {{ $prodi }}
                </button>
            @endforeach
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-2xl text-green-800 text-sm font-bold flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form Edit Fees -->
    <form action="{{ route('admin.pmb_fees.update') }}" method="POST">
        @csrf

        @foreach($prodis as $prodi)
            <div x-show="activeProdi === '{{ $prodi }}'" x-transition.opacity class="space-y-6">
                
                <div class="grid grid-cols-1 gap-6">
                    @foreach($gelombangs as $gelombang)
                        @php
                            $feeItem = $existingFees[$prodi][$gelombang] ?? null;
                            $reg  = $feeItem ? $feeItem->biaya_registrasi : 0;
                            $ukt  = $feeItem ? $feeItem->ukt_semester_1 : 0;
                            $jas  = $feeItem ? $feeItem->jas_almamater : 0;
                            $osmb = $feeItem ? $feeItem->osmb : 0;
                            $ktm  = $feeItem ? $feeItem->ktm : 0;
                            $total = $reg + $ukt + $jas + $osmb + $ktm;
                        @endphp
                        
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="w-3 h-3 rounded-full bg-primary"></span>
                                    <h3 class="font-display font-bold text-secondary text-base">
                                        {{ $prodi }} — <span class="text-primary">{{ $gelombang }}</span>
                                    </h3>
                                </div>
                                <div class="text-xs text-gray-500 font-medium">
                                    Estimasi Total: <strong class="text-secondary font-mono text-sm">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                                </div>
                            </div>

                            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Biaya Registrasi (Rp)</label>
                                    <input type="number" 
                                           name="fees[{{ $prodi }}][{{ $gelombang }}][biaya_registrasi]" 
                                           value="{{ old("fees.$prodi.$gelombang.biaya_registrasi", $reg) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm font-mono font-semibold"
                                           required min="0">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">UKT Semester 1 (Rp)</label>
                                    <input type="number" 
                                           name="fees[{{ $prodi }}][{{ $gelombang }}][ukt_semester_1]" 
                                           value="{{ old("fees.$prodi.$gelombang.ukt_semester_1", $ukt) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm font-mono font-semibold"
                                           required min="0">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Jas Almamater (Rp)</label>
                                    <input type="number" 
                                           name="fees[{{ $prodi }}][{{ $gelombang }}][jas_almamater]" 
                                           value="{{ old("fees.$prodi.$gelombang.jas_almamater", $jas) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm font-mono font-semibold"
                                           required min="0">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">OSMB (Rp)</label>
                                    <input type="number" 
                                           name="fees[{{ $prodi }}][{{ $gelombang }}][osmb]" 
                                           value="{{ old("fees.$prodi.$gelombang.osmb", $osmb) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm font-mono font-semibold"
                                           required min="0">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">KTM (Rp)</label>
                                    <input type="number" 
                                           name="fees[{{ $prodi }}][{{ $gelombang }}][ktm]" 
                                           value="{{ old("fees.$prodi.$gelombang.ktm", $ktm) }}" 
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm font-mono font-semibold"
                                           required min="0">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        @endforeach

        <!-- Floating Submit Button Footer -->
        <div class="sticky bottom-6 mt-8 bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-4 border border-gray-200 flex items-center justify-between gap-4">
            <div class="text-xs text-gray-500 hidden sm:block">
                💡 Perubahan biaya akan langsung diperbarui di halaman Cek Status Pendaftaran publik.
            </div>
            <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-primary hover:bg-primary/90 text-white font-extrabold rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <span>Simpan Pengaturan Biaya</span>
            </button>
        </div>

    </form>

</div>
@endsection
