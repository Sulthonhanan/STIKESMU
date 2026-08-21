@extends('layouts.public')

@section('title', 'Pilihan Jalur Seleksi - PMB STIKESMU Wonosobo')

@section('content')
<section class="py-16 md:py-24 bg-gradient-to-b from-gray-50 to-white min-h-screen flex items-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block py-1.5 px-4 rounded-full bg-primary/10 text-primary font-bold text-xs uppercase tracking-wider mb-4 border border-primary/20">
                Penerimaan Mahasiswa Baru 2026/2027
            </span>
            <h1 class="text-3xl md:text-5xl font-display font-extrabold text-secondary mb-6 leading-tight">
                Pilihan Jalur Seleksi
            </h1>
            <p class="text-gray-600 text-base md:text-lg leading-relaxed mb-4">
                <span class="font-bold text-gray-800">Mulai Perjalananmu di STIKES Muhammadiyah Wonosobo.</span> Apapun jalur yang kamu pilih, STIKESMU siap mendampingi langkahmu menjadi <span class="font-bold text-secondary">lulusan berkarakter, profesional, dan berdaya saing global.</span>
            </p>
            <p class="text-primary font-extrabold text-lg">
                Daftar Sekarang dan Wujudkan Mimipimu di STIKESMU Wonosobo!
            </p>
        </div>

        @php
            $jalurList = [
                [
                    'id' => 'Jalur Nilai Rapor',
                    'nama' => 'Jalur Nilai Rapor',
                    'desc' => 'Seleksi pendaftaran berbasis prestasi akademik menggunakan rerata Nilai Rapor Semester 1 s.d. 5.',
                    'badge' => 'Tanpa Tes Tertulis',
                    'color' => 'from-red-900 via-red-800 to-red-950',
                    'hover' => 'hover:shadow-red-900/30',
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
                ],
                [
                    'id' => 'Jalur CBT',
                    'nama' => 'Jalur CBT',
                    'desc' => 'Seleksi melalui Ujian Berbasis Komputer (Computer Based Test) online maupun di kampus.',
                    'badge' => 'Hasil Instant',
                    'color' => 'from-red-900 via-red-800 to-red-950',
                    'hover' => 'hover:shadow-red-900/30',
                    'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
                ],
                [
                    'id' => 'Jalur SKL',
                    'nama' => 'Jalur SKL',
                    'desc' => 'Seleksi khusus menggunakan Surat Keterangan Lulus (SKL) atau Ijazah SMA/SMK/MA sederajat.',
                    'badge' => 'Lulusan Terbaru',
                    'color' => 'from-red-900 via-red-800 to-red-950',
                    'hover' => 'hover:shadow-red-900/30',
                    'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'
                ],
                [
                    'id' => 'Jalur Nilai UTBK-SNBT',
                    'nama' => 'Jalur Nilai UTBK-SNBT',
                    'desc' => 'Seleksi berbasis Nilai Hasil Sertifikat UTBK SNBT Kemendikbudristek tahun berjalan.',
                    'badge' => 'Bebas Tes',
                    'color' => 'from-red-900 via-red-800 to-red-950',
                    'hover' => 'hover:shadow-red-900/30',
                    'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'
                ]
            ];
        @endphp

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($jalurList as $jalur)
                <a href="{{ route('pmb.create', ['jalur' => $jalur['id']]) }}" class="group relative rounded-3xl p-8 bg-gradient-to-br {{ $jalur['color'] }} text-white shadow-xl hover:shadow-2xl {{ $jalur['hover'] }} transition-all duration-300 transform hover:-translate-y-2 flex flex-col justify-between overflow-hidden min-h-[260px] border border-white/10">
                    
                    <!-- Decorative Flower Badge Icon top right -->
                    <div class="absolute top-6 right-6 text-white/40 group-hover:text-white/80 transition duration-300">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 3a7 7 0 110 14 7 7 0 010-14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8" />
                        </svg>
                    </div>

                    <!-- Top Content -->
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-6 border border-white/20">
                            <svg class="w-6 h-6 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $jalur['icon'] }}" />
                            </svg>
                        </div>
                        <span class="inline-block px-3 py-1 rounded-full text-xxs font-bold uppercase tracking-wider bg-white/20 text-yellow-200 backdrop-blur-sm mb-3">
                            {{ $jalur['badge'] }}
                        </span>
                        <h3 class="text-2xl font-display font-extrabold text-white leading-snug mb-3 group-hover:text-yellow-300 transition">
                            {{ $jalur['nama'] }}
                        </h3>
                        <p class="text-white/80 text-xs leading-relaxed line-clamp-3">
                            {{ $jalur['desc'] }}
                        </p>
                    </div>

                    <!-- Bottom Action -->
                    <div class="mt-8 pt-4 border-t border-white/15 flex items-center justify-between text-xs font-extrabold text-yellow-300">
                        <span>Pilih Jalur Ini</span>
                        <span class="w-8 h-8 rounded-full bg-white/10 group-hover:bg-accent group-hover:text-secondary flex items-center justify-center transition duration-300">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </div>

                </a>
            @endforeach
        </div>

        <!-- Extra Help Note -->
        <div class="mt-16 text-center bg-gray-50 rounded-2xl p-6 border border-gray-200 max-w-2xl mx-auto">
            <p class="text-sm text-gray-600">
                Bingung memilih jalur yang tepat? Hubungi Layanan Konsultasi PMB STIKESMU via WhatsApp: 
                <a href="https://wa.me/62895385250680?text=Halo%20Admin%20PMB,%20saya%20butuh%20bantuan%20memilih%20Jalur%20Seleksi." target="_blank" class="font-bold text-primary hover:underline">
                    +62 895-3852-50680
                </a>
            </p>
        </div>

    </div>
</section>
@endsection
