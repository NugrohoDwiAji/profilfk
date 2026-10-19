<?php

namespace Tests\Feature;

use App\Models\Program;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MultilingualLocalizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_locale_switch_route_updates_session_and_redirects(): void
    {
        $response = $this->from('/profil')->get('/lang/en');
        $response->assertSessionHas('locale', 'en');
        $response->assertRedirect('/profil');

        $responseZh = $this->from('/kurikulum')->get('/lang/zh');
        $responseZh->assertSessionHas('locale', 'zh');
        $responseZh->assertRedirect('/kurikulum');

        // Invalid locale should not overwrite valid session
        $this->withSession(['locale' => 'en'])
            ->get('/lang/fr')
            ->assertSessionHas('locale', 'en');
    }

    public function test_home_page_renders_english_when_locale_is_en(): void
    {
        $response = $this->withSession(['locale' => 'en'])->get('/');

        $response->assertStatus(200);
        $response->assertSee('Home');
        $response->assertSee('Faculty Profile & Vision');
        $response->assertSee('Academics');
        $response->assertSee('Curriculum');
        $response->assertSee('Facilities');
        $response->assertSee('Teaching Hospital');
        $response->assertSee('About Faculty');
        $response->assertSee('Admission Info');
        $response->assertSee('Main Navigation');

        // Hero 4 Academic Pillars in English
        $response->assertSee('Pillar 01 · Curriculum');
        $response->assertSee('Integrated Curriculum');
        $response->assertSee('Problem-Based Learning & Blocks');
        $response->assertSee('Pillar 02 · Simulation');
        $response->assertSee('Skills Lab & OSCE');
        $response->assertSee('National Standard Clinical Simulation');
        $response->assertSee('Pillar 03 · Teaching Hospital');
        $response->assertSee('RSUD Praya Hospital');
        $response->assertSee('Main Teaching Hospital Network');
        $response->assertSee('Pillar 04 · Community');
        $response->assertSee('Community Medicine');
        $response->assertSee('Primary Care & Humanism');
    }

    public function test_home_page_renders_chinese_when_locale_is_zh(): void
    {
        $response = $this->withSession(['locale' => 'zh'])->get('/');

        $response->assertStatus(200);
        $response->assertSee('首页');
        $response->assertSee('学院概况与愿景');
        $response->assertSee('学术教务');
        $response->assertSee('课程体系');
        $response->assertSee('教学设施');
        $response->assertSee('教学医院');
        $response->assertSee('了解医学院');
        $response->assertSee('招生信息');
        $response->assertSee('主要导航');

        // Hero 4 Academic Pillars in Chinese
        $response->assertSee('支柱 01 · 课程体系');
        $response->assertSee('一体化整合课程');
        $response->assertSee('基于问题导向学习 (PBL) 与模块化教学');
        $response->assertSee('支柱 02 · 模拟教学');
        $response->assertSee('技能中心与 OSCE 考站');
        $response->assertSee('国家标准临床模拟培训');
        $response->assertSee('支柱 03 · 教学医院');
        $response->assertSee('普拉亚综合医院 (RSUD Praya)');
        $response->assertSee('核心教学医院网络');
        $response->assertSee('支柱 04 · 社区医学');
        $response->assertSee('社区医学');
        $response->assertSee('基层初级诊疗与人文关怀');
    }

    public function test_profile_page_renders_in_all_three_languages(): void
    {
        // 1. Indonesian (default)
        $responseId = $this->withSession(['locale' => 'id'])->get('/profil');
        $responseId->assertStatus(200);
        $responseId->assertSee('Profil Fakultas Kedokteran');
        $responseId->assertSee('SAMBUTAN DEKAN');

        // 2. English
        $responseEn = $this->withSession(['locale' => 'en'])->get('/profil');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('Faculty Profile');
        $responseEn->assertSee("DEAN'S WELCOME");

        // 3. Chinese
        $responseZh = $this->withSession(['locale' => 'zh'])->get('/profil');
        $responseZh->assertStatus(200);
        $responseZh->assertSee('医学院概况');
        $responseZh->assertSee('院长致辞');
    }

    public function test_curriculum_page_renders_in_all_three_languages(): void
    {
        // Indonesian
        $responseId = $this->withSession(['locale' => 'id'])->get('/kurikulum');
        $responseId->assertStatus(200);
        $responseId->assertSee('Empat Fase Pembelajaran Menuju Dokter Kompeten');

        // English
        $responseEn = $this->withSession(['locale' => 'en'])->get('/kurikulum');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('Four Learning Phases Toward Competent Doctors');

        // Chinese
        $responseZh = $this->withSession(['locale' => 'zh'])->get('/kurikulum');
        $responseZh->assertStatus(200);
        $responseZh->assertSee('通往卓越良医的四大培养阶段');
    }

    public function test_translatable_model_attributes_render_according_to_locale_from_database(): void
    {
        Program::create([
            'name' => [
                'id' => 'Sarjana Kedokteran UBG ID',
                'en' => 'Bachelor of Medicine UBG EN',
                'zh' => '布米戈拉大学医学学士 ZH',
            ],
            'slug' => 'sarjana-kedokteran',
            'degree' => 'S1',
            'degree_title' => 'S.Ked',
            'duration_semesters' => 8,
            'credits' => 146,
            'description' => [
                'id' => 'Deskripsi bahasa Indonesia',
                'en' => 'English program description',
                'zh' => '中文专业培养方案介绍',
            ],
            'is_active' => true,
            'sort_order' => 1,
        ]);

        // When locale is id
        $responseId = $this->withSession(['locale' => 'id'])->get('/program/sarjana-kedokteran');
        $responseId->assertStatus(200);
        $responseId->assertSee('Sarjana Kedokteran UBG ID');
        $responseId->assertSee('Deskripsi bahasa Indonesia');

        // When locale is en
        $responseEn = $this->withSession(['locale' => 'en'])->get('/program/sarjana-kedokteran');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('Bachelor of Medicine UBG EN');
        $responseEn->assertSee('English program description');

        // When locale is zh
        $responseZh = $this->withSession(['locale' => 'zh'])->get('/program/sarjana-kedokteran');
        $responseZh->assertStatus(200);
        $responseZh->assertSee('布米戈拉大学医学学士 ZH');
        $responseZh->assertSee('中文专业培养方案介绍');
    }

    public function test_site_setting_localized_values_resolve_per_locale(): void
    {
        SiteSetting::set('faculty_tagline', [
            'id' => 'Mencetak Dokter Humanis ID',
            'en' => 'Educating Humanistic Doctors EN',
            'zh' => '培育人道主义卓越良医 ZH',
        ]);

        app()->setLocale('id');
        $mapId = SiteSetting::allMap();
        $this->assertSame('Mencetak Dokter Humanis ID', $mapId['faculty_tagline']);

        app()->setLocale('en');
        $mapEn = SiteSetting::allMap();
        $this->assertSame('Educating Humanistic Doctors EN', $mapEn['faculty_tagline']);

        app()->setLocale('zh');
        $mapZh = SiteSetting::allMap();
        $this->assertSame('培育人道主义卓越良医 ZH', $mapZh['faculty_tagline']);
    }
}
