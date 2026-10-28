<?php

namespace Tests\Feature;

use App\Filament\Resources\Curriculums\Pages\CreateCurriculum;
use App\Filament\Resources\FacultyMembers\Pages\CreateFacultyMember;
use App\Models\Curriculum;
use App\Models\Facility;
use App\Models\FacultyMember;
use App\Models\Gallery;
use App\Models\News;
use App\Models\OrganizationStructure;
use App\Models\Program;
use App\Models\TeachingHospital;
use App\Models\User;
use App\Models\VisionMission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_login_page_is_accessible(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('FK UBG - Panel Admin');
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('FK UBG - Panel Admin');
        $response->assertSee('Pesan Masuk Baru');
        $response->assertSee('Berita Terpublikasi');
        $response->assertSee('Dosen &amp; Tenaga Ahli', false);
        $response->assertSee('Fasilitas &amp; Laboratorium', false);
        $response->assertSee('Struktur Organisasi');
        $response->assertDontSee('Riset &amp; Fasilitas', false);
        $response->assertSee('Pesan Kontak Masuk Terbaru');
        $response->assertSee('Berita &amp; Pengumuman Terbaru', false);
    }

    public function test_authenticated_admin_can_access_all_filament_resources(): void
    {
        $user = User::factory()->create();

        $resources = [
            '/admin/news',
            '/admin/news/create',
            '/admin/programs',
            '/admin/programs/create',
            '/admin/faculty-members',
            '/admin/faculty-members/create',
            '/admin/facilities',
            '/admin/facilities/create',
            '/admin/teaching-hospitals',
            '/admin/teaching-hospitals/create',
            '/admin/curriculums',
            '/admin/curriculums/create',
            '/admin/vision-missions',
            '/admin/vision-missions/create',
            '/admin/galleries',
            '/admin/galleries/create',
            '/admin/organization-structures',
            '/admin/organization-structures/create',
            '/admin/contact-messages',
            '/admin/site-settings',
            '/admin/site-settings/create',
        ];

        foreach ($resources as $uri) {
            $response = $this->actingAs($user)->get($uri);
            $response->assertStatus(200);
        }

        // Verify research projects admin page is removed and returns 404
        $this->actingAs($user)->get('/admin/research-projects')->assertStatus(404);
    }

    public function test_faculty_member_admin_page_renders_photo_field_and_column(): void
    {
        $user = User::factory()->create();

        // Index page renders photo column
        $indexResponse = $this->actingAs($user)->get('/admin/faculty-members');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Foto');

        // Create page renders photo upload field and full width container
        $createResponse = $this->actingAs($user)->get('/admin/faculty-members/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Foto Resmi Dosen');
        $createResponse->assertSee('fi-width-full');
    }

    public function test_facility_admin_page_renders_image_field_and_column(): void
    {
        $user = User::factory()->create();

        // Index page renders image column
        $indexResponse = $this->actingAs($user)->get('/admin/facilities');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Foto Sarana');

        // Create page renders image upload field and full width container
        $createResponse = $this->actingAs($user)->get('/admin/facilities/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Foto / Dokumentasi Sarana &amp; Lab', false);
        $createResponse->assertSee('fi-width-full');
    }

    public function test_program_admin_page_renders_image_field_and_column(): void
    {
        $user = User::factory()->create();

        // Index page renders image column
        $indexResponse = $this->actingAs($user)->get('/admin/programs');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Foto / Sampul');

        // Create page renders image upload field and full width container
        $createResponse = $this->actingAs($user)->get('/admin/programs/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Foto / Gambar Sampul Program Studi');
        $createResponse->assertSee('fi-width-full');
    }

    public function test_news_admin_page_renders_image_field_and_column(): void
    {
        $user = User::factory()->create();

        // Index page renders image column
        $indexResponse = $this->actingAs($user)->get('/admin/news');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Sampul');

        // Create page renders image upload field and full width container
        $createResponse = $this->actingAs($user)->get('/admin/news/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Foto / Gambar Sampul Berita');
        $createResponse->assertSee('fi-width-full');

        // Edit page renders full width container
        $news = News::create([
            'title' => 'Judul Berita Edit Test',
            'slug' => 'judul-berita-edit-test',
            'excerpt' => 'Ringkasan',
            'content' => 'Konten',
            'category' => 'Akademik',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $editResponse = $this->actingAs($user)->get("/admin/news/{$news->id}/edit");
        $editResponse->assertStatus(200);
        $editResponse->assertSee('fi-width-full');
    }

    public function test_authenticated_admin_can_access_edit_pages_for_multilingual_resources(): void
    {
        $user = User::factory()->create();

        $faculty = FacultyMember::create([
            'name' => [
                'id' => 'Dr. dr. Ni Luh Putu Inca Buntari, M.Kes.',
                'en' => '',
                'zh' => '',
            ],
            'position' => 'Dekan',
            'category' => 'pimpinan',
            'nik' => '0819027801',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $news = News::create([
            'title' => 'Judul Berita',
            'slug' => 'judul-berita',
            'excerpt' => 'Ringkasan',
            'content' => 'Konten',
            'category' => 'akademik',
            'published_at' => now(),
            'status' => 'published',
        ]);

        $program = Program::create([
            'name' => 'Kedokteran',
            'slug' => 'kedokteran',
            'degree' => 'S1',
            'degree_title' => 'S.Ked',
            'duration_semesters' => 8,
            'description' => 'Deskripsi',
        ]);

        $facility = Facility::create([
            'name' => 'Skills Lab',
            'slug' => 'skills-lab',
            'category' => 'Laboratorium',
            'description' => 'Deskripsi lab',
        ]);

        $editUris = [
            "/admin/faculty-members/{$faculty->id}/edit",
            "/admin/news/{$news->id}/edit",
            "/admin/programs/{$program->id}/edit",
            "/admin/facilities/{$facility->id}/edit",
        ];

        foreach ($editUris as $uri) {
            $response = $this->actingAs($user)->get($uri);
            $response->assertStatus(200);

            if (str_contains($uri, '/admin/faculty-members/') || str_contains($uri, '/admin/facilities/')) {
                $response->assertSee('fi-width-full');
            }
        }
    }

    public function test_multilingual_model_attributes_and_locale_rendering(): void
    {
        $news = News::create([
            'title' => [
                'id' => 'Pelantikan Dokter Baru UBG',
                'en' => 'Inauguration of New UBG Doctors',
                'zh' => 'UBG新医生就职典礼',
            ],
            'slug' => 'pelantikan-dokter-baru-ubg',
            'excerpt' => [
                'id' => 'Ringkasan berita pelantikan.',
                'en' => 'Summary of inauguration news.',
                'zh' => '就职典礼新闻摘要。',
            ],
            'content' => [
                'id' => '<p>Konten lengkap bahasa Indonesia.</p>',
                'en' => '<p>Full English content.</p>',
                'zh' => '<p>中文完整内容。</p>',
            ],
            'category' => 'akademik',
            'published_at' => now(),
            'status' => 'published',
        ]);

        // Test Indonesian locale
        app()->setLocale('id');
        $this->assertSame('Pelantikan Dokter Baru UBG', (string) $news->title);

        // Test English locale
        app()->setLocale('en');
        $this->assertSame('Inauguration of New UBG Doctors', (string) $news->title);

        // Test Chinese locale
        app()->setLocale('zh');
        $this->assertSame('UBG新医生就职典礼', (string) $news->title);

        // Test public request with English locale switch
        $this->withSession(['locale' => 'en'])
            ->get(route('news.show', $news->slug))
            ->assertStatus(200)
            ->assertSee('Inauguration of New UBG Doctors')
            ->assertSee('Full English content.', false);

        // Test public request with Chinese locale switch
        $this->withSession(['locale' => 'zh'])
            ->get(route('news.show', $news->slug))
            ->assertStatus(200)
            ->assertSee('UBG新医生就职典礼')
            ->assertSee('中文完整内容。', false);

        // Test fallback to ID when language translation is missing
        $newsWithoutChinese = News::create([
            'title' => [
                'id' => 'Judul Bahasa Indonesia Saja',
                'en' => 'Only English Title',
                'zh' => '',
            ],
            'slug' => 'judul-bahasa-indonesia-saja',
            'excerpt' => ['id' => 'Ringkasan', 'en' => 'Excerpt', 'zh' => ''],
            'content' => ['id' => 'Konten', 'en' => 'Content', 'zh' => ''],
            'category' => 'prestasi',
            'published_at' => now(),
            'status' => 'published',
        ]);

        app()->setLocale('zh');
        // Because 'zh' is empty, it should fall back to 'id'
        $this->assertSame('Judul Bahasa Indonesia Saja', (string) $newsWithoutChinese->title);
    }

    public function test_faculty_member_supports_multiple_categories(): void
    {
        $user = User::factory()->create();

        $faculty = FacultyMember::create([
            'name' => [
                'id' => 'Dr. dr. Test Dosen, Sp.B',
                'en' => '',
                'zh' => '',
            ],
            'position' => 'Dekan',
            'category' => ['pimpinan', 'dosen_spesialis'],
            'nik' => '0819999999',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $this->assertTrue($faculty->hasCategory('pimpinan'));
        $this->assertTrue($faculty->hasCategory('dosen_spesialis'));
        $this->assertFalse($faculty->hasCategory('dosen_biomedik'));
        $this->assertEquals(['Pimpinan', 'Dosen Spesialis'], $faculty->category_labels);

        $response = $this->actingAs($user)->get('/admin/faculty-members');
        $response->assertStatus(200);
        $response->assertSee('Pimpinan');
        $response->assertSee('Dosen Spesialis');

        $this->assertTrue(FacultyMember::withCategory('pimpinan')->where('id', $faculty->id)->exists());
        $this->assertTrue(FacultyMember::withCategory('dosen_spesialis')->where('id', $faculty->id)->exists());
        $this->assertFalse(FacultyMember::withCategory('dosen_biomedik')->where('id', $faculty->id)->exists());
    }

    public function test_can_create_faculty_member_with_multiple_categories_via_filament(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CreateFacultyMember::class)
            ->fillForm([
                'name.id' => 'dr. Multi Test, Sp.A',
                'category' => ['pimpinan', 'dosen_spesialis'],
                'nik' => '0899991111',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('faculty_members', [
            'nik' => '0899991111',
        ]);

        $created = FacultyMember::where('nik', '0899991111')->first();
        $this->assertEquals(['pimpinan', 'dosen_spesialis'], $created->category);
    }

    public function test_curriculum_admin_index_and_create_pages_render_correctly(): void
    {
        $user = User::factory()->create();

        // Index page renders table headers and actions
        $indexResponse = $this->actingAs($user)->get('/admin/curriculums');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Kurikulum &amp; Blok', false);
        $indexResponse->assertSee('Sinkronisasi dari API');
        $indexResponse->assertSee('Tambah Blok Manual');

        // Create page renders API search field and manual form section
        $createResponse = $this->actingAs($user)->get('/admin/curriculums/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Metode Pengisian Data: Ambil dari API / Manual');
        $createResponse->assertSee('Atau Tarik Berdasarkan Kode Blok / MK dari API');
        $createResponse->assertSee('Ambil dari API');
        $createResponse->assertSee('Informasi Blok &amp; Kurikulum Kedokteran (Manual / Edit)', false);
    }

    public function test_curriculum_sync_from_api_and_lookup_functions(): void
    {
        // Test single course lookup from API dictionary
        $lookup = Curriculum::lookupByCode('KED101');
        $this->assertNotNull($lookup);
        $this->assertEquals('KED101', $lookup['code']);
        $this->assertEquals('Pengantar Pendidikan Kedokteran & Bioetika', $lookup['name']);
        $this->assertEquals(4, $lookup['sks']);

        // Test full API sync
        $syncResult = Curriculum::syncFromApi('demo_medical_skdi');
        $this->assertTrue($syncResult['success']);
        $this->assertGreaterThan(40, $syncResult['synced']);

        $this->assertDatabaseHas('curriculums', [
            'code' => 'KED101',
            'stage' => 'sarjana',
            'semester' => 1,
        ]);

        $this->assertDatabaseHas('curriculums', [
            'code' => 'ROT001',
            'stage' => 'profesi',
            'type' => 'Stase Mayor',
        ]);
    }

    public function test_can_create_curriculum_manually_via_filament(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CreateCurriculum::class)
            ->fillForm([
                'code' => 'TEST999',
                'name.id' => 'Blok Uji Klinis Terpadu',
                'stage' => 'sarjana',
                'semester' => 3,
                'academic_phase' => 'Fase II',
                'sks' => 5,
                'type' => 'Blok Inti',
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('curriculums', [
            'code' => 'TEST999',
            'sks' => 5,
            'semester' => 3,
        ]);
    }

    public function test_public_curriculum_page_displays_database_records(): void
    {
        Curriculum::create([
            'code' => 'LIVE101',
            'name' => 'Blok Diagnostik Khusus Live DB',
            'stage' => 'sarjana',
            'semester' => 1,
            'academic_phase' => 'Fase I',
            'sks' => 6,
            'type' => 'Blok Inti',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/kurikulum');
        $response->assertStatus(200);
        $response->assertSee('LIVE101');
        $response->assertSee('Blok Diagnostik Khusus Live DB');
    }

    public function test_vision_mission_admin_pages_render_and_reflect_on_public_profile(): void
    {
        $user = User::factory()->create();

        // 1. Admin index page renders table with vision-missions
        $indexResponse = $this->actingAs($user)->get('/admin/vision-missions');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Visi &amp; Misi', false);
        $indexResponse->assertSee('Tambah Visi &amp; Misi Baru', false);

        // 2. Admin create page renders full form
        $createResponse = $this->actingAs($user)->get('/admin/vision-missions/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Informasi &amp; Tingkat Visi Misi', false);
        $createResponse->assertSee('Pernyataan Visi (3 Bahasa &amp; Poin Keunggulan)', false);
        $createResponse->assertSee('Misi Strategis (Daftar Terstruktur)', false);

        // 3. Database record reflects on public profile page
        VisionMission::create([
            'scope' => 'fakultas',
            'name' => 'Fakultas Kedokteran UBG',
            'eyebrow' => 'VISI RESMI TERUJI',
            'vision_title' => 'Menjadi FK Terdepan Skala Regional',
            'vision' => 'Visi fakultas kedokteran yang di-update via database admin panel.',
            'highlights' => ['Keunggulan Pariwisata', 'PBL Unggul'],
            'mission_title' => 'MISI UTAMA FAKULTAS',
            'missions' => [
                ['title' => 'Pilar Pendidikan Terpadu', 'description' => 'Misi pendidikan terintegrasi kurikulum blok.'],
                ['title' => 'Pilar Riset Tropis', 'description' => 'Misi penelitian penyakit maritim dan pariwisata.'],
            ],
            'theme_color' => 'blue',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $profileResponse = $this->get('/profil');
        $profileResponse->assertStatus(200);
        $profileResponse->assertSee('VISI RESMI TERUJI');
        $profileResponse->assertSee('Menjadi FK Terdepan Skala Regional');
        $profileResponse->assertSee('Visi fakultas kedokteran yang di-update via database admin panel.');
        $profileResponse->assertSee('Pilar Pendidikan Terpadu');
    }

    public function test_gallery_admin_pages_render_and_can_create_photo_item(): void
    {
        $user = User::factory()->create();

        // 1. Admin index page renders table with gallery columns
        $indexResponse = $this->actingAs($user)->get('/admin/galleries');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Galeri Foto');
        $indexResponse->assertSee('Tambah Foto Galeri');

        // 2. Admin create page renders image upload and title fields
        $createResponse = $this->actingAs($user)->get('/admin/galleries/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Foto &amp; Keterangan Galeri', false);
        $createResponse->assertSee('Foto / Gambar Galeri', false);
        $createResponse->assertSee('Judul Foto');
        $createResponse->assertSee('Akademik');
        $createResponse->assertSee('Keterampilan Klinis');
        $createResponse->assertSee('Pengabdian Masyarakat');

        // 3. Database record reflects on public gallery page
        Gallery::create([
            'title' => 'Dokumentasi Praktikum Anatomi Kadaver Sintetik',
            'image_url' => 'facilities/anatomy-lab.jpg',
            'category' => 'Akademik',
            'description' => 'Sesi praktikum struktur anatomi mahasiswa kedokteran tahun pertama.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $galleryResponse = $this->get('/galeri');
        $galleryResponse->assertStatus(200);
        $galleryResponse->assertSee('Dokumentasi Praktikum Anatomi Kadaver Sintetik');
        $galleryResponse->assertSee('Akademik', false);
    }

    public function test_teaching_hospital_admin_pages_render_and_can_create_record(): void
    {
        $user = User::factory()->create();

        // 1. Admin index page renders table with teaching hospitals
        $indexResponse = $this->actingAs($user)->get('/admin/teaching-hospitals');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('RS Pendidikan');
        $indexResponse->assertSee('Tambah RS Pendidikan');

        // 2. Admin create page renders full form
        $createResponse = $this->actingAs($user)->get('/admin/teaching-hospitals/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Informasi Rumah Sakit Pendidikan &amp; Wahana Klinis', false);
        $createResponse->assertSee('Foto / Gedung Rumah Sakit');
        $createResponse->assertSee('Nama Rumah Sakit');

        // 3. Database record reflects on public hospital page
        $hospital = TeachingHospital::create([
            'name' => 'RSUD Praya Test',
            'slug' => 'rsud-praya-test',
            'type' => 'utama',
            'description' => 'Rumah sakit pendidikan utama untuk rotasi klinik mahasiswa kedokteran.',
            'city' => 'Lombok Tengah',
            'accreditation' => 'Terakreditasi Paripurna (KARS)',
            'capacity' => '320+ Tempat Tidur',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $publicResponse = $this->get('/rs-pendidikan');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('RSUD Praya Test');
        $publicResponse->assertSee('Rumah sakit pendidikan utama untuk rotasi klinik');
    }

    public function test_organization_structure_admin_pages_render_and_can_create_record(): void
    {
        $user = User::factory()->create();

        // 1. Admin index page renders table with organization structures
        $indexResponse = $this->actingAs($user)->get('/admin/organization-structures');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Struktur Organisasi');
        $indexResponse->assertSee('Unggah Bagan Baru');

        // 2. Admin create page renders full form
        $createResponse = $this->actingAs($user)->get('/admin/organization-structures/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Bagan Struktur Organisasi Fakultas');
        $createResponse->assertSee('Gambar / Bagan Struktur Organisasi');
        $createResponse->assertSee('Judul Bagan Struktur Organisasi');

        // 3. Database record reflects on public profile page
        OrganizationStructure::create([
            'title' => 'Bagan SOTK Teruji FK UBG',
            'academic_period' => 'Periode 2026 - 2030',
            'image_url' => 'images/structure/struktur-organisasi-fk-ubg.svg',
            'description' => 'Keterangan bagan struktur organisasi teruji.',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $profileResponse = $this->get('/profil');
        $profileResponse->assertStatus(200);
        $profileResponse->assertSee('STRUKTUR ORGANISASI');
        $profileResponse->assertSee('Bagan SOTK Teruji FK UBG');
        $profileResponse->assertSee('Periode 2026 - 2030');
        $profileResponse->assertSee('Keterangan bagan struktur organisasi teruji.');
        $profileResponse->assertSee('struktur-organisasi-fk-ubg.svg');
    }
}
