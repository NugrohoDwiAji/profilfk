<?php

namespace App\Models;

use App\Casts\TranslatableCast;
use App\Models\Concerns\CleansUpFiles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingHospital extends Model
{
    use CleansUpFiles;
    use HasFactory;

    protected array $fileAttributes = ['image_url'];

    public const TYPES = [
        'utama' => 'Rumah Sakit Pendidikan Utama',
        'satelit' => 'Rumah Sakit Pendidikan Satelit',
        'afiliasi' => 'Rumah Sakit Pendidikan Afiliasi',
        'jejaring' => 'Rumah Sakit Khusus Jejaring',
    ];

    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'address',
        'city',
        'province',
        'phone',
        'email',
        'website_url',
        'google_maps_url',
        'accreditation',
        'capacity',
        'director_name',
        'departments',
        'facilities',
        'mou_number',
        'image_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'name' => TranslatableCast::class,
        'description' => TranslatableCast::class,
        'departments' => 'array',
        'facilities' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    public function getTypeLabelAttribute(): string
    {
        $label = self::TYPES[$this->type] ?? ucfirst($this->type ?? 'Utama');

        return __($label);
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
     * Seed initial default teaching hospitals if table is empty.
     */
    public static function seedDefaults(): void
    {
        if (static::count() > 0) {
            return;
        }

        $items = [
            [
                'name' => [
                    'id' => 'Rumah Sakit Umum Daerah (RSUD) Praya',
                    'en' => 'Praya Regional General Hospital (RSUD Praya)',
                    'zh' => '普拉亚地区公立医院 (RSUD Praya)',
                ],
                'slug' => 'rsud-praya',
                'type' => 'utama',
                'description' => [
                    'id' => 'Wahana utama kepaniteraan klinis (koas) mahasiswa Fakultas Kedokteran UBG dengan variasi kasus medis nyata, bimbingan konsulen dokter spesialis senior, dan fasilitas rawat inap serta penunjang diagnostik mutakhir.',
                    'en' => 'Primary clinical clerkship center for FK UBG medical students with diverse real medical cases, senior medical specialist mentoring, and advanced inpatient and diagnostic facilities.',
                    'zh' => 'FK UBG医学生的主要临床实习基地，提供丰富的真实医疗病例、资深专科医生指导以及先进的住院和诊断设施。',
                ],
                'address' => 'Jl. H. Lalu Hasyim, Praya, Kabupaten Lombok Tengah, Nusa Tenggara Barat 83511',
                'city' => 'Lombok Tengah',
                'province' => 'Nusa Tenggara Barat',
                'phone' => '(0370) 654007',
                'email' => 'rsud@lomboktengahkab.go.id',
                'website_url' => 'https://rsudpraya.lomboktengahkab.go.id',
                'google_maps_url' => 'https://maps.google.com/?q=RSUD+Praya+Lombok+Tengah',
                'accreditation' => 'Terakreditasi Paripurna (KARS)',
                'capacity' => '320+ Tempat Tidur',
                'director_name' => 'dr. Mamang Bagiansah, Sp.PD',
                'mou_number' => 'PKS No. 045/UBG/RSUD-PRY/2024',
                'image_url' => 'facilities/hospital.jpg',
                'departments' => [
                    'Departemen Ilmu Penyakit Dalam',
                    'Departemen Ilmu Bedah',
                    'Departemen Ilmu Kesehatan Anak',
                    'Departemen Obstetri & Ginekologi',
                    'Departemen Anestesiologi & Terapi Intensif',
                    'Departemen Neurologi',
                    'Departemen Radiologi & Kedokteran Nuklir',
                    'Departemen Patologi Klinik & Anatomi',
                ],
                'facilities' => [
                    'Ruang Tutorial & Diskusi Dokter Muda (Coass Room)',
                    'Perpustakaan Klinis & Akses Jurnal Digital Medis',
                    'Kamar Jaga Dokter Muda Resik & Higienis',
                    'Auditorium Presentasi Kasus & Morning Report',
                    'Instalasi Gawat Darurat (IGD) Terpadu 24 Jam',
                    'ICU, ICCU, & NICU Terstandar Nasional',
                    'Instalasi Bedah Sentral (Kamar Operasi Modern)',
                    'Poliklinik Rawat Jalan Terpadu Spesialis Lengkap',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => [
                    'id' => 'RS Jiwa Mutiara Sukma NTB',
                    'en' => 'Mutiara Sukma Psychiatric Hospital NTB',
                    'zh' => '西努沙登加拉穆蒂亚拉苏克马精神病医院',
                ],
                'slug' => 'rs-jiwa-mutiara-sukma',
                'type' => 'jejaring',
                'description' => [
                    'id' => 'Wahana kepaniteraan klinik stase Ilmu Kedokteran Jiwa (Psikiatri) mahasiswa FK UBG dengan fasilitas rehabilitasi psikiatri, neuro-behavioral unit, dan penanganan kesehatan mental terintegrasi.',
                    'en' => 'Clinical clerkship center for psychiatry rotations for FK UBG medical students with psychiatric rehabilitation, neuro-behavioral units, and comprehensive mental health care.',
                    'zh' => 'FK UBG医学生精神医学轮转的临床实习中心，设有精神康复、神经行为病房和综合心理健康护理。',
                ],
                'address' => 'Jl. Selaparang No. 4, Mataram, Nusa Tenggara Barat 83231',
                'city' => 'Mataram',
                'province' => 'Nusa Tenggara Barat',
                'phone' => '(0370) 621430',
                'accreditation' => 'Terakreditasi Paripurna (KARS)',
                'capacity' => '180+ Tempat Tidur',
                'departments' => [
                    'Departemen Psikiatri Dewasa',
                    'Departemen Psikiatri Anak & Remaja',
                    'Unit Rehabilitasi Medik & Adiksi Napza',
                    'Psikologi Klinis & Konseling Komprehensif',
                ],
                'facilities' => [
                    'Ruang Diskusi Kasus Psikiatri',
                    'Kamar Jaga Mahasiswa Koas',
                    'Poli Jiwa & Konseling Interpersonal',
                    'Ruang Rawat Khusus Neuropsikiatri',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => [
                    'id' => 'Rumah Sakit Mata NTB',
                    'en' => 'NTB Eye Hospital',
                    'zh' => '西努沙登加拉眼科医院',
                ],
                'slug' => 'rs-mata-ntb',
                'type' => 'jejaring',
                'description' => [
                    'id' => 'Pusat rujukan oftalmologi regional NTB yang menjadi wahana rotasi kepaniteraan stase Ilmu Kesehatan Mata dengan peralatan diagnostik optik presisi tinggi dan ruang bedah refraktif.',
                    'en' => 'Regional ophthalmology referral center in NTB serving as clinical rotation vehicle for Eye Health rotation with high-precision optical diagnostic equipment and refractive surgery suits.',
                    'zh' => '西努沙登加拉区域眼科转诊中心，作为眼科学临床轮转基地，配备高精度光学诊断设备和屈光手术室。',
                ],
                'address' => 'Jl. Pemuda No. 59, Mataram, Nusa Tenggara Barat 83125',
                'city' => 'Mataram',
                'province' => 'Nusa Tenggara Barat',
                'phone' => '(0370) 632341',
                'accreditation' => 'Terakreditasi Paripurna (KARS)',
                'capacity' => '50+ Tempat Tidur',
                'departments' => [
                    'Sub-spesialis Kornea & Refraksi',
                    'Sub-spesialis Glaukoma & Katarak',
                    'Sub-spesialis Retina & Vitreous',
                    'Pediatrik Oftalmologi & Strabismus',
                ],
                'facilities' => [
                    'Kamar Bedah Mata Steril Bertekanan Positif',
                    'Ruang Pemeriksaan Oftalmologi Lengkap & Slit Lamp',
                    'Ruang Pembelajaran Klinis Dokter Muda',
                    'Unit Diagnostik Laser & OCT Retina',
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => [
                    'id' => 'RS Bhayangkara Mataram',
                    'en' => 'Bhayangkara Hospital Mataram',
                    'zh' => '马塔兰巴扬卡拉医院',
                ],
                'slug' => 'rs-bhayangkara-mataram',
                'type' => 'satelit',
                'description' => [
                    'id' => 'Wahana kepaniteraan klinik kedokteran forensik, medikolegal, traumatologi darurat, dan penatalaksanaan korban kekerasan/bencana alam.',
                    'en' => 'Clinical clerkship facility for forensic medicine, medicolegal studies, emergency traumatology, and disaster casualty management.',
                    'zh' => '法医医学、法医法学、急诊创伤学以及灾难伤亡管理临床实习基地。',
                ],
                'address' => 'Jl. Langko No. 64, Mataram, Nusa Tenggara Barat 83114',
                'city' => 'Mataram',
                'province' => 'Nusa Tenggara Barat',
                'phone' => '(0370) 633333',
                'accreditation' => 'Terakreditasi Paripurna (KARS)',
                'capacity' => '120+ Tempat Tidur',
                'departments' => [
                    'Kedokteran Forensik & Medikolegal',
                    'Traumatologi & Bedah Emergensi',
                    'Instalasi Kamar Jenazah Medis Modern',
                    'Pelayanan Visum et Repertum',
                ],
                'facilities' => [
                    'Laboratorium Forensik & Otopsi Medis Terstandar',
                    'Ruang Kuliah & Diskusi Kasus Medikolegal',
                    'Kamar Jaga Dokter Muda',
                    'IGD Penanganan Trauma Medis Terpadu',
                ],
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            static::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
