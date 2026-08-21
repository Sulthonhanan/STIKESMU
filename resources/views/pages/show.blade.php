@extends('layouts.public')

@section('title', 'Profil Institusi - STIKES Muhammadiyah Wonosobo')

@section('content')
<!-- Page Header -->
<div class="relative bg-secondary overflow-hidden py-20">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-display font-bold text-white mb-4 capitalize">Sejarah & Visi Misi</h1>
        <div class="w-24 h-1 bg-accent mx-auto rounded-full"></div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <article class="prose prose-lg prose-primary max-w-none text-gray-700 bg-white p-8 md:p-12 rounded-3xl shadow-xl -mt-24 relative z-20 border border-gray-100">
        
        <h2>Sejarah Singkat</h2>
        <p>STIKES Muhammadiyah Wonosobo didirikan sebagai bentuk nyata kepedulian Persyarikatan Muhammadiyah terhadap peningkatan derajat kesehatan masyarakat, khususnya di wilayah Wonosobo dan sekitarnya. Perjalanan panjang institusi ini berawal dari semangat untuk mencetak tenaga kesehatan yang tidak hanya kompeten secara keilmuan, tetapi juga memiliki akhlak mulia berlandaskan nilai-nilai Al-Islam dan Kemuhammadiyahan.</p>
        
        <p>Seiring dengan perkembangan zaman dan kebutuhan akan tenaga profesional kesehatan, STIKESMU terus berbenah dan meningkatkan kualitas akademik serta fasilitas penunjang pendidikan.</p>

        <hr class="my-8">

        <h2>Visi</h2>
        <blockquote class="border-l-4 border-accent bg-gray-50 italic text-xl font-medium p-6 rounded-r-lg text-secondary">
            "Menjadi Institusi Pendidikan Tinggi Kesehatan yang Unggul, Islami, dan Berdaya Saing Global pada Tahun 2030."
        </blockquote>

        <h2>Misi</h2>
        <ol class="space-y-2 mt-4">
            <li>Menyelenggarakan pendidikan dan pengajaran yang berkualitas, inovatif, dan relevan dengan perkembangan IPTEK kesehatan berdasarkan nilai-nilai Islam.</li>
            <li>Melaksanakan penelitian dasar dan terapan di bidang kesehatan yang bermanfaat bagi masyarakat dan pengembangan ilmu pengetahuan.</li>
            <li>Melaksanakan pengabdian kepada masyarakat dalam upaya meningkatkan derajat kesehatan masyarakat sebagai wujud dakwah <em>amar ma'ruf nahi munkar</em>.</li>
            <li>Mengembangkan tata kelola institusi yang baik (<em>good university governance</em>) secara berkelanjutan.</li>
            <li>Menjalin kemitraan strategis dengan berbagai institusi di tingkat nasional maupun internasional untuk mewujudkan keunggulan dan daya saing.</li>
        </ol>

        <hr class="my-8">

        <h2>Struktur Organisasi</h2>
        <p>Dalam menjalankan roda kepemimpinan dan kegiatan akademik, STIKES Muhammadiyah Wonosobo dikelola dengan pembagian tata kerja yang jelas dan akuntabel guna mewujudkan tata kelola perguruan tinggi yang baik (<em>good university governance</em>).</p>
        
        <div class="my-6 rounded-2xl overflow-hidden shadow-lg border border-gray-200 bg-gray-50 p-2">
            <img src="{{ asset('images/struktur_organisasi.jpg') }}" alt="Struktur Organisasi STIKESMU" class="w-full h-auto object-contain rounded-xl">
        </div>

        <p class="text-sm text-gray-500 italic text-center mb-6">Bagan Struktur Organisasi STIKES Muhammadiyah Wonosobo</p>

        <p>Struktur organisasi dipimpin oleh <strong>Ketua STIKES</strong> (Drs. H. Rohmadi, M.Kes) yang berkoordinasi secara aktif bersama Badan Pembina Harian (BPH) dan Senat Akademik. Dalam operasionalnya, Ketua dibantu oleh tiga Wakil Ketua (Wakil Ketua I Bidang Akademik, Wakil Ketua II Bidang Keuangan & Kepegawaian, dan Wakil Ketua III Bidang Kemahasiswaan & Humas) serta didukung oleh lembaga penjaminan mutu (LPM, LP3M), jajaran administrasi, laboratorium, perpustakaan, hingga jajaran pimpinan program studi.</p>

    </article>
</div>
@endsection
