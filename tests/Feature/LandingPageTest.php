<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\FacultyMember;
use App\Models\News;
use App\Models\Program;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_can_be_accessed_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Fakultas Kedokteran');
        $response->assertSee('Universitas Bumigora');
        $response->assertSee('Pendidikan Kedokteran Berbasis Inovasi dengan Keunggulan Kesehatan Paru dan Gizi Anak');
        $response->assertSee('01 — KURIKULUM');
        $response->assertSee('02 — KETERAMPILAN KLINIS');
        $response->assertSee('03 — JEJARING PENDIDIKAN');
        $response->assertSee('04 — KEUNGGULAN PROGRAM STUDI');
    }

    public function test_published_news_appears_on_homepage(): void
    {
        $published = News::create([
            'title' => 'Simulasi OSCE Nasional Fakultas Kedokteran',
            'slug' => 'simulasi-osce-nasional-fakultas-kedokteran',
            'category' => 'Akademik',
            'excerpt' => 'Mahasiswa mengikuti latihan OSCE komprehensif di Skills Lab.',
            'content' => 'Latihan intensif stase klinis diselenggarakan dengan standar nasional.',
            'published_at' => now()->subDay(),
            'status' => 'published',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Simulasi OSCE Nasional Fakultas Kedokteran');
    }

    public function test_draft_news_does_not_appear_on_homepage(): void
    {
        $draft = News::create([
            'title' => 'Pengumuman Rahasia Draft Internal',
            'slug' => 'pengumuman-rahasia-draft-internal',
            'category' => 'Internal',
            'excerpt' => 'Hanya untuk penguji internal.',
            'content' => 'Draft tidak boleh tampil ke publik.',
            'published_at' => null,
            'status' => 'draft',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('Pengumuman Rahasia Draft Internal');
    }

    public function test_news_detail_page_is_accessible_for_published_news(): void
    {
        $news = News::create([
            'title' => 'Kuliah Perdana Blok Kedokteran Dasar',
            'slug' => 'kuliah-perdana-blok-kedokteran-dasar',
            'category' => 'Akademik',
            'excerpt' => 'Penguatan etika dan humanisme calon dokter.',
            'content' => 'Konten lengkap perkuliahan perdana di aula kampus.',
            'published_at' => now()->subDays(2),
            'status' => 'published',
        ]);

        $response = $this->get('/berita/'.$news->slug);

        $response->assertStatus(200);
        $response->assertSee('Kuliah Perdana Blok Kedokteran Dasar');
        $response->assertSee('Konten lengkap perkuliahan perdana di aula kampus.');
    }

    public function test_news_detail_renders_rich_html_content_without_escaping_tags(): void
    {
        $news = News::create([
            'title' => 'Berita Format HTML',
            'slug' => 'berita-format-html',
            'category' => 'Akademik',
            'excerpt' => '<p>Kutipan dengan tag html</p>',
            'content' => '<p>Paragraf pertama isi berita.</p><p>Paragraf kedua.</p>',
            'published_at' => now()->subDay(),
            'status' => 'published',
        ]);

        $response = $this->get('/berita/'.$news->slug);

        $response->assertStatus(200);
        $response->assertSee('<p>Paragraf pertama isi berita.</p>', false);
        $response->assertDontSee('&lt;p&gt;Paragraf pertama isi berita.&lt;/p&gt;', false);
        // Excerpt should have tags stripped
        $response->assertSee('Kutipan dengan tag html', false);
        $response->assertDontSee('&lt;p&gt;Kutipan dengan tag html&lt;/p&gt;', false);
    }

    public function test_news_detail_page_returns_404_for_draft_news(): void
    {
        $draft = News::create([
            'title' => 'Rencana Kerjasama Belum Diresmikan',
            'slug' => 'rencana-kerjasama-belum-diresmikan',
            'category' => 'Kerjasama',
            'excerpt' => 'Masih dalam proses perumusan.',
            'content' => 'Dokumen ini berstatus draft rahasia.',
            'published_at' => null,
            'status' => 'draft',
        ]);

        $response = $this->get('/berita/'.$draft->slug);

        $response->assertStatus(404);
    }

    public function test_program_detail_page_is_accessible(): void
    {
        $program = Program::create([
            'name' => 'Sarjana Kedokteran',
            'degree' => 'S1',
            'slug' => 'sarjana-kedokteran',
            'tagline' => 'Pendidikan Akademik Kedokteran Berbasis Problem-Based Learning',
            'description' => 'Mempersiapkan sarjana kedokteran berdaya saing global.',
            'curriculum_summary' => 'Kurikulum terintegrasi blok 148 SKS.',
            'duration_semesters' => 8,
            'degree_title' => 'S.Ked',
            'accreditation' => 'Terakreditasi LAM-PTKes',
            'is_active' => true,
        ]);

        $response = $this->get('/program/'.$program->slug);

        $response->assertStatus(200);
        $response->assertSee('Sarjana Kedokteran');
        $response->assertSee('S.Ked');
        $response->assertSee('8 Semester');
    }

    public function test_empty_state_rendered_cleanly_when_database_is_empty(): void
    {
        // When tables are completely empty
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Program Pendidikan Sedang Diperbarui');
        $response->assertSee('Daftar Dosen Sedang Diperbarui');
        $response->assertSee('Belum Ada Berita Dipublikasikan');
    }

    public function test_contact_form_submits_and_saves_message(): void
    {
        $data = [
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@example.com',
            'phone' => '081234567890',
            'category' => 'Informasi Pendaftaran',
            'message' => 'Saya ingin bertanya mengenai jadwal pendaftaran dan seleksi mahasiswa baru FK UBG.',
        ];

        $response = $this->post('/kontak', $data);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@example.com',
            'category' => 'Informasi Pendaftaran',
        ]);
    }

    public function test_contact_form_fails_validation_with_invalid_data(): void
    {
        $response = $this->post('/kontak', [
            'name' => '',
            'email' => 'not-an-email',
            'category' => '',
            'message' => 'pendek',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'category', 'message']);
        $this->assertEquals(0, ContactMessage::count());
    }

    public function test_faculty_members_appear_on_homepage(): void
    {
        FacultyMember::create([
            'name' => 'Dr. dr. Test Dosen, M.Kes.',
            'academic_title' => 'Dr. dr.',
            'nik' => '0812345678',
            'position' => 'Dekan Fakultas Kedokteran',
            'category' => 'pimpinan',
            'specialization' => 'Pendidikan Kedokteran',
            'department' => 'Manajemen Kedokteran',
            'photo_url' => '/images/faculty/dr1.png',
            'email' => 'test@fk.bumigora.ac.id',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Dr. dr. Test Dosen, M.Kes.');
        $response->assertSee('Pimpinan');
        $response->assertSee('Pendidikan Kedokteran');
    }
}
