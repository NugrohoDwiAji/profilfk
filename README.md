# Website Resmi Fakultas Kedokteran Universitas Bumigora (FK UBG)

Landing page resmi dan sistem informasi profil **Fakultas Kedokteran Universitas Bumigora (UBG) Mataram, Nusa Tenggara Barat**. Dibangun dengan arsitektur modern berbasis **Laravel**, **MySQL**, **Tailwind CSS v4**, dan **Alpine.js**, dirancang khusus untuk memenuhi standar identitas akademik kedokteran yang kredibel, elegan, responsif, dan siap dikembangkan lebih lanjut.

---

## 🏥 Karakter & Filosofi Desain

Desain website ini mengadopsi pendekatan **Human-Centered Medical Academic Editorial**:
* **Bukan Desain Klinik Komersial / Dental Stock**: Menghindari tipikal template landing page komersial, ikon stetoskop klise, atau foto klinik gigi yang tidak relevan. Seluruh visual berfokus pada sivitas akademika, pembelajaran biomedik & klinis, serta interaksi dosen-mahasiswa.
* **Sistem Warna Brand Resmi**:
  * **Primary (Steel Blue)**: `#7D99B0` — Merefleksikan ketenangan klinis, ketelitian sains, dan stabilitas akademik institusi.
  * **Secondary / Accent (Soft Royal Purple)**: `#9064C2` — Sentuhan royal purple Bumigora untuk highlight prestise, tombol aksi penting (CTA), dan aksen kategori.
  * **Netral & Permukaan**: Teks heading `#263445`, teks body `#5F6B78`, latar utama `#FFFFFF`, surface `#F6F8FB`, dan border halus `#E4E9F0`.
* **Tipografi**: Menggunakan font sans-serif modern berdaya baca tinggi (**Plus Jakarta Sans** / **Inter**) dengan hierarki heading terukur dan keterbacaan standar WCAG AA.
* **Whitespace & Ritme Konten**: Layout editorial asimetris yang dinamis dengan whitespace teratur (kelipatan 4px/8px), kartu berbayang mikro halus, dan mikro-interaksi responsif.

---

## 🛠️ Technology Stack

| Komponen | Teknologi & Versi |
|---|---|
| **Backend Framework** | Laravel 12.x |
| **Bahasa Pemrograman** | PHP 8.4+ |
| **Database** | MySQL 8.x / MariaDB |
| **Frontend Templating** | Blade Templates (Reusable Components & Layouts) |
| **Styling** | Tailwind CSS v4 (`@theme` tokens di `resources/css/app.css`) |
| **Interaktivitas Client** | Alpine.js 3.x (Dropdown, Mobile Drawer, Tabs, Dismissable Alerts) |
| **Ikon** | SVG Inline Lucide Icons |
| **Asset Bundler** | Vite 8.x |
| **Testing** | PHPUnit 12.x / Laravel Testing Suite |

---

## 🏛️ Data Institusi Resmi & Terverifikasi

Seluruh informasi kontak, data pimpinan fakultas, dan fasilitas yang disematkan dalam aplikasi ini disinkronkan langsung dari arsip resmi Universitas Bumigora:

* **Alamat Kampus**: Jl. Ismail Marzuki No. 22, Cilinaya, Kec. Cakranegara, Kota Mataram, Nusa Tenggara Barat 83239
* **Kontak**: (0370) 633837 / 638641 | Email: `info@universitasbumigora.ac.id` / `fk@universitasbumigora.ac.id`
* **Portal PMB**: [https://pmb.universitasbumigora.ac.id](https://pmb.universitasbumigora.ac.id)
* **Rumah Sakit Pendidikan Utama**: RSUD Praya Lombok Tengah (Perjanjian Kerjasama RS Pendidikan Jejaring FK UBG)
* **Pimpinan & Dosen Tetap**:
  1. **Dr. dr. Ni Luh Putu Inca Buntari Agustini, M.Kes.** — Dekan Fakultas Kedokteran
  2. **dr. I Wayan Suardana, Sp.B.** — Wakil Dekan I (Bidang Akademik & Riset)
  3. **dr. I Gede Wira Suardana, M.Biomed.** — Wakil Dekan II (Bidang Sumber Daya & Keuangan)
  4. **dr. Lalu Irwan, M.Biomed.** — Wakil Dekan III (Bidang Kemahasiswaan & Kerjasama)
  5. **dr. Amy Rahmadanti, Sp.A.** — Dosen Tetap Bagian Ilmu Kesehatan Anak
  6. **dr. Dina, Sp.PK.** — Dosen Tetap Bagian Patologi Klinik

---

## 🗄️ Struktur Database & Model Eloquent

Aplikasi menggunakan skema database MySQL terstruktur:

1. **`programs`** (`App\Models\Program`):
   - Program studi resmi: **Sarjana Kedokteran (S.Ked)** & **Profesi Dokter (dr.)**.
   - Menyimpan durasi semester, SKS, gelar, akreditasi, kurikulum terintegrasi, dan keunggulan.
2. **`faculty_members`** (`App\Models\FacultyMember`):
   - Profil pimpinan fakultas dan dosen pengampu mata kuliah klinis/biomedik dengan NIDN, bidang keahlian, dan foto resmi.
3. **`news`** (`App\Models\News`):
   - Manajemen artikel berita, rilis pers, dan pengumuman akademik dengan sistem status (`published` / `draft`) dan perhitungan estimasi waktu baca dinamis.
4. **`research_projects`** (`App\Models\ResearchProject`):
   - Dokumentasi penelitian klinis & kegiatan pengabdian masyarakat (stunting, kesehatan kepulauan NTB, malaria, dan penyakit tropis).
5. **`facilities`** (`App\Models\Facility`):
   - Laboratorium Keterampilan Klinis (Skills Lab), Laboratorium Anatomi & Biomedik, RSUD Jejaring, dan Perpustakaan Medis.
6. **`contact_messages`** (`App\Models\ContactMessage`):
   - Menyimpan pesan, pertanyaan pendaftaran, dan saran dari formulir kontak publik lengkap dengan validasi dan status tindak lanjut.
7. **`site_settings`** (`App\Models\SiteSetting`):
   - Konfigurasi global situs (telepon, alamat, media sosial, tautan portal PMB) dengan mekanisme cache otomatis.

---

## 📁 Struktur Direktori Penting

```text
fk-profil/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php      # Controller beranda & aggregasi section
│   │   │   ├── NewsController.php      # Controller detail berita (404 guard untuk draft)
│   │   │   ├── ProgramController.php   # Controller kurikulum & detail prodi
│   │   │   └── ContactController.php   # Form kontak publik & rate-limiting
│   │   └── Requests/
│   │       └── ContactRequest.php      # Validasi form dengan pesan bahasa Indonesia
│   └── Models/                         # Eloquent Models (Program, News, FacultyMember, etc.)
├── database/
│   ├── migrations/                     # 7 skema migrasi tabel utama
│   └── seeders/
│       └── DatabaseSeeder.php          # Seeder data resmi sivitas & fasilitas FK UBG
├── public/
│   └── images/
│       ├── logos/                      # Logo resmi UBG (svg & png resolusi tinggi)
│       ├── faculty/                    # Foto resmi dekanat & staf pengajar
│       ├── facilities/                 # Dokumentasi laboratorium & rumah sakit mitra
│       └── hero/                       # Visual akademik mahasiswa kedokteran
├── resources/
│   ├── css/
│   │   └── app.css                     # Tailwind v4 token variables & utility classes
│   ├── js/
│   │   └── app.js                      # Alpine.js init & interaktivitas
│   └── views/
│       ├── components/                 # Reusable Blade components (badge, button, icon, etc.)
│       ├── layouts/
│       │   └── app.blade.php           # Master layout dengan SEO meta & accessibility
│       ├── partials/
│       │   ├── top-bar.blade.php       # Baris informasi kontak & portal PMB
│       │   ├── navbar.blade.php        # Navigasi utama sticky & responsive drawer
│       │   └── footer.blade.php        # Footer resmi institusi
│       └── pages/
│           ├── home.blade.php          # 11 section landing page komprehensif
│           ├── news-detail.blade.php   # Halaman detail rilis berita
│           └── program-detail.blade.php# Halaman detail prodi & kurikulum
└── tests/
    └── Feature/
        └── LandingPageTest.php         # 11 skenario pengujian fungsional otomatis
```

---

## 🚀 Panduan Instalasi & Menjalankan Proyek

### 1. Prasyarat Sistem
* PHP >= 8.2 (Disarankan **PHP 8.4**) dengan ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`.
* MySQL >= 8.0 (atau MariaDB >= 10.5).
* Composer >= 2.x.
* Node.js >= 20.x & npm.

### 2. Kloning & Pengaturan Lingkungan
```bash
# Masuk ke direktori proyek
cd /Users/nugroho/Kerja/aplikasi/fk-profil

# Salin konfigurasi environment
cp .env.example .env

# Pasang dependensi PHP
composer install

# Buat application encryption key
php artisan key:generate
```

### 3. Konfigurasi Database MySQL
Pastikan servis MySQL berjalan (`brew services start mysql` di macOS), lalu sesuaikan berkas `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fk_bumigora
DB_USERNAME=root
DB_PASSWORD=
```

Buat database jika belum tersedia:
```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS fk_bumigora CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 4. Eksekusi Migrasi & Data Seeder
Jalankan migrasi tabel dan seeder data awal:
```bash
php artisan migrate:fresh --seed
```

### 5. Kompilasi Aset Frontend (Tailwind CSS v4 & Alpine.js)
```bash
# Pasang dependensi Node.js
npm install

# Kompilasi untuk produksi
npm run build

# Atau jalankan Vite development server saat mengedit UI
npm run dev
```

### 6. Menjalankan Server Aplikasi
Jalankan development server Laravel:
```bash
php artisan serve
```
Buka browser pada: `http://localhost:8000`

---

## 🧪 Pengujian Otomatis (Quality Assurance)

Seluruh fitur inti dilindungi oleh rangkaian automated test menggunakan **PHPUnit**:
```bash
php artisan test
```

### Cakupan Pengujian:
1. `test_homepage_can_be_accessed_successfully` — Memverifikasi HTTP 200, identitas FK UBG, dan hero section.
2. `test_published_news_appears_on_homepage` — Memverifikasi berita berstatus *published* tampil di beranda.
3. `test_draft_news_does_not_appear_on_homepage` — Menjamin berita *draft* tidak pernah bocor ke tampilan publik.
4. `test_news_detail_page_is_accessible_for_published_news` — Memverifikasi halaman pembaca berita lengkap.
5. `test_news_detail_page_returns_404_for_draft_news` — Menjamin akses langsung ke URL slug draft menghasilkan HTTP 404 Not Found.
6. `test_program_detail_page_is_accessible` — Memverifikasi rincian program studi Sarjana Kedokteran.
7. `test_empty_state_rendered_cleanly_when_database_is_empty` — Memverifikasi tampilan UI tetap elegan dan informatif tanpa error jika database kosong.
8. `test_contact_form_submits_and_saves_message` — Menguji pengiriman form kontak dan penyimpanan ke database.
9. `test_contact_form_fails_validation_with_invalid_data` — Memverifikasi validasi input form kontak berjalan ketat dengan pesan kesalahan yang ramah pengguna.

---

## 🛡️ Keamanan & Aksesibilitas
* **Proteksi CSRF**: Seluruh formulir menggunakan token `@csrf`.
* **Rate Limiting**: Form kontak dilindungi throttle `throttle:10,1` untuk mencegah spam.
* **XSS Protection**: Blade templating melakukan sanitasi escaping karakter HTML secara otomatis.
* **Aksesibilitas (A11y)**:
  * Tautan "Lewati ke konten utama" (*skip navigation*) untuk pengguna screen reader.
  * Tag semantik HTML5 (`<header>`, `<nav>`, `<main>`, `<article>`, `<section>`, `<footer>`).
  * Kontras warna teks memenuhi kriteria WCAG AA.
  * Navigasi mobile dilengkapi atribut `aria-expanded` dan kontrol keyboard.

---

## 📄 Hak Cipta & Lisensi
Hak cipta © 2026 **Fakultas Kedokteran Universitas Bumigora**. Seluruh materi, lambang, dan identitas institusi dilindungi undang-undang.
# profilfk
