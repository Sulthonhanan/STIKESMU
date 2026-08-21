@extends('layouts.public')

@section('title', 'Detail Berita - STIKES Muhammadiyah Wonosobo')

@section('content')
<div class="bg-gray-50 py-12 border-b border-gray-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('posts.index') }}" class="text-primary hover:text-secondary inline-flex items-center mb-6 font-medium transition">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali ke Daftar Berita
        </a>
        
        <span class="inline-block bg-primary/10 text-primary text-sm font-bold px-3 py-1 rounded-full mb-4">Pengumuman</span>
        <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 leading-tight mb-6">Jadwal Seleksi PMB Gelombang 1 Tahun Akademik 2026/2027</h1>
        
        <div class="flex items-center text-gray-500 text-sm">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            20 Juni 2026
            <span class="mx-3">•</span>
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            Oleh: Panitia PMB
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Featured Image -->
    <div class="w-full h-64 md:h-96 bg-gray-200 rounded-3xl mb-12 shadow-lg overflow-hidden">
        <!-- Image placeholder -->
    </div>

    <!-- Content -->
    <article class="prose prose-lg prose-primary max-w-none text-gray-700">
        <p>Pemberitahuan kepada seluruh calon mahasiswa baru STIKES Muhammadiyah Wonosobo yang telah melakukan pendaftaran pada gelombang pertama. Mengingat antusiasme pendaftar yang sangat tinggi, panitia PMB telah menetapkan jadwal seleksi Computer Based Test (CBT).</p>
        
        <p>Ujian akan dilaksanakan secara *offline* di lab komputer kampus terpadu dengan mematuhi standar operasional prosedur yang berlaku.</p>

        <h3>Jadwal Pelaksanaan</h3>
        <ul>
            <li><strong>Hari/Tanggal:</strong> Senin, 29 Juni 2026</li>
            <li><strong>Waktu:</strong> 08:00 WIB - Selesai</li>
            <li><strong>Lokasi:</strong> Laboratorium Komputer CBT Center, Gedung B Lantai 3</li>
        </ul>

        <h3>Persyaratan Ujian</h3>
        <p>Setiap peserta diwajibkan membawa persyaratan sebagai berikut saat hari pelaksanaan ujian:</p>
        <ol>
            <li>Kartu Bukti Pendaftaran (dicetak dari sistem PMB).</li>
            <li>Kartu Identitas Diri (KTP/Kartu Pelajar).</li>
            <li>Alat tulis (pensil, pulpen).</li>
            <li>Memakai pakaian rapi dan sopan (berkemeja, tidak memakai kaos oblong atau sandal).</li>
        </ol>

        <p>Bagi peserta yang mengalami kendala dalam mencetak kartu ujian, silakan menghubungi *helpdesk* PMB melalui nomor WhatsApp yang tertera pada brosur pendaftaran.</p>
        <p>Demikian pengumuman ini disampaikan agar dapat menjadi perhatian. Atas kerja samanya, kami ucapkan terima kasih.</p>
    </article>
</div>
@endsection
