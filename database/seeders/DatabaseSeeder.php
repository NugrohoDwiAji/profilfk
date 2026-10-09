<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\Facility;
use App\Models\FacultyMember;
use App\Models\News;
use App\Models\Program;
use App\Models\ResearchProject;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@fk.bumigora.ac.id'],
            [
                'name' => 'Administrator FK UBG',
                'password' => Hash::make('AdminFKUBG2026!'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Site Settings (Verified Official Data)
        $settings = [
            'faculty_name' => 'Fakultas Kedokteran',
            'university_name' => 'Universitas Bumigora',
            'full_title' => 'Fakultas Kedokteran Universitas Bumigora',
            'tagline' => 'Menyiapkan Dokter Masa Depan yang Kompeten dan Humanis',
            'campus_address' => 'Jl. Ismail Marzuki No. 22, Cilinaya, Kec. Cakranegara, Kota Mataram, Nusa Tenggara Barat 83239',
            'campus_phone' => '(0370) 633837',
            'campus_email' => 'info@ubg.ac.id',
            'faculty_email' => 'info@fk.bumigora.ac.id',
            'campus_whatsapp' => '62817788899',
            'pmb_url' => 'https://pmb.universitasbumigora.ac.id',
            'main_website_url' => 'https://universitasbumigora.ac.id',
            'facebook_url' => 'https://facebook.com/universitasbumigora',
            'instagram_url' => 'https://instagram.com/universitasbumigora',
            'youtube_url' => 'https://youtube.com/@universitasbumigora',
            'hospital_partner' => 'RSUD Praya (Rumah Sakit Pendidikan Utama)',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => 'text']
            );
        }

        // 3. Academic Programs
        $programs = [
            [
                'name' => 'Sarjana Kedokteran',
                'degree' => 'S1',
                'slug' => 'sarjana-kedokteran',
                'tagline' => 'Pendidikan Akademik Kedokteran Berbasis Problem-Based Learning',
                'description' => 'Program Studi Sarjana Kedokteran mempersiapkan mahasiswa dengan fondasi ilmu biomedik, keterampilan klinis dasar, etika kedokteran, dan kemampuan berpikir kritis melalui kurikulum terintegrasi blok.',
                'curriculum_summary' => 'Kurikulum dirancang dalam kurun waktu 7-8 semester (144-148 SKS) dengan pendekatan Student-Centered Learning, Problem-Based Learning (PBL), Clinical Skills Training, dan Evidence-Based Medicine.',
                'career_prospects' => [
                    'Lanjut ke Pendidikan Profesi Dokter (Dokter Muda / Co-assistant)',
                    'Peneliti di Institusi Kesehatan & Laboratorium Biomedik',
                    'Konsultan & Edukator Kesehatan Masyarakat',
                    'Manajemen & Pelayanan Fasilitas Pelayanan Kesehatan',
                ],
                'duration_semesters' => 8,
                'degree_title' => 'S.Ked',
                'accreditation' => 'Terakreditasi LAM-PTKes',
                'image_url' => '/images/facilities/anatomy-lab.jpg',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Pendidikan Profesi Dokter',
                'degree' => 'Profesi',
                'slug' => 'profesi-dokter',
                'tagline' => 'Pendidikan Tahap Klinik di Rumah Sakit Pendidikan dan Jejaring Pelayanan',
                'description' => 'Program Pendidikan Profesi Dokter merupakan kelanjutan tahap sarjana kedokteran di mana mahasiswa mendalami rotasi klinis (Kepaniteraan Klinik) secara langsung di Rumah Sakit Pendidikan Utama dan wahana pendidikan satelit.',
                'curriculum_summary' => 'Masa studi 4 semester di Rumah Sakit Pendidikan Utama (RSUD Praya) dan jejaring Puskesmas di NTB, mencakup rotasi mayor (Penyakit Dalam, Bedah, Anak, Obgyn) dan rotasi minor serta stase kedokteran komunitas.',
                'career_prospects' => [
                    'Dokter Umum di Fasilitas Pelayanan Kesehatan Tingkat Pertama (FKTP)',
                    'Dokter Layanan Primer & Rumah Sakit Umum/Swasta',
                    'Melanjutkan ke Program Pendidikan Dokter Spesialis (PPDS)',
                    'Perwira Medis Militer/Kepolisian & Dokter Penugasan Khusus Kemenkes',
                ],
                'duration_semesters' => 4,
                'degree_title' => 'dr.',
                'accreditation' => 'Terakreditasi LAM-PTKes',
                'image_url' => '/images/facilities/hospital.jpg',
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($programs as $prog) {
            Program::updateOrCreate(['slug' => $prog['slug']], $prog);
        }

        // 4. Faculty Members
        $facultyMembers = [
            [
                'name' => 'Dr. dr. Ni Luh Putu Inca Buntari, M.Kes.',
                'academic_title' => 'Dr. dr., M.Kes.',
                'position' => 'Dekan Fakultas Kedokteran',
                'category' => 'pimpinan',
                'specialization' => 'Pendidikan Kedokteran & Kesehatan Masyarakat',
                'department' => 'Manajemen Pendidikan Kedokteran',
                'photo_url' => '/images/faculty/dr1.png',
                'email' => 'inca.buntari@fk.bumigora.ac.id',
                'bio' => 'Berpengalaman dalam pengembangan kurikulum kedokteran berstandar nasional dan kepemimpinan institusi pendidikan tinggi kesehatan.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'dr. I Wayan Suardana, M.Kes.',
                'academic_title' => 'dr., M.Kes.',
                'position' => 'Wakil Dekan I (Bidang Akademik & Kemahasiswaan)',
                'category' => 'pimpinan',
                'specialization' => 'Ilmu Kedokteran Komunitas & Epidemiologi Klinis',
                'department' => 'Departemen Kedokteran Komunitas',
                'photo_url' => '/images/faculty/dr11.png',
                'email' => 'suardana@fk.bumigora.ac.id',
                'bio' => 'Fokus pada kurikulum blok, sistem asesmen objektif (OSCE/MCQ), dan integrasi keterampilan klinis sejak semester awal.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'dr. I Gede Wira Suardana, M.Sc.',
                'academic_title' => 'dr., M.Sc.',
                'position' => 'Wakil Dekan II (Bidang Umum, SDM & Keuangan)',
                'category' => 'pimpinan',
                'specialization' => 'Ilmu Biomedik & Farmakologi',
                'department' => 'Departemen Biomedik',
                'photo_url' => '/images/faculty/dr12.png',
                'email' => 'wira.suardana@fk.bumigora.ac.id',
                'bio' => 'Mengampu bidang biomedik, manajemen sarana laboratorium kedokteran modern, serta penjaminan mutu sarana akademik.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'dr. Lalu Irwan, M.Kes.',
                'academic_title' => 'dr., M.Kes.',
                'position' => 'Wakil Dekan III (Bidang Kerjasama & Riset)',
                'category' => 'pimpinan',
                'specialization' => 'Kesehatan Kerja & Kerjasama Institusi Klinis',
                'department' => 'Departemen Kerjasama Klinis',
                'photo_url' => '/images/faculty/dr14.png',
                'email' => 'lalu.irwan@fk.bumigora.ac.id',
                'bio' => 'Mengkoordinasikan jejaring kerjasama rumah sakit pendidikan dan wahana pengabdian masyarakat di kawasan Nusa Tenggara Barat.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'dr. Amy Rahmadanti, Sp.A',
                'academic_title' => 'dr., Sp.A',
                'position' => 'Dosen Pendidik Klinis',
                'category' => 'dosen_klinis',
                'specialization' => 'Ilmu Kesehatan Anak (Pediatri)',
                'department' => 'Departemen Ilmu Kesehatan Anak',
                'photo_url' => '/images/faculty/dr15.png',
                'email' => 'amy.rahmadanti@fk.bumigora.ac.id',
                'bio' => 'Dokter spesialis anak aktif yang membimbing mahasiswa dalam rotasi klinis pediatri dan modul tumbuh kembang anak.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'dr. Dina, Sp.PK',
                'academic_title' => 'dr., Sp.PK',
                'position' => 'Dosen Pendidik Klinis',
                'category' => 'dosen_klinis',
                'specialization' => 'Patologi Klinik & Diagnostik Laboratorium',
                'department' => 'Departemen Patologi Klinik',
                'photo_url' => '/images/faculty/dr16.png',
                'email' => 'dina@fk.bumigora.ac.id',
                'bio' => 'Ahli dalam diagnostik patologi darah, kimia klinik, dan penguatan interpretasi laboratorium klinis dokter masa depan.',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($facultyMembers as $member) {
            FacultyMember::updateOrCreate(['name' => $member['name']], $member);
        }

        // 5. Facilities
        $facilities = [
            [
                'name' => 'Laboratorium Keterampilan Klinis (Skills Lab)',
                'slug' => 'skills-lab',
                'category' => 'Simulasi & Keterampilan',
                'description' => 'Fasilitas pembelajaran keterampilan medis komprehensif yang dilengkapi dengan manikin canggih, simulator prosedur darurat medis, dan ruang stase OSCE terstandar.',
                'features' => [
                    'Manikin resusitasi jantung paru dan simulator jalan nafas',
                    'Ruang simulasi anamnesis dan komunikasi dokter-pasien',
                    'Peralatan bedah minor dan keterampilan tindakan invasif terarah',
                    'Sistem rekaman audio-visual untuk evaluasi dan debriefing',
                ],
                'image_url' => '/images/facilities/skills-lab.jpg',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Laboratorium Anatomi & Biomedik',
                'slug' => 'laboratorium-anatomi',
                'category' => 'Laboratorium',
                'description' => 'Laboratorium terintegrasi untuk studi struktur organ manusia, histologi jaringan, mikrobiologi medis, dan biokimia dengan mikroskop binokuler beresolusi tinggi.',
                'features' => [
                    'Model kadaver sintetik dan preparat anatomi terstandar',
                    'Mikroskop digital terkoneksi layar multimedia',
                    'Fasilitas kultur mikrobiologi dan uji resistensi antibiotik',
                    'Standar biosafety dan sanitasi laboratorium modern',
                ],
                'image_url' => '/images/facilities/anatomy-lab.jpg',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Rumah Sakit Pendidikan Utama (RSUD Praya)',
                'slug' => 'rumah-sakit-pendidikan',
                'category' => 'Wahana Pendidikan Klinis',
                'description' => 'Wahana utama kepaniteraan klinik mahasiswa Fakultas Kedokteran UBG dengan variasi kasus medis nyata, bimbingan konsulen spesialis, dan fasilitas rawat inap lengkap.',
                'features' => [
                    'IGD 24 jam dengan fasilitas penanganan kegawatdaruratan',
                    'Instalasi Rawat Jalan dengan poli spesialis lengkap',
                    'Kamar Operasi modern dan ICU terintegrasi',
                    'Rotasi komunitas terpadu di wilayah Lombok Tengah dan NTB',
                ],
                'image_url' => '/images/facilities/hospital.jpg',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Perpustakaan Medis & Pusat Referensi Digital',
                'slug' => 'perpustakaan-medis',
                'category' => 'Sumber Belajar',
                'description' => 'Pusat literatur kedokteran yang menyediakan koleksi buku teks medis mutakhir, jurnal kedokteran internasional terindeks Scopus/PubMed, dan ruang diskusi kelompok kecil.',
                'features' => [
                    'Akses basis data jurnal kedokteran internasional daring',
                    'Koleksi literatur standar Konsil Kedokteran Indonesia (KKI)',
                    'Ruang belajar tenang (silent study area) dan bilik diskusi PBL',
                    'Akses intranet berkecepatan tinggi ke portal riset universitas',
                ],
                'image_url' => '/images/facilities/library.jpg',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($facilities as $fac) {
            Facility::updateOrCreate(['slug' => $fac['slug']], $fac);
        }

        // 6. Research Projects & Community Engagement
        $researches = [
            [
                'title' => 'Skrining Kesehatan Komunitas dan Deteksi Dini Penyakit Tidak Menular di Wilayah Pedesaan Lombok',
                'slug' => 'skrining-penyakit-tidak-menular-lombok',
                'category' => 'Pengabdian Masyarakat',
                'leader_name' => 'dr. I Wayan Suardana, M.Kes.',
                'summary' => 'Program pemberdayaan kader desa dan deteksi dini hipertensi serta diabetes melitus guna menekan angka komplikasi kardiovaskular pada masyarakat pesisir dan pedesaan.',
                'description' => 'Kegiatan pengabdian masyarakat multidisiplin yang melibatkan dosen dan mahasiswa kedokteran dalam pemeriksaan gula darah berkala, tensi, konseling gizi, dan pembentukan pos pembinaan terpadu.',
                'publication_date' => '2026-08-15',
                'partner_institution' => 'Dinas Kesehatan NTB & Puskesmas Lombok Barat',
                'featured_image' => '/images/facilities/skills-lab.jpg',
                'status' => 'published',
            ],
            [
                'title' => 'Evaluasi Efektivitas Problem-Based Learning (PBL) dalam Penguasaan Penalaran Klinis Mahasiswa Kedokteran',
                'slug' => 'evaluasi-efektivitas-pbl-penalaran-klinis',
                'category' => 'Penelitian',
                'leader_name' => 'Dr. dr. Ni Luh Putu Inca Buntari, M.Kes.',
                'summary' => 'Penelitian pendidikan kedokteran mengenai korelasi antara partisipasi tutorial skenario klinis dengan ketepatan perumusan diagnosis diferensial mahasiswa semester awal.',
                'description' => 'Studi komparatif longitudinal terhadap kemampuan analisis mahasiswa pada rotasi blok pre-klinik, dipublikasikan dalam jurnal pendidikan kedokteran nasional terakreditasi.',
                'publication_date' => '2026-06-20',
                'partner_institution' => 'Pusat Pengembangan Pendidikan Kedokteran UBG',
                'featured_image' => '/images/facilities/library.jpg',
                'status' => 'published',
            ],
            [
                'title' => 'Pola Sensitivitas Bakteri Patogen Terhadap Antibiotik Lini Pertama di Rumah Sakit Pendidikan',
                'slug' => 'pola-sensitivitas-bakteri-antibiotik-rs-pendidikan',
                'category' => 'Penelitian',
                'leader_name' => 'dr. Dina, Sp.PK',
                'summary' => 'Pemetaan resistensi antibiotik pada isolat klinis pasien rawat inap untuk merumuskan pedoman terapi empirik yang rasional dan efisien di rumah sakit mitra.',
                'description' => 'Riset kolaboratif departemen laboratorium dengan komite pengendalian resistensi antimikroba dalam rangka mendukung program one-health nasional.',
                'publication_date' => '2026-04-10',
                'partner_institution' => 'Komite Pengendalian Resistensi Antimikroba RSUD Praya',
                'featured_image' => '/images/facilities/anatomy-lab.jpg',
                'status' => 'published',
            ],
        ];

        foreach ($researches as $res) {
            ResearchProject::updateOrCreate(['slug' => $res['slug']], $res);
        }

        // 7. News & Announcements (Published + 1 Draft for testing status filter)
        $newsItems = [
            [
                'title' => 'Kuliah Perdana Blok Kedokteran Dasar: Membangun Etika dan Integritas Calon Dokter',
                'slug' => 'kuliah-perdana-blok-kedokteran-dasar-etika-integritas',
                'category' => 'Akademik',
                'excerpt' => 'Fakultas Kedokteran Universitas Bumigora menyelenggarakan kuliah pembuka tahun akademik yang menekankan pentingnya kompas moral, empati, dan profesionalisme dalam praktik kedokteran masa kini.',
                'content' => 'Fakultas Kedokteran Universitas Bumigora secara resmi memulai perkuliahan blok kedokteran dasar dengan kuliah tamu inspiratif yang dihadiri oleh pimpinan fakultas, jajaran dosen pendidik klinis, dan mahasiswa. Dalam sesi pembuka, Dekan menekankan bahwa kompetensi medis tanpa dibarengi humanisme dan etika profesi akan kehilangan esensi luhur kedokteran. Mahasiswa diarahkan untuk membiasakan tradisi belajar sepanjang hayat (lifelong learning) serta memegang teguh sumpah dan kode etik kedokteran Indonesia sejak hari pertama menempuh studi.',
                'featured_image' => '/images/facilities/anatomy-lab.jpg',
                'published_at' => now()->subDays(2),
                'status' => 'published',
                'views_count' => 142,
            ],
            [
                'title' => 'Penguatan Kerjasama Wahana Pendidikan Klinis Fakultas Kedokteran UBG Bersama RSUD Praya',
                'slug' => 'penguatan-kerjasama-wahana-pendidikan-klinis-rsud-praya',
                'category' => 'Kerjasama',
                'excerpt' => 'Pertemuan koordinasi jajaran pimpinan FK UBG dan direksi RSUD Praya membahas penguatan fasilitas stase klinik, sistem supervisi dokter spesialis pendidik, serta keselamatan pasien.',
                'content' => 'Guna menjamin mutu penyelenggaraan pendidikan tahap profesi dokter yang unggul dan aman bagi pasien, Fakultas Kedokteran UBG menggelar rapat kerja bersama direksi dan tim dokter pendidik klinis RSUD Praya. Pertemuan strategis ini mematangkan implementasi logbook digital, mekanisme umpan balik rotasi stase, serta program bedside teaching yang terstruktur.',
                'featured_image' => '/images/facilities/hospital.jpg',
                'published_at' => now()->subDays(6),
                'status' => 'published',
                'views_count' => 218,
            ],
            [
                'title' => 'Simulasi OSCE Terpadu: Uji Kesiapan Keterampilan Klinis Mahasiswa Kedokteran',
                'slug' => 'simulasi-osce-terpadu-uji-kesiapan-keterampilan-klinis',
                'category' => 'Kegiatan',
                'excerpt' => 'Mahasiswa mengikuti latihan Objective Structured Clinical Examination (OSCE) komprehensif di Skills Lab untuk melatih ketangkasan diagnostik dan tata laksana darurat.',
                'content' => 'Skills Lab Fakultas Kedokteran UBG melaksanakan simulasi stase ujian klinis objektif (OSCE) dengan 12 stase terpadu. Simulasi ini melibatkan pasien standar dan penguji dokter spesialis guna melatih penalaran klinis, komunikasi interpersonal terapeutik, dan penegakan tata laksana medis secara sistematis di bawah simulasi batas waktu nyata.',
                'featured_image' => '/images/facilities/skills-lab.jpg',
                'published_at' => now()->subDays(12),
                'status' => 'published',
                'views_count' => 310,
            ],
            [
                'title' => 'Penerimaan Mahasiswa Baru Fakultas Kedokteran Jalur Seleksi Berbasis Portofolio dan Tes CBT',
                'slug' => 'penerimaan-mahasiswa-baru-fk-ubg-cbt',
                'category' => 'Pengumuman',
                'excerpt' => 'Informasi resmi tahapan pendaftaran, tes potensi akademik, tes MMPI psikologi, dan pemeriksaan kesehatan untuk calon mahasiswa kedokteran tahun akademik berjalan.',
                'content' => 'Universitas Bumigora membuka pendaftaran calon mahasiswa Fakultas Kedokteran melalui jalur seleksi transparan dan terstandar nasional. Tahapan seleksi mencakup Computer-Based Test (CBT), tes kepribadian MMPI, tes bebas buta warna, dan wawancara motivasi akademik. Pendaftaran dilayani secara terpusat melalui portal resmi PMB Universitas Bumigora.',
                'featured_image' => '/images/hero/campus-intro.jpg',
                'published_at' => now()->subDays(18),
                'status' => 'published',
                'views_count' => 580,
            ],
            [
                'title' => '[DRAFT RAHASIA] Agenda Rencana Workshop Kurikulum 2027',
                'slug' => 'draft-rencana-workshop-kurikulum-2027',
                'category' => 'Internal',
                'excerpt' => 'Dokumen internal rancangan evaluasi blok elektif dan penambahan stase kedokteran bencana maritim.',
                'content' => 'Konten draft internal ini tidak boleh tampil di halaman publik karena statusnya masih draft rancangan awal.',
                'featured_image' => null,
                'published_at' => null,
                'status' => 'draft',
                'views_count' => 0,
            ],
        ];

        foreach ($newsItems as $news) {
            News::updateOrCreate(['slug' => $news['slug']], $news);
        }

        // 8. Sample Contact Message
        ContactMessage::updateOrCreate(
            ['email' => 'calon.mhs@example.com'],
            [
                'name' => 'Budi Santoso',
                'phone' => '081234567890',
                'category' => 'Informasi Pendaftaran',
                'message' => 'Selamat siang, saya ingin menanyakan perihal jadwal tes kesehatan dan syarat pendaftaran program S1 Kedokteran UBG.',
                'is_read' => false,
                'ip_address' => '127.0.0.1',
            ]
        );
    }
}
