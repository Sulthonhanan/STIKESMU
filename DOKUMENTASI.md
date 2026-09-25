# 📖 Dokumentasi Project Website STIKES Muhammadiyah Wonosobo

## 1. Deskripsi Project

**Nama Project:** Website Resmi & Sistem PMB Online STIKES Muhammadiyah Wonosobo  
**Framework:** Laravel 12 (PHP 8.2+)  
**Frontend:** Blade + Tailwind CSS + Vite  
**Auth:** Laravel Breeze + Spatie Laravel Permission  
**Database:** MySQL  

Aplikasi web ini berfungsi sebagai **website resmi** dan **sistem Penerimaan Mahasiswa Baru (PMB) Online** untuk STIKES Muhammadiyah Wonosobo. Sistem terdiri dari dua bagian utama:

1. **Frontend (Publik)** — Landing page, berita/artikel, dokumen publik, informasi program studi, dan formulir pendaftaran PMB online.
2. **Backend (Admin CMS)** — Panel admin untuk mengelola berita, dokumen, pengguna, program studi, pendaftaran PMB, gelombang pendaftaran, biaya, verifikasi pembayaran, serta integrasi API ke sistem SIA-STIKES (SIAKAD).

---

## 2. Tech Stack

| Layer        | Teknologi                                  |
|--------------|--------------------------------------------|
| Backend      | Laravel 12, PHP 8.2+                       |
| Frontend     | Blade Templates, Tailwind CSS, Vite        |
| Auth         | Laravel Breeze                             |
| Authorization| Spatie Laravel Permission (RBAC)            |
| Database     | MySQL                                      |
| File Storage | Laravel Filesystem (public disk)           |
| Integrasi    | HTTP API ke SIA-STIKES (SIAKAD)            |
| Dev Tools    | Laravel Pint, Pail, PHPUnit, Faker         |

---

## 3. Aktor / Role Pengguna

| Role                  | Deskripsi                                                                  |
|-----------------------|----------------------------------------------------------------------------|
| **Pengunjung (Guest)**| Akses halaman publik, berita, dokumen, informasi prodi, formulir PMB       |
| **Super Admin**       | Akses penuh ke seluruh fitur admin                                         |
| **Admin CMS**         | Kelola berita, dokumen, pengguna, dan program studi                        |
| **Staff Panitia PMB** | Kelola data pendaftar, ubah status seleksi, cetak rekap                    |
| **Staff Keuangan**    | Verifikasi pembayaran daftar ulang, generate NIM, sinkronisasi ke SIAKAD   |

---

## 4. Diagram UML

### 4.1 Use Case Diagram

```mermaid
flowchart LR
    subgraph Aktor
        Guest["👤 Pengunjung"]
        Admin["👔 Super Admin / Admin CMS"]
        PMB["📋 Staff Panitia PMB"]
        Keu["💰 Staff Keuangan"]
    end

    subgraph UC_Publik["Use Case — Website Publik"]
        UC1["Lihat Landing Page"]
        UC2["Lihat Berita / Artikel"]
        UC3["Download Dokumen"]
        UC4["Lihat Info Program Studi"]
        UC5["Daftar PMB Online"]
        UC6["Cek Status Pendaftaran"]
        UC7["Upload Bukti Pembayaran"]
        UC8["Cetak Formulir Pendaftaran"]
    end

    subgraph UC_Admin["Use Case — Admin CMS"]
        UC10["Dashboard Admin"]
        UC11["Kelola Berita (CRUD)"]
        UC12["Kelola Dokumen (CRUD)"]
        UC13["Kelola Pengguna & Role"]
        UC14["Kelola Program Studi"]
    end

    subgraph UC_PMB["Use Case — Manajemen PMB"]
        UC20["Lihat Daftar Pendaftar"]
        UC21["Lihat Detail Pendaftar"]
        UC22["Update Status Seleksi"]
        UC23["Kelola Gelombang PMB"]
        UC24["Kelola Biaya PMB"]
        UC25["Cetak Rekap Lulus Seleksi"]
        UC26["Verifikasi Pembayaran"]
        UC27["Generate NIM Mahasiswa"]
        UC28["Sync Data ke SIAKAD"]
        UC29["Hapus Pendaftar"]
    end

    Guest --> UC1
    Guest --> UC2
    Guest --> UC3
    Guest --> UC4
    Guest --> UC5
    Guest --> UC6
    Guest --> UC7
    Guest --> UC8

    Admin --> UC10
    Admin --> UC11
    Admin --> UC12
    Admin --> UC13
    Admin --> UC14

    PMB --> UC20
    PMB --> UC21
    PMB --> UC22
    PMB --> UC23
    PMB --> UC24
    PMB --> UC25
    PMB --> UC29

    Keu --> UC20
    Keu --> UC21
    Keu --> UC26
    Keu --> UC27
    Keu --> UC28
```

---

### 4.2 Class Diagram (Model Eloquent)

```mermaid
classDiagram
    class User {
        +int id
        +string name
        +string email
        +string password
        +datetime email_verified_at
        +string remember_token
        +timestamps
        --
        +HasRoles (Spatie)
        +Notifiable
    }

    class Post {
        +int id
        +int user_id (nullable FK)
        +string title
        +string slug
        +longText body
        +text content
        +text excerpt
        +string thumbnail
        +string category
        +string status
        +boolean is_published
        +datetime published_at
        +timestamps
        --
        +user() : BelongsTo~User~
    }

    class Document {
        +int id
        +int user_id (nullable FK)
        +string title
        +text description
        +string file_path
        +string file_name
        +string category
        +boolean is_public
        +timestamps
        --
        +user() : BelongsTo~User~
    }

    class Page {
        +int id
        +string title
        +string slug
        +text content
        +timestamps
    }

    class ProgramStudi {
        +int id
        +string nama_prodi
        +string jenjang
        +string kode_nim
        +string kode_dikti
        +string kode_siakad
        +string gelar
        +string akreditasi
        +text deskripsi
        +text visi
        +text misi
        +text prospek_karir
        +string thumbnail
        +boolean is_active
        +timestamps
        --
        +scopeActive(query)
    }

    class PmbRegistration {
        +int id
        +string nomor_pendaftaran
        +string prodi
        +string nama_lengkap
        +string nomor_ktp
        +string nisn
        +string npsn
        +string jenis_kelamin
        +string tempat_lahir
        +date tanggal_lahir
        +string asal_sekolah
        +string jurusan
        +int tahun_lulus
        +string no_hp
        +string alamat_dusun / rt / rw / desa / kec_kab
        +string nama_ayah / ktp_ayah / pekerjaan / penghasilan
        +string nama_ibu / ktp_ibu / pekerjaan / penghasilan
        +string alamat_orangtua_*
        +string nama_wali / ktp_wali / pekerjaan (nullable)
        +string alamat_wali_* (nullable)
        +string jalur_seleksi
        +string gelombang
        +string pas_foto
        +string raport_path
        +string ijazah_path
        +string status
        +string nim
        +boolean sia_account_created
        +timestamp tgl_lulus_seleksi
        +timestamp tgl_verifikasi_pembayaran
        +string jenis_beasiswa
        +string link_berkas_beasiswa
        +decimal utbk_pu / ppu / pbm / pk / lbid / lbing / pm
        +string link_sertifikat_utbk
        +string foto_bukti_cicilan_1 / cicilan_2
        +bigint nominal_cicilan_1 / cicilan_2
        +date tanggal_bayar_cicilan_1 / cicilan_2
        +enum status_pembayaran_daftar_ulang
        +text catatan_pembayaran
        +softDeletes
        +timestamps
        --
        +generateNomorPendaftaran() : string
        +generateNim(prodi, year) : string
        +repairNimIfInvalid(nim, prodi, year) : string
    }

    class PmbWave {
        +int id
        +string nama_gelombang
        +date tanggal_mulai
        +date tanggal_selesai
        +boolean is_active
        +timestamps
        --
        +getActiveWave() : PmbWave
    }

    class PmbFee {
        +int id
        +string nama_biaya
        +string prodi
        +bigint jumlah
        +string keterangan
        +timestamps
    }

    class NimCounter {
        +int id
        +string tahun
        +string kode_prodi
        +int last_count
        +timestamps
    }

    User "1" --> "*" Post : has many
    User "1" --> "*" Document : has many
    ProgramStudi "1" ..> "*" PmbRegistration : referenced by prodi
    PmbWave "1" ..> "*" PmbRegistration : referenced by gelombang
    PmbRegistration ..> NimCounter : uses for NIM generation
```

---

### 4.3 Entity-Relationship Diagram (ERD)

```mermaid
erDiagram
    users {
        bigint id PK
        string name
        string email UK
        timestamp email_verified_at
        string password
        string remember_token
        timestamps created_at
        timestamps updated_at
    }

    posts {
        bigint id PK
        bigint user_id FK
        string title
        string slug UK
        longtext body
        text content
        text excerpt
        string thumbnail
        string category
        string status
        boolean is_published
        datetime published_at
        timestamps created_at
        timestamps updated_at
    }

    documents {
        bigint id PK
        bigint user_id FK
        string title
        text description
        string file_path
        string file_name
        string category
        boolean is_public
        timestamps created_at
        timestamps updated_at
    }

    pages {
        bigint id PK
        string title
        string slug UK
        text content
        timestamps created_at
        timestamps updated_at
    }

    program_studis {
        bigint id PK
        string nama_prodi UK
        string jenjang
        string kode_nim UK
        string kode_dikti
        string kode_siakad
        string gelar
        string akreditasi
        text deskripsi
        text visi
        text misi
        text prospek_karir
        string thumbnail
        boolean is_active
        timestamps created_at
        timestamps updated_at
    }

    pmb_registrations {
        bigint id PK
        string nomor_pendaftaran UK
        string prodi
        string nama_lengkap
        string nomor_ktp
        string nisn
        string npsn
        string jenis_kelamin
        string tempat_lahir
        date tanggal_lahir
        string asal_sekolah
        string jurusan
        int tahun_lulus
        string no_hp
        string alamat_dusun
        string alamat_rt
        string alamat_rw
        string alamat_desa
        string alamat_kecamatan_kabupaten
        string nama_ayah
        string ktp_ayah
        string pekerjaan_ayah
        string penghasilan_ayah
        string nama_ibu
        string ktp_ibu
        string pekerjaan_ibu
        string penghasilan_ibu
        string jalur_seleksi
        string gelombang
        string pas_foto
        string raport_path
        string ijazah_path
        string status
        string nim
        boolean sia_account_created
        timestamp tgl_lulus_seleksi
        timestamp tgl_verifikasi_pembayaran
        enum status_pembayaran_daftar_ulang
        text catatan_pembayaran
        timestamp deleted_at
        timestamps created_at
        timestamps updated_at
    }

    pmb_waves {
        bigint id PK
        string nama_gelombang
        date tanggal_mulai
        date tanggal_selesai
        boolean is_active
        timestamps created_at
        timestamps updated_at
    }

    pmb_fees {
        bigint id PK
        string nama_biaya
        string prodi
        bigint jumlah
        string keterangan
        timestamps created_at
        timestamps updated_at
    }

    nim_counters {
        bigint id PK
        string tahun
        string kode_prodi
        int last_count
        timestamps created_at
        timestamps updated_at
    }

    users ||--o{ posts : "has many"
    users ||--o{ documents : "has many"
    program_studis ||..o{ pmb_registrations : "referenced"
    pmb_waves ||..o{ pmb_registrations : "referenced"
    nim_counters ||..o{ pmb_registrations : "used for NIM"
```

---

### 4.4 Activity Diagram — Alur Pendaftaran PMB Online

```mermaid
flowchart TD
    A["🟢 Start"] --> B["Pengunjung membuka halaman PMB"]
    B --> C["Pilih jalur seleksi"]
    C --> D{"Jalur apa?"}
    D -->|"Jalur Nilai Rapor"| E1["Isi formulir standar"]
    D -->|"Jalur Beasiswa & Prestasi"| E2["Isi formulir + data beasiswa"]
    D -->|"Jalur Nilai UTBK-SNBT"| E3["Isi formulir + skor UTBK"]
    
    E1 --> F["Upload dokumen (foto, rapor, ijazah)"]
    E2 --> F
    E3 --> F

    F --> G["Submit pendaftaran"]
    G --> H["Sistem generate Nomor Pendaftaran"]
    H --> I["Tentukan Gelombang Aktif"]
    I --> J["Simpan data ke database"]
    J --> K["Tampilkan halaman sukses"]
    K --> L["Cetak formulir pendaftaran"]

    L --> M["Admin/Staff review pendaftaran"]
    M --> N{"Keputusan seleksi?"}
    N -->|"Lulus Seleksi"| O["Update status = Lulus Seleksi"]
    N -->|"Tidak Lulus"| P["Update status = Tidak Lulus"]
    
    O --> Q["Kirim data ke SIAKAD via API"]
    Q --> R["Buat akun SIAKAD pra-bayar"]
    R --> S["Mahasiswa upload bukti pembayaran"]
    S --> T["Staff Keuangan verifikasi pembayaran"]
    T --> U{"Status pembayaran?"}
    U -->|"Cicilan 1 Lunas"| V1["Generate NIM + Sync ke SIAKAD"]
    U -->|"Lunas Total"| V2["Generate NIM + Sync ke SIAKAD"]
    U -->|"Ditolak"| W["Pembayaran ditolak"]

    V1 --> X["🔴 Selesai — Mahasiswa Terdaftar"]
    V2 --> X
    P --> Y["🔴 Selesai — Tidak Lulus"]
    W --> Z["🔴 Selesai — Pembayaran Ditolak"]
```

---

### 4.5 Sequence Diagram — Pendaftaran PMB & Verifikasi

```mermaid
sequenceDiagram
    actor Pendaftar as Calon Mahasiswa
    participant Web as Website PMB
    participant DB as Database
    participant Admin as Staff PMB
    participant Keu as Staff Keuangan
    participant SIA as SIAKAD API

    Pendaftar->>Web: Buka halaman PMB
    Web-->>Pendaftar: Tampilkan pilihan jalur
    Pendaftar->>Web: Pilih jalur & isi formulir
    Pendaftar->>Web: Upload foto, rapor, ijazah
    Pendaftar->>Web: Submit pendaftaran
    
    Web->>DB: Generate nomor pendaftaran (TAHUN-XXXX)
    Web->>DB: Ambil gelombang aktif dari pmb_waves
    Web->>DB: Simpan PmbRegistration (status=Pending)
    DB-->>Web: Success
    Web-->>Pendaftar: Tampilkan halaman sukses + nomor pendaftaran

    Note over Admin: Staff PMB melakukan review

    Admin->>Web: Lihat detail pendaftar
    Admin->>Web: Update status → "Lulus Seleksi"
    Web->>DB: Update status + catat tgl_lulus_seleksi
    Web->>SIA: POST /api/mahasiswa/import-pmb
    SIA-->>Web: Response (akun pra-bayar dibuat)
    Web->>DB: Set sia_account_created = true

    Note over Pendaftar: Cek status & upload bukti bayar

    Pendaftar->>Web: Cek status pendaftaran
    Web->>DB: Query by nomor_pendaftaran / nomor_ktp
    DB-->>Web: Data pendaftaran + status
    Web-->>Pendaftar: Tampilkan status + form upload bukti bayar

    Pendaftar->>Web: Upload foto bukti transfer cicilan 1
    Web->>DB: Simpan foto + nominal + status "Menunggu Verifikasi"

    Note over Keu: Staff Keuangan verifikasi

    Keu->>Web: Verifikasi pembayaran → "Cicilan 1 Lunas"
    Web->>DB: Generate NIM atomik via nim_counters
    Web->>DB: Update nim + status_pembayaran
    Web->>SIA: POST /api/mahasiswa/unlock-access (NIM + status)
    SIA-->>Web: Akses penuh SIAKAD dibuka
    Web-->>Keu: Konfirmasi sukses + NIM mahasiswa
```

---

### 4.6 Component Diagram

```mermaid
flowchart TB
    subgraph Frontend["🌐 Frontend (Blade + Tailwind)"]
        LP["Landing Page"]
        Berita["Halaman Berita"]
        Dokumen["Halaman Dokumen"]
        Prodi["Halaman Program Studi"]
        PMBForm["Formulir PMB Online"]
        StatusCheck["Cek Status Pendaftaran"]
    end

    subgraph AdminPanel["⚙️ Admin Panel"]
        Dashboard["Dashboard"]
        CMS["CMS (Posts, Documents)"]
        UserMgmt["Manajemen Pengguna & Role"]
        ProdiMgmt["Manajemen Program Studi"]
        PMBMgmt["Manajemen Pendaftar PMB"]
        WaveMgmt["Kelola Gelombang"]
        FeeMgmt["Kelola Biaya"]
        PaymentVerif["Verifikasi Pembayaran"]
    end

    subgraph Backend["🔧 Laravel Backend"]
        Controllers["Controllers"]
        Models["Eloquent Models"]
        Middleware["Auth + Role Middleware"]
        FileStorage["Laravel Storage (public disk)"]
    end

    subgraph Database["🗄️ MySQL Database"]
        DBTables["users, posts, documents, pages,\nprogram_studis, pmb_registrations,\npmb_waves, pmb_fees, nim_counters,\npermissions, roles"]
    end

    subgraph External["🌍 External"]
        SIAKAD["SIA-STIKES API\n(SIAKAD)"]
    end

    Frontend --> Controllers
    AdminPanel --> Controllers
    Controllers --> Middleware
    Controllers --> Models
    Controllers --> FileStorage
    Models --> DBTables
    Controllers --> SIAKAD
```

---

### 4.7 Deployment Diagram

```mermaid
flowchart LR
    subgraph Client["👤 Client Browser"]
        Browser["Web Browser"]
    end

    subgraph Server["🖥️ Web Server (XAMPP / VPS)"]
        Apache["Apache / Nginx"]
        PHP["PHP 8.2+ (FPM)"]
        Laravel["Laravel 12 Application"]
        Vite["Vite (Build Assets)"]
    end

    subgraph DB["🗄️ Database Server"]
        MySQL["MySQL"]
    end

    subgraph Storage["📁 File Storage"]
        PublicDisk["storage/app/public/\n(foto, dokumen, bukti bayar)"]
    end

    subgraph ExtAPI["🌐 External API"]
        SIAKAD["SIA-STIKES\n(dev.stikesmuwsb.ac.id)"]
    end

    Browser -->|"HTTPS"| Apache
    Apache --> PHP
    PHP --> Laravel
    Laravel --> Vite
    Laravel -->|"MySQL Protocol"| MySQL
    Laravel -->|"Read/Write"| PublicDisk
    Laravel -->|"HTTP API"| SIAKAD
```

---

## 5. Struktur Route

### 5.1 Route Publik (Guest)

| Method | URI | Controller / Action | Nama Route | Deskripsi |
|--------|-----|---------------------|------------|-----------|
| GET | `/` | Closure | — | Landing page |
| GET | `/berita` | PostController@index | `posts.index` | Daftar berita |
| GET | `/berita/{slug}` | PostController@show | `posts.show` | Detail berita |
| GET | `/dokumen` | DocumentController@index | `documents.index` | Daftar dokumen |
| GET | `/dokumen/{document}/download` | DocumentController@download | `documents.download` | Download dokumen |
| GET | `/halaman/{slug}` | PageController@show | `pages.show` | Halaman statis |
| GET | `/program-studi` | Closure | `prodi.index` | Daftar program studi |
| GET | `/pmb` | PmbController@jalur | `pmb.jalur` | Pilihan jalur PMB |
| GET | `/pmb/cek-status` | PmbController@checkStatus | `pmb.status_check` | Cek status pendaftaran |
| GET | `/pmb/daftar` | PmbController@create | `pmb.create` | Form pendaftaran |
| POST | `/pmb/daftar` | PmbController@store | `pmb.store` | Submit pendaftaran |
| GET | `/pmb/sukses/{id}` | PmbController@success | `pmb.success` | Halaman sukses |
| GET | `/pmb/cetak/{id}` | PmbController@print | `pmb.print` | Cetak formulir |
| POST | `/pmb/{id}/upload-bukti-bayar` | PmbController@uploadBuktiBayar | `pmb.upload_bukti_bayar` | Upload bukti transfer |

### 5.2 Route Admin (Protected: auth + role)

| Method | URI | Controller / Action | Nama Route | Hak Akses |
|--------|-----|---------------------|------------|-----------|
| GET | `/admin` | DashboardController@index | `admin.dashboard` | All Admin Roles |
| CRUD | `/admin/posts` | Admin\PostController | `admin.posts.*` | Super Admin, Admin CMS |
| CRUD | `/admin/documents` | Admin\DocumentController | `admin.documents.*` | Super Admin, Admin CMS |
| CRUD | `/admin/users` | Admin\UserController | `admin.users.*` | Super Admin, Admin CMS |
| CRUD | `/admin/program-studi` | Admin\ProgramStudiController | `admin.program-studi.*` | Super Admin, Admin CMS |
| PATCH | `/admin/program-studi/{id}/toggle-active` | toggleActive | `admin.program-studi.toggle_active` | Super Admin, Admin CMS |
| GET | `/admin/pmb` | Admin\PmbController@index | `admin.pmb.index` | All Admin Roles |
| GET | `/admin/pmb/print-rekap` | Admin\PmbController@printRekap | `admin.pmb.print_rekap` | All Admin Roles |
| GET | `/admin/pmb/{id}` | Admin\PmbController@show | `admin.pmb.show` | All Admin Roles |
| PUT | `/admin/pmb/{id}/status` | Admin\PmbController@updateStatus | `admin.pmb.status` | All Admin Roles |
| POST | `/admin/pmb/{id}/verify-payment` | Admin\PmbController@verifyPayment | `admin.pmb.verify_payment` | All Admin Roles |
| POST | `/admin/pmb/{id}/sync-sia` | Admin\PmbController@syncSia | `admin.pmb.sync_sia` | All Admin Roles |
| DELETE | `/admin/pmb/{id}` | Admin\PmbController@destroy | `admin.pmb.destroy` | All Admin Roles |
| GET/POST | `/admin/pmb-gelombang` | Admin\PmbWaveController | `admin.pmb_waves.*` | All Admin Roles |
| GET/POST | `/admin/pmb-biaya` | Admin\PmbFeeController | `admin.pmb_fees.*` | All Admin Roles |

---

## 6. Deskripsi Tabel Database

### 6.1 `users`
Tabel pengguna sistem (admin, staff). Menggunakan Spatie Permission untuk manajemen role.

### 6.2 `posts`
Tabel berita/artikel. Mendukung rich text editor, thumbnail, kategori, dan status draft/published.

### 6.3 `documents`
Tabel dokumen yang bisa didownload publik. Mendukung deskripsi, kategori, dan visibilitas (public/private).

### 6.4 `pages`
Tabel halaman statis (seperti profil, visi misi) yang diakses via slug.

### 6.5 `program_studis`
Master data program studi. Menyimpan informasi lengkap prodi termasuk kode NIM, kode DIKTI, kode SIAKAD, akreditasi, visi, misi, dan prospek karir.

### 6.6 `pmb_registrations`
Tabel utama pendaftaran mahasiswa baru. Menyimpan seluruh data pribadi, orang tua/wali, berkas, status seleksi, NIM, dan status pembayaran. Menggunakan **Soft Deletes** agar nomor pendaftaran tidak di-reuse.

### 6.7 `pmb_waves`
Gelombang pendaftaran PMB. Setiap gelombang punya periode aktif (tanggal mulai s/d selesai).

### 6.8 `pmb_fees`
Biaya-biaya pendaftaran/registrasi ulang per program studi.

### 6.9 `nim_counters`
Counter atomik untuk generate NIM secara sekuensial per tahun dan kode prodi. Format NIM: `[Angkatan 3 digit][Tahun 2 digit][Kode Prodi 4 digit][Urut 3 digit]`.

### 6.10 Permission Tables (Spatie)
`roles`, `permissions`, `model_has_roles`, `model_has_permissions`, `role_has_permissions` — Tabel standar Spatie Laravel Permission untuk RBAC.

---

## 7. Fitur Utama

### 7.1 Pendaftaran PMB Online
- 3 jalur seleksi: **Jalur Nilai Rapor**, **Jalur Beasiswa & Prestasi**, **Jalur Nilai UTBK-SNBT**
- Upload berkas (pas foto, rapor, ijazah) secara online
- Penentuan gelombang pendaftaran otomatis berdasarkan tanggal
- Generate nomor pendaftaran unik (format: `TAHUN-XXXX`)

### 7.2 Manajemen Seleksi
- Admin bisa mengubah status: Pending → Lulus Seleksi / Tidak Lulus
- Otomatis sinkronisasi ke SIAKAD saat status "Lulus Seleksi"

### 7.3 Pembayaran Daftar Ulang
- Mahasiswa upload bukti transfer (cicilan 1 / cicilan 2)
- Staff Keuangan verifikasi pembayaran
- Status: Belum Bayar → Menunggu Verifikasi → Cicilan 1 Lunas → Lunas Total / Ditolak
- **Generate NIM atomik** saat pembayaran terverifikasi

### 7.4 Integrasi SIAKAD
- API endpoint: `POST /api/mahasiswa/import-pmb` — Import data pendaftar
- API endpoint: `POST /api/mahasiswa/unlock-access` — Buka akses penuh setelah bayar
- Menggunakan `X-PMB-Secret` header untuk autentikasi API

### 7.5 CMS (Content Management System)
- CRUD Berita dengan rich text editor dan upload gambar
- CRUD Dokumen yang bisa didownload
- Halaman statis (via Pages)

### 7.6 Manajemen Program Studi
- CRUD program studi lengkap dengan informasi visi, misi, prospek karir
- Toggle aktif/nonaktif prodi di PMB

---

## 8. Format NIM

```
Format: [AAA][TT][PPPP][NNN]

AAA  = Tahun Angkatan 3 digit (base 2018, contoh: 2026 = 008)
TT   = Tahun Terdaftar 2 digit (contoh: 2026 = 26)
PPPP = Kode Prodi 4 digit (S1 Farmasi = 0101, S1 Gizi = 0201)
NNN  = Nomor Urut 3 digit (counter atomik per tahun+prodi)

Contoh: 008260101001 = Angkatan 008, Tahun 26, Farmasi (0101), Urut 001
```

---

## 9. Alur Status Pendaftaran

```mermaid
stateDiagram-v2
    [*] --> Pending : Submit Pendaftaran
    Pending --> LulusSeleksi : Staff PMB approve
    Pending --> TidakLulus : Staff PMB reject
    LulusSeleksi --> BelumBayar : Menunggu pembayaran
    BelumBayar --> MenungguVerif1 : Upload bukti cicilan 1
    MenungguVerif1 --> Cicilan1Lunas : Keuangan verifikasi OK
    MenungguVerif1 --> Ditolak : Keuangan reject
    Cicilan1Lunas --> MenungguVerif2 : Upload bukti cicilan 2
    MenungguVerif2 --> LunasTotal : Keuangan verifikasi OK
    MenungguVerif2 --> Ditolak : Keuangan reject
    
    Cicilan1Lunas --> Terdaftar : NIM generated + SIAKAD sync
    LunasTotal --> Terdaftar : NIM generated + SIAKAD sync
    
    TidakLulus --> [*]
    Ditolak --> [*]
    Terdaftar --> [*]

    state LulusSeleksi : Lulus Seleksi\n(Akun SIAKAD pra-bayar dibuat)
    state Terdaftar : Mahasiswa Terdaftar\n(NIM aktif, SIAKAD full access)
```

---

## 10. Struktur Direktori Project

```
STIKESMU/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── DocumentController.php
│   │   │   │   ├── PmbController.php
│   │   │   │   ├── PmbFeeController.php
│   │   │   │   ├── PmbWaveController.php
│   │   │   │   ├── PostController.php
│   │   │   │   ├── ProgramStudiController.php
│   │   │   │   └── UserController.php
│   │   │   ├── Auth/ (Laravel Breeze)
│   │   │   ├── DocumentController.php
│   │   │   ├── PageController.php
│   │   │   ├── PmbController.php
│   │   │   ├── PostController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   └── Models/
│       ├── Document.php
│       ├── Page.php
│       ├── PmbFee.php
│       ├── PmbRegistration.php
│       ├── PmbWave.php
│       ├── Post.php
│       ├── ProgramStudi.php
│       └── User.php
├── database/
│   └── migrations/ (21 migration files)
├── resources/
│   └── views/
├── routes/
│   ├── web.php
│   └── auth.php
├── public/
├── config/
└── storage/
```
