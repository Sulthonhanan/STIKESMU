@extends('layouts.admin')

@section('title', 'Pendaftar PMB')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    
    <!-- Header & Filter Bar -->
    <div class="p-6 border-b border-gray-100 bg-gray-50/50">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-xl font-display font-bold text-secondary">Daftar Pendaftar PMB</h2>
                <p class="text-xs text-gray-500 mt-0.5">Penerimaan Mahasiswa Baru T.A. 2026/2027</p>
            </div>
            <a href="{{ route('admin.pmb.print_rekap') }}" target="_blank"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl text-sm shadow-md transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Rekap Lulus Seleksi
            </a>
        </div>
        <form method="GET" action="{{ route('admin.pmb.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <!-- Search -->
            <div class="relative md:col-span-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau Nomor Pendaftaran..." class="pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm">
            </div>

            <!-- Prodi Filter -->
            <div>
                <select name="prodi" onchange="this.form.submit()" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm">
                    <option value="">Semua Program Studi</option>
                    <option value="S1 Farmasi" {{ request('prodi') === 'S1 Farmasi' ? 'selected' : '' }}>S1 Farmasi</option>
                    <option value="S1 Gizi" {{ request('prodi') === 'S1 Gizi' ? 'selected' : '' }}>S1 Gizi</option>
                </select>
            </div>

            <!-- Gelombang Filter -->
            <div>
                <select name="gelombang" onchange="this.form.submit()" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm">
                    <option value="">Semua Gelombang</option>
                    <option value="Gelombang 1" {{ request('gelombang') === 'Gelombang 1' ? 'selected' : '' }}>Gelombang 1 (Juli)</option>
                    <option value="Gelombang 2" {{ request('gelombang') === 'Gelombang 2' ? 'selected' : '' }}>Gelombang 2 (Agustus)</option>
                    <option value="Gelombang 3" {{ request('gelombang') === 'Gelombang 3' ? 'selected' : '' }}>Gelombang 3 (September)</option>
                    <option value="Gelombang 4" {{ request('gelombang') === 'Gelombang 4' ? 'selected' : '' }}>Gelombang 4 (Oktober)</option>
                    <option value="Gelombang 5" {{ request('gelombang') === 'Gelombang 5' ? 'selected' : '' }}>Gelombang 5 (November)</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div class="flex gap-2">
                <select name="status" onchange="this.form.submit()" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-sm">
                    <option value="">Semua Status</option>
                    <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Lulus Seleksi" {{ request('status') === 'Lulus Seleksi' ? 'selected' : '' }}>Lulus Seleksi</option>
                    <option value="Tidak Lulus Seleksi" {{ request('status') === 'Tidak Lulus Seleksi' ? 'selected' : '' }}>Tidak Lulus Seleksi</option>
                </select>
                
                @if(request()->anyFilled(['search', 'prodi', 'status', 'gelombang']))
                    <a href="{{ route('admin.pmb.index') }}" class="px-3 py-2 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 flex items-center justify-center transition" title="Reset Filter">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.283 8H18" /></svg>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No. Pendaftaran</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Program Studi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Gelombang</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No. HP / WA</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tgl Daftar</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($registrations as $reg)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-primary font-mono">
                            <a href="{{ route('admin.pmb.show', $reg->id) }}" class="hover:underline">
                                {{ $reg->nomor_pendaftaran }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">{{ $reg->nama_lengkap }}</div>
                            <div class="text-xs text-gray-500">NIK: {{ $reg->nomor_ktp }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <div class="font-semibold text-gray-900">{{ $reg->prodi }}</div>
                            <div class="text-xs text-red-800 font-medium">{{ $reg->jalur_seleksi ?? 'Jalur Nilai Rapor' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $gelombangColors = [
                                    'Gelombang 1' => 'bg-blue-100 text-blue-800',
                                    'Gelombang 2' => 'bg-purple-100 text-purple-800',
                                    'Gelombang 3' => 'bg-orange-100 text-orange-800',
                                    'Gelombang 4' => 'bg-teal-100 text-teal-800',
                                    'Gelombang 5' => 'bg-pink-100 text-pink-800',
                                ];
                                $gc = $gelombangColors[$reg->gelombang] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $gc }}">
                                {{ $reg->gelombang ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $reg->no_hp) }}" target="_blank" class="flex items-center gap-1 text-primary hover:underline font-medium">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.884-6.97C16.538 1.967 14.09 1.937 11.4 1.937c-5.437 0-9.863 4.373-9.868 9.803-.001 1.748.47 3.447 1.365 4.966l-.994 3.633 3.734-.969zm13.167-9.21c-.244-.122-1.444-.712-1.668-.793-.223-.08-.386-.12-.55.122-.162.243-.63.793-.772.955-.143.162-.285.182-.529.06-2.03-.976-3.197-2.03-3.926-3.264-.194-.332-.03-.512.097-.643.115-.118.257-.3.385-.45.128-.15.17-.255.256-.425.085-.17.042-.317-.02-.439-.062-.122-.55-1.32-.753-1.81-.197-.475-.398-.411-.55-.419-.153-.008-.328-.01-.502-.01-.174 0-.457.065-.696.324-.24.26-1.166 1.139-1.166 2.776 0 1.637 1.2 3.216 1.363 3.435.163.22 2.36 3.565 5.717 4.997 2.793 1.19 3.36 1.012 3.97.955.613-.057 1.444-.588 1.648-1.155.203-.566.203-1.052.142-1.153-.06-.101-.223-.162-.467-.284z"/></svg>
                                {{ $reg->no_hp }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                            {{ $reg->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($reg->status === 'Lulus Seleksi')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                    Lulus Seleksi
                                </span>
                            @elseif($reg->status === 'Tidak Lulus Seleksi')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                    Tidak Lulus
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-semibold flex items-center justify-center gap-2">
                            <!-- Detail -->
                            <a href="{{ route('admin.pmb.show', $reg->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-xl transition" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </a>
                            
                            <!-- Delete -->
                            <form action="{{ route('admin.pmb.destroy', $reg->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftar ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-xl transition" title="Hapus Data">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500 font-medium">
                            Tidak ada data pendaftar ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($registrations->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $registrations->links() }}
        </div>
    @endif

</div>
@endsection
