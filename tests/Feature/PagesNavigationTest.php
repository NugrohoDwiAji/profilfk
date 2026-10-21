<?php

namespace Tests\Feature;

use App\Models\Facility;
use App\Models\FacultyMember;
use App\Models\Gallery;
use App\Models\News;
use App\Models\TeachingHospital;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesNavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_navbar_contains_all_six_menu_links_and_no_section_anchors(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Verify the fixed menu routes are present
        $response->assertSee(route('home'));
        $response->assertSee(route('profile'));
        $response->assertSee(route('curriculum'));
        $response->assertSee(route('facilities'));
        $response->assertSee(route('faculty'));
        $response->assertSee(route('hospital'));
        $response->assertSee(route('news.index'));
        $response->assertSee(route('gallery.index'));
        $response->assertSee(route('contact'));

        // Verify navigation text labels
        $response->assertSee('Beranda');
        $response->assertSee('Profil');
        $response->assertSee('Akademik');
        $response->assertSee('Kurikulum');
        $response->assertSee('Fasilitas');
        $response->assertSee('Dosen');
        $response->assertSee('RS Pendidikan');
        $response->assertSee('Berita');
        $response->assertSee('Galeri');
        $response->assertSee('Kontak');
        $response->assertDontSee('Riset & Publikasi', false);

        // Verify that navbar does NOT link to old landing page anchors
        $response->assertDontSee('href="'.route('home').'#tentang"', false);
        $response->assertDontSee('href="'.route('home').'#lingkungan"', false);
        $response->assertDontSee('href="'.route('home').'#dosen"', false);
        $response->assertDontSee('href="'.route('home').'#riset"', false);
        $response->assertDontSee('href="'.route('home').'#berita"', false);
    }

    public function test_profile_page_is_accessible(): void
    {
        FacultyMember::create([
            'name' => 'Dr. dr. Ni Luh Putu Inca Buntari, M.Kes.',
            'academic_title' => 'Dr. dr., M.Kes.',
            'position' => 'Dekan Fakultas Kedokteran',
            'category' => 'pimpinan',
            'specialization' => 'Pendidikan Kedokteran & Kesehatan Masyarakat',
            'department' => 'Manajemen Pendidikan Kedokteran',
            'bio' => 'Dekan Fakultas Kedokteran UBG.',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/profil');

        $response->assertStatus(200);
        $response->assertSee('Profil Fakultas Kedokteran');
        $response->assertSee('SAMBUTAN DEKAN');
        $response->assertSee('KOMPAS STRATEGIS');
        $response->assertSee('Visi, Misi, dan Sasaran Institusi');
        $response->assertSee('Visi & Misi Fakultas', false);
        $response->assertSee('Visi & Misi Program Studi', false);
        $response->assertSee('VISI PRODI SARJANA KEDOKTERAN');
        $response->assertSee('Profil Lulusan');
        $response->assertSee('STRUKTUR ORGANISASI');
        $response->assertSee('STRUKTUR MANAJEMEN');
        $response->assertSee('RSUD Praya');

        // Verify that STRUKTUR ORGANISASI is positioned above STRUKTUR MANAJEMEN
        $html = $response->getContent();
        $orgPos = strpos($html, 'STRUKTUR ORGANISASI');
        $mgmtPos = strpos($html, 'STRUKTUR MANAJEMEN');
        $this->assertNotFalse($orgPos);
        $this->assertNotFalse($mgmtPos);
        $this->assertLessThan($mgmtPos, $orgPos, 'STRUKTUR ORGANISASI section should appear before STRUKTUR MANAJEMEN section.');

        // Verify that mission numbers in Visi Misi are uniformly styled with blue gradient
        $response->assertSee('w-8 h-8 rounded-lg bg-gradient-to-br from-[#08244b] to-[#2466c1] text-white shadow-2xs', false);
    }

    public function test_facilities_page_is_accessible(): void
    {
        Facility::create([
            'name' => 'Laboratorium Keterampilan Klinis (Skills Lab)',
            'slug' => 'skills-lab',
            'category' => 'Simulasi & Keterampilan',
            'description' => 'Fasilitas pembelajaran keterampilan medis komprehensif.',
            'features' => ['Manikin resusitasi', 'Ruang OSCE'],
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/fasilitas');

        $response->assertStatus(200);
        $response->assertSee('Fasilitas & Lingkungan Pembelajaran', false);
        $response->assertSee('Laboratorium Keterampilan Klinis (Skills Lab)');
        $response->assertSee('Manikin resusitasi');
    }

    public function test_faculty_page_is_accessible(): void
    {
        FacultyMember::create([
            'name' => 'dr. Amy Rahmadanti, Sp.A',
            'academic_title' => 'dr., Sp.A',
            'position' => 'Dosen Pendidik Klinis',
            'category' => 'dosen_klinis',
            'specialization' => 'Ilmu Kesehatan Anak (Pediatri)',
            'department' => 'Departemen Ilmu Kesehatan Anak',
            'bio' => 'Dokter spesialis anak aktif pembimbing klinis.',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/dosen');

        $response->assertStatus(200);
        $response->assertSee('Dosen dan Tenaga Pendidik');
        $response->assertSee('dr. Amy Rahmadanti, Sp.A');
        $response->assertSee('Ilmu Kesehatan Anak (Pediatri)');
    }

    public function test_research_page_is_removed_and_returns_404(): void
    {
        $response = $this->get('/riset-publikasi');

        $response->assertStatus(404);
    }

    public function test_news_page_is_accessible_and_lists_published_news(): void
    {
        News::create([
            'title' => 'Workshop Kurikulum Berbasis PBL Fakultas Kedokteran',
            'slug' => 'workshop-kurikulum-berbasis-pbl-fakultas-kedokteran',
            'category' => 'Akademik',
            'excerpt' => 'Workshop peningkatan kompetensi tutor modul PBL.',
            'content' => 'Fakultas Kedokteran menyelenggarakan workshop intensif tutor skenario klinis.',
            'published_at' => now()->subDay(),
            'status' => 'published',
        ]);

        $response = $this->get('/berita');

        $response->assertStatus(200);
        $response->assertSee('Berita & Informasi Terkini', false);
        $response->assertSee('Workshop Kurikulum Berbasis PBL Fakultas Kedokteran');
    }

    public function test_contact_page_is_accessible_and_submits_message(): void
    {
        $response = $this->get('/kontak');

        $response->assertStatus(200);
        $response->assertSee('Hubungi Fakultas Kedokteran');
        $response->assertSee('Informasi Kontak Resmi');

        $postData = [
            'name' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@example.com',
            'phone' => '087812345678',
            'category' => 'Kurikulum & Akademik',
            'message' => 'Selamat sore, saya ingin menanyakan mengenai sistem penilaian OSCE di FK UBG.',
        ];

        $postResponse = $this->from('/kontak')->post('/kontak', $postData);

        $postResponse->assertRedirect('/kontak');
        $postResponse->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@example.com',
            'category' => 'Kurikulum & Akademik',
        ]);
    }

    public function test_curriculum_page_is_accessible(): void
    {
        $response = $this->get('/kurikulum');

        $response->assertStatus(200);
        $response->assertSee('Kurikulum &amp; Struktur Pembelajaran', false);
        $response->assertSee('146 SKS');
        $response->assertSee('44 SKS');
        $response->assertSee('Problem-Based Learning');
        $response->assertSee('RSUD Praya');
        $response->assertSee('Kepaniteraan Klinik');
    }

    public function test_gallery_page_is_accessible_and_displays_photos(): void
    {
        Gallery::create([
            'title' => 'Simulasi Manikin Resusitasi Jantung Paru Skills Lab',
            'image_url' => 'facilities/skills-lab.jpg',
            'category' => 'Cek Kesehatan Gratis (CKG)',
            'description' => 'Latihan prosedur darurat medis mahasiswa kedokteran.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/galeri');

        $response->assertStatus(200);
        $response->assertSee('Galeri Foto & Aktivitas Kampus', false);
        $response->assertSee('Simulasi Manikin Resusitasi Jantung Paru Skills Lab');
        $response->assertSee('Cek Kesehatan Gratis (CKG)');
    }

    public function test_hospital_page_is_accessible_and_lists_teaching_hospitals(): void
    {
        TeachingHospital::seedDefaults();

        $response = $this->get('/rs-pendidikan');

        $response->assertStatus(200);
        $response->assertSee('Rumah Sakit Pendidikan &amp; Jejaring Klinis', false);
        $response->assertSee('Rumah Sakit Umum Daerah (RSUD) Praya');
        $response->assertSee('RS Jiwa Mutiara Sukma NTB');
        $response->assertSee('Rumah Sakit Mata NTB');
        $response->assertSee('RS Bhayangkara Mataram');
        $response->assertSee('Tahapan Rotasi Dokter Muda (Koas)');
    }

    public function test_active_menu_indicator_highlights_corresponding_page(): void
    {
        $routes = [
            '/' => 'Beranda',
            '/profil' => 'Profil',
            '/kurikulum' => 'Kurikulum',
            '/fasilitas' => 'Fasilitas',
            '/dosen' => 'Dosen',
            '/rs-pendidikan' => 'RS Pendidikan',
            '/berita' => 'Berita',
            '/galeri' => 'Galeri',
            '/kontak' => 'Kontak',
        ];

        foreach ($routes as $uri => $menuName) {
            $response = $this->get($uri);
            $response->assertStatus(200);
            $response->assertSee($menuName, false);
        }
    }
}
