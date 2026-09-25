<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Peserta Lulus Seleksi PMB - STIKES Muhammadiyah Wonosobo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #000;
            background: #fff;
        }

        /* === PRINT CONTROLS (only visible on screen) === */
        .print-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            background: #7c1010;
            padding: 14px 24px;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .print-controls h1 {
            color: #fff;
            font-size: 14px;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }
        .print-controls .controls-right {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        .print-controls select, .print-controls a {
            font-family: Arial, sans-serif;
            font-size: 12px;
            padding: 6px 14px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
        .print-controls select {
            border: 1px solid #ddd;
            background: #fff;
        }
        .btn-print {
            background: #f5c400;
            color: #1a1a1a;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-back {
            background: rgba(255,255,255,0.15);
            color: #fff;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        /* === DOCUMENT AREA === */
        .document {
            max-width: 900px;
            margin: 24px auto;
            padding: 24px;
        }

        /* === LETTERHEAD === */
        .letterhead {
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 3px solid #7c1010;
            padding-bottom: 14px;
            margin-bottom: 6px;
        }
        .letterhead img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }
        .letterhead-text .kampus-name {
            font-size: 16pt;
            font-weight: bold;
            color: #7c1010;
            line-height: 1.2;
            font-family: Arial, sans-serif;
        }
        .letterhead-text .kampus-sub {
            font-size: 9pt;
            color: #555;
            margin-top: 2px;
        }
        .letterhead-text .kampus-alamat {
            font-size: 8.5pt;
            color: #777;
            margin-top: 3px;
        }

        /* === DOCUMENT TITLE === */
        .doc-title {
            text-align: center;
            margin: 20px 0 18px;
        }
        .doc-title h2 {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: underline;
        }
        .doc-title p {
            font-size: 10pt;
            margin-top: 4px;
            color: #333;
        }

        /* === FILTER INFO === */
        .filter-info {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            background: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px 16px;
            margin-bottom: 20px;
            font-size: 9.5pt;
        }
        .filter-info span { color: #555; }
        .filter-info strong { color: #7c1010; }

        /* === SUMMARY STATS === */
        .stats-row {
            display: flex;
            gap: 14px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .stat-card {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px 18px;
            text-align: center;
            min-width: 120px;
            flex: 1;
        }
        .stat-card .stat-num {
            font-size: 22pt;
            font-weight: bold;
            color: #7c1010;
            line-height: 1;
        }
        .stat-card .stat-label {
            font-size: 8pt;
            color: #666;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* === TABLE === */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
            margin-bottom: 24px;
        }
        thead tr {
            background: #7c1010;
            color: white;
        }
        thead th {
            padding: 8px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 8.5pt;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        tbody tr:nth-child(even) { background: #fafafa; }
        tbody tr:hover { background: #fff3f3; }
        tbody td {
            padding: 7px 8px;
            border-bottom: 1px solid #ececec;
            vertical-align: top;
        }
        .no-col { width: 30px; text-align: center; }
        .nm-col { font-weight: bold; }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 7.5pt;
            font-weight: bold;
        }
        .badge-farmasi { background: #dbeafe; color: #1e40af; }
        .badge-gizi    { background: #dcfce7; color: #166534; }
        .badge-gel     { background: #fef3c7; color: #92400e; }

        /* === SIGNATURE === */
        .signature-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }
        .signature-box {
            text-align: center;
            width: 220px;
        }
        .signature-box p { font-size: 10pt; }
        .signature-box .sign-space {
            height: 65px;
            border-bottom: 1px solid #333;
            margin: 6px 0;
        }
        .signature-box .sign-name {
            font-weight: bold;
            font-size: 10pt;
            text-decoration: underline;
        }

        /* === FOOTER === */
        .doc-footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px dashed #ccc;
            font-size: 8pt;
            color: #999;
            display: flex;
            justify-content: space-between;
        }

        /* === PRINT MEDIA === */
        @media print {
            .print-controls { display: none !important; }
            .document { margin: 0; padding: 16px; max-width: 100%; }
            tbody tr:hover { background: transparent; }
            .stat-card { border: 1px solid #ccc; }
            thead tr { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }

        @page {
            size: A4 landscape;
            margin: 1.5cm;
        }
    </style>
</head>
<body>

<!-- Print Controls (hidden when printing) -->
<div class="print-controls">
    <h1>📄 Cetak Rekap Peserta Lulus Seleksi</h1>
    <div class="controls-right">
        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.pmb.print_rekap') }}" style="display:flex;gap:8px;align-items:center;">
            <select name="prodi" onchange="this.form.submit()" style="font-size:12px;padding:6px 10px;border-radius:8px;border:1px solid #ccc;">
                <option value="">Semua Prodi</option>
                @foreach(\App\Models\ProgramStudi::orderBy('kode_nim')->get() as $ps)
                <option value="{{ $ps->nama_prodi }}" {{ $filterProdi === $ps->nama_prodi ? 'selected' : '' }}>{{ $ps->nama_prodi }}</option>
                @endforeach
            </select>
            <select name="gelombang" onchange="this.form.submit()" style="font-size:12px;padding:6px 10px;border-radius:8px;border:1px solid #ccc;">
                <option value="">Semua Gelombang</option>
                @foreach(\App\Models\PmbWave::orderBy('id', 'asc')->get() as $w)
                    <option value="{{ $w->nama_gelombang }}" {{ $filterGelombang === $w->nama_gelombang ? 'selected' : '' }}>{{ $w->nama_gelombang }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('admin.pmb.index') }}" class="btn-back">← Kembali</a>
        <a href="javascript:window.print()" class="btn-print">🖨️ Cetak / Simpan PDF</a>
    </div>
</div>

<div class="document">

    <!-- LETTERHEAD -->
    <div class="letterhead">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo STIKESMU" onerror="this.style.display='none'">
        <div class="letterhead-text">
            <div class="kampus-name">STIKES MUHAMMADIYAH WONOSOBO</div>
            <div class="kampus-sub">Sekolah Tinggi Ilmu Kesehatan Muhammadiyah Wonosobo</div>
            <div class="kampus-alamat">Jl. Lingkar Selatan KM. 02, Jogoyitnan, Wonosobo, Jawa Tengah | Email: stikesmuhammadiyahwsb@gmail.com | WA: 0895-3852-50680</div>
        </div>
    </div>

    <!-- DOCUMENT TITLE -->
    <div class="doc-title">
        <h2>Rekap Peserta Lulus Seleksi PMB</h2>
        <p>
            Penerimaan Mahasiswa Baru (PMB) T.A. 2026/2027 —
            Prodi: <strong>{{ $filterProdi === 'Semua' ? 'Semua Program Studi' : $filterProdi }}</strong> |
            Gelombang: <strong>{{ $filterGelombang === 'Semua' ? 'Semua Gelombang' : $filterGelombang }}</strong>
        </p>
        <p style="font-size:8.5pt;color:#888;margin-top:4px;">Dicetak pada: {{ now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</p>
    </div>

    <!-- STATS -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-num">{{ $totalLulus }}</div>
            <div class="stat-label">Total Lulus Seleksi</div>
        </div>
        @foreach($byProdi as $prodi => $data)
            <div class="stat-card">
                <div class="stat-num">{{ $data->count() }}</div>
                <div class="stat-label">{{ $prodi }}</div>
            </div>
        @endforeach
        @foreach($byGelombang as $gel => $data)
            <div class="stat-card">
                <div class="stat-num">{{ $data->count() }}</div>
                <div class="stat-label">{{ $gel ?: 'Tanpa Gelombang' }}</div>
            </div>
        @endforeach
    </div>

    <!-- FILTER INFO -->
    <div class="filter-info">
        <span>Filter Aktif:</span>
        <span>Prodi: <strong>{{ $filterProdi === 'Semua' ? 'Semua Program Studi' : $filterProdi }}</strong></span>
        <span>Gelombang: <strong>{{ $filterGelombang === 'Semua' ? 'Semua Gelombang' : $filterGelombang }}</strong></span>
        <span>Status: <strong>Lulus Seleksi</strong></span>
        <span>Jumlah Data: <strong>{{ $totalLulus }} pendaftar</strong></span>
    </div>

    <!-- MAIN TABLE -->
    @if($registrations->isEmpty())
        <div style="text-align:center;padding:40px;color:#999;border:1px dashed #ccc;border-radius:8px;">
            <p style="font-size:12pt;">Tidak ada data pendaftar yang lulus seleksi dengan filter yang dipilih.</p>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th class="no-col">No.</th>
                    <th>NIM Resmi</th>
                    <th>No. Pendaftaran</th>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>Program Studi</th>
                    <th>Gelombang</th>
                    <th>Status Bayar</th>
                    <th>No. HP/WA</th>
                    <th>Tgl Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $i => $reg)
                    <tr>
                        <td class="no-col" style="text-align:center;">{{ $i + 1 }}</td>
                        <td style="font-family:monospace;font-size:9.5pt;font-weight:bold;color:#0e7040;">{{ $reg->nim ?? '-' }}</td>
                        <td style="font-family:monospace;font-size:8.5pt;font-weight:bold;color:#555;">{{ $reg->nomor_pendaftaran }}</td>
                        <td class="nm-col">
                            {{ $reg->nama_lengkap }}
                            <br><span style="font-weight:normal;font-size:8pt;color:#888;">{{ $reg->tempat_lahir }}, {{ \Carbon\Carbon::parse($reg->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                        </td>
                        <td style="font-family:monospace;font-size:8.5pt;">{{ $reg->nomor_ktp }}</td>
                        <td>
                            <span class="badge badge-farmasi">
                                {{ $reg->prodi }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-gel">{{ $reg->gelombang ?: 'Tanpa Gelombang' }}</span>
                        </td>
                        <td>
                            <span class="badge" style="background-color: #d1fae5; color: #065f46; font-weight: bold;">
                                {{ $reg->status_pembayaran_daftar_ulang ?? 'Belum Bayar' }}
                            </span>
                        </td>
                        <td style="font-size:8.5pt;">{{ $reg->no_hp }}</td>
                        <td style="font-size:8pt;color:#666;white-space:nowrap;">{{ $reg->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- SIGNATURE -->
        <div class="signature-section">
            <div class="signature-box">
                <p>Wonosobo, {{ now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') }}</p>
                <p>Panitia PMB STIKESMU Wonosobo</p>
                <div class="sign-space"></div>
                <div class="sign-name">(_________________________)</div>
                <p style="font-size:8.5pt;color:#555;margin-top:3px;">Ketua Panitia PMB</p>
            </div>
        </div>
    @endif

    <!-- FOOTER -->
    <div class="doc-footer">
        <span>STIKES Muhammadiyah Wonosobo — Dokumen ini dicetak oleh sistem secara otomatis.</span>
        <span>Total: {{ $totalLulus }} Peserta Lulus Seleksi</span>
    </div>

</div>

</body>
</html>
