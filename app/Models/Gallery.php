<?php

namespace App\Models;

use App\Casts\TranslatableCast;
use App\Models\Concerns\CleansUpFiles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use CleansUpFiles;
    use HasFactory;

    protected array $fileAttributes = ['image_url'];

    public const CATEGORIES = [
        'Cek Kesehatan Gratis (CKG)' => 'Cek Kesehatan Gratis (CKG)',
        'Praktikum & Klinis' => 'Praktikum & Klinis',
        'Fasilitas & Lab' => 'Fasilitas & Lab',
        'Kegiatan Akademik' => 'Kegiatan Akademik',
        'Rumah Sakit Pendidikan' => 'Rumah Sakit Pendidikan',
        'Kegiatan Mahasiswa' => 'Kegiatan Mahasiswa',
    ];

    protected $fillable = [
        'title',
        'image_url',
        'category',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'title' => TranslatableCast::class,
        'description' => TranslatableCast::class,
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc');
    }

    public function getImageSrcAttribute(): ?string
    {
        if (! $this->image_url) {
            return null;
        }

        if (str_starts_with($this->image_url, 'http://') || str_starts_with($this->image_url, 'https://')) {
            return $this->image_url;
        }

        $cleaned = ltrim($this->image_url, '/');

        if (file_exists(public_path($cleaned))) {
            return asset($cleaned);
        }

        return asset('storage/'.$cleaned);
    }

    /**
     * Seed initial default gallery items if table is empty.
     */
    public static function seedDefaults(): void
    {
        if (static::count() > 0) {
            return;
        }

        $items = [
            [
                'title' => [
                    'id' => 'Bakti Sosial & Cek Kesehatan Gratis (CKG) bagi Warga',
                    'en' => 'Community Service & Free Health Check (CKG)',
                    'zh' => '社区服务与免费健康体检（CKG）',
                ],
                'image_url' => 'images/facilities/skills-lab.jpg',
                'category' => 'Cek Kesehatan Gratis (CKG)',
                'description' => [
                    'id' => 'Pemeriksaan tekanan darah, gula darah, dan konsultasi kesehatan gratis oleh dokter dan mahasiswa FK UBG.',
                    'en' => 'Free blood pressure, blood sugar checks, and health consultations by FK UBG doctors and students.',
                    'zh' => 'FK UBG医生和学生提供免费血压、血糖检查及健康咨询。',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => [
                    'id' => 'Simulasi Keterampilan Klinis di OSCE Skills Lab',
                    'en' => 'Clinical Skills Simulation at OSCE Skills Lab',
                    'zh' => 'OSCE技能实验室临床技能模拟',
                ],
                'image_url' => 'images/facilities/skills-lab.jpg',
                'category' => 'Praktikum & Klinis',
                'description' => [
                    'id' => 'Mahasiswa kedokteran berlatih penanganan pasien menggunakan manikin resusitasi dan simulator medis modern.',
                    'en' => 'Medical students practicing patient management using resuscitation manikins and modern medical simulators.',
                    'zh' => '医学生使用复苏模型和现代医疗模拟器进行患者管理练习。',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => [
                    'id' => 'Praktikum Anatomi & Mikroskopik Biomedik',
                    'en' => 'Anatomy & Microscopic Biomedical Practicum',
                    'zh' => '解剖学与显微生物医学实习',
                ],
                'image_url' => 'images/facilities/anatomy-lab.jpg',
                'category' => 'Fasilitas & Lab',
                'description' => [
                    'id' => 'Observasi preparat histologi dan anatomi tubuh manusia dengan mikroskop binokuler beresolusi tinggi.',
                    'en' => 'Observation of histology specimens and human anatomy using high-resolution binocular microscopes.',
                    'zh' => '使用高分辨率双目显微镜观察组织学标本和人体解剖结构。',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => [
                    'id' => 'Kepaniteraan Klinik di RSUD Praya Lombok Tengah',
                    'en' => 'Clinical Clerkship at RSUD Praya Central Lombok',
                    'zh' => '中龙目岛Praya地区医院临床实习',
                ],
                'image_url' => 'images/facilities/hospital.jpg',
                'category' => 'Rumah Sakit Pendidikan',
                'description' => [
                    'id' => 'Dokter muda menjalani rotasi klinik komprehensif di rumah sakit jejaring pendidikan utama.',
                    'en' => 'Young doctors undergoing comprehensive clinical rotations at the primary teaching network hospital.',
                    'zh' => '年轻医生在主要教学合作医院进行全面的临床轮转。',
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => [
                    'id' => 'Pusat Referensi Medis & Perpustakaan Digital FK',
                    'en' => 'Medical Reference Center & Digital Library',
                    'zh' => '医学院医学参考中心和数字图书馆',
                ],
                'image_url' => 'images/facilities/library.jpg',
                'category' => 'Fasilitas & Lab',
                'description' => [
                    'id' => 'Ruang belajar mandiri dan diskusi kelompok dilengkapi akses jurnal internasional bereputasi.',
                    'en' => 'Independent study and group discussion spaces equipped with access to reputable international journals.',
                    'zh' => '自主学习和小组讨论区，配备权威国际期刊访问权限。',
                ],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => [
                    'id' => 'Gedung Rektorat & Kampus Terpadu Universitas Bumigora',
                    'en' => 'Integrated Campus & Rectorate Building',
                    'zh' => '布米戈拉大学综合校区与校长楼',
                ],
                'image_url' => 'images/hero/campus-intro.png',
                'category' => 'Kegiatan Akademik',
                'description' => [
                    'id' => 'Lingkungan kampus asri, modern, dan representatif di pusat Kota Mataram, Nusa Tenggara Barat.',
                    'en' => 'A green, modern, and representative campus environment in central Mataram, West Nusa Tenggara.',
                    'zh' => '位于西努沙登加拉马塔兰市中心的环境优美、现代化的代表性校园环境。',
                ],
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => [
                    'id' => 'Diskusi Kasus Problem-Based Learning (PBL)',
                    'en' => 'Problem-Based Learning (PBL) Case Discussion',
                    'zh' => '基于问题的学习（PBL）病例讨论',
                ],
                'image_url' => 'images/hero/hero-doctor.png',
                'category' => 'Kegiatan Akademik',
                'description' => [
                    'id' => 'Tutor dan mahasiswa mendiskusikan skenario klinis terintegrasi sistem organ tubuh manusia.',
                    'en' => 'Tutors and students discuss clinical scenarios integrated with human body organ systems.',
                    'zh' => '导师和学生讨论与人体器官系统相结合的临床情境。',
                ],
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            static::create($item);
        }
    }
}
