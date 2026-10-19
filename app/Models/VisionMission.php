<?php

namespace App\Models;

use App\Casts\TranslatableCast;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    use HasFactory;

    protected $table = 'vision_missions';

    protected $fillable = [
        'scope',
        'name',
        'eyebrow',
        'vision_title',
        'vision',
        'highlights',
        'mission_title',
        'missions',
        'theme_color',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'name' => TranslatableCast::class,
        'eyebrow' => TranslatableCast::class,
        'vision_title' => TranslatableCast::class,
        'vision' => TranslatableCast::class,
        'mission_title' => TranslatableCast::class,
        'highlights' => 'array',
        'missions' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public const SCOPES = [
        'fakultas' => 'Fakultas Kedokteran (Tingkat Fakultas)',
        'prodi_sarjana' => 'Program Sarjana Kedokteran S1 (S.Ked)',
        'prodi_profesi' => 'Program Profesi Dokter (dr.)',
    ];

    public const THEME_COLORS = [
        'blue' => 'Biru Utama (Navy & Royal Blue)',
        'emerald' => 'Hijau Medis (Emerald & Teal)',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    public function scopeFakultas(Builder $query): Builder
    {
        return $query->where('scope', 'fakultas');
    }

    public function scopeProdiSarjana(Builder $query): Builder
    {
        return $query->where('scope', 'prodi_sarjana');
    }

    public function scopeProdiProfesi(Builder $query): Builder
    {
        return $query->where('scope', 'prodi_profesi');
    }

    /**
     * Default medical school vision and mission records.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function getInitialDefaults(): array
    {
        return [
            'fakultas' => [
                'scope' => 'fakultas',
                'name' => 'Fakultas Kedokteran',
                'eyebrow' => 'VISI FAKULTAS KEDOKTERAN',
                'vision_title' => 'Menjadi Fakultas Kedokteran Unggul Berorientasi Pelayanan Primer dan Humanisme',
                'vision' => '"Menjadi Fakultas Kedokteran yang unggul, inovatif, berstandar nasional dan berdaya saing global dengan keunggulan dalam kedokteran layanan primer, kedokteran kepulauan dan tropis, serta berlandaskan nilai-nilai etika luhur pada tahun 2035."',
                'highlights' => [
                    'Pendidikan Kedokteran Unggul',
                    'Kedokteran Tropis & Kepulauan',
                    'Bioetika & Humanisme',
                ],
                'mission_title' => 'MISI STRATEGIS FAKULTAS',
                'missions' => [
                    [
                        'title' => 'Pendidikan Terintegrasi & Berpusat pada Mahasiswa',
                        'description' => 'Menyelenggarakan pendidikan kedokteran berkualitas dengan kurikulum blok terintegrasi, metode Problem-Based Learning (PBL), dan penguatan keterampilan klinis berstandar nasional.',
                    ],
                    [
                        'title' => 'Penelitian Translasional & Kedokteran Tropis',
                        'description' => 'Mengembangkan riset biomedik, kedokteran klinis, serta penyakit tropis dan masalah kesehatan maritim/pariwisata guna menghasilkan solusi berbasis bukti bagi masyarakat.',
                    ],
                    [
                        'title' => 'Pengabdian Masyarakat & Edukasi Kesehatan Primer',
                        'description' => 'Melaksanakan pengabdian promotif dan preventif secara berkelanjutan untuk menekan prevalensi stunting, penyakit tidak menular, dan disparitas kesehatan di Nusa Tenggara Barat.',
                    ],
                    [
                        'title' => 'Kemitraan Rumah Sakit & Jejaring Global',
                        'description' => 'Membangun tata kelola fakultas yang akuntabel, transparan, dan sinergis dengan Rumah Sakit Pendidikan Utama serta wahana kesehatan jejaring.',
                    ],
                ],
                'theme_color' => 'blue',
                'is_active' => true,
                'sort_order' => 1,
            ],
            'prodi_sarjana' => [
                'scope' => 'prodi_sarjana',
                'name' => 'Program Sarjana Kedokteran (S.Ked)',
                'eyebrow' => 'VISI PRODI SARJANA KEDOKTERAN',
                'vision_title' => 'Menghasilkan Sarjana Kedokteran Unggul dalam Biomedik, Kritis, dan Beretika Luhur',
                'vision' => '"Menjadi Program Studi Sarjana Kedokteran yang unggul dan inovatif secara nasional dalam mencetak lulusan yang menguasai dasar keilmuan biomedik mutakhir, penalaran klinis kritis berbasis bukti, serta berwawasan kedokteran wisata dan kepulauan pada tahun 2035."',
                'highlights' => [
                    'Tahap Akademik (146 SKS)',
                    'Problem-Based Learning',
                    'Gelar S.Ked',
                ],
                'mission_title' => 'MISI PRODI SARJANA KEDOKTERAN',
                'missions' => [
                    [
                        'title' => 'Pendidikan Akademik Berbasis Masalah & Keterampilan Klinis Dini',
                        'description' => 'Menyelenggarakan pembelajaran aktif dengan metode Problem-Based Learning (PBL) dan Skills Lab berstandar nasional guna membangun kompetensi sains biomedik dan penalaran klinis yang kokoh.',
                    ],
                    [
                        'title' => 'Riset Kedokteran Dasar & Penyakit Tropis Pesisir',
                        'description' => 'Mengembangkan riset biomedik dan epidemiologi klinis yang berfokus pada masalah kesehatan masyarakat kepulauan, pariwisata, dan penyakit infeksi tropis endemis NTB.',
                    ],
                    [
                        'title' => 'Pengabdian Berbasis Pemberdayaan Komunitas',
                        'description' => 'Mengikutsertakan mahasiswa dalam edukasi promotif dan preventif kesehatan di fasilitas layanan primer serta sentra wisata pesisir Nusa Tenggara Barat.',
                    ],
                    [
                        'title' => 'Kesiapan Paripurna Menuju Tahap Profesi Klinik',
                        'description' => 'Mempersiapkan lulusan sarjana kedokteran yang matang dalam etika profesi, profesionalisme, dan keterampilan klinis untuk memasuki tahap kepaniteraan klinik (koas).',
                    ],
                ],
                'theme_color' => 'blue',
                'is_active' => true,
                'sort_order' => 2,
            ],
            'prodi_profesi' => [
                'scope' => 'prodi_profesi',
                'name' => 'Program Profesi Dokter (dr.)',
                'eyebrow' => 'VISI PRODI PROFESI DOKTER',
                'vision_title' => 'Melahirkan Dokter Paripurna Berorientasi Pelayanan Pasien dan Etika Luhur',
                'vision' => '"Menjadi Program Studi Pendidikan Profesi Dokter yang unggul dan terkemuka dalam mencetak dokter umum yang mahir dalam pelayanan medis holistik, tanggap kegawatdaruratan pariwisata maritim, serta berlandaskan integritas etika profesi luhur pada tahun 2035."',
                'highlights' => [
                    'Tahap Klinik (44 SKS · 2 Tahun)',
                    'RSUD Praya & Puskesmas',
                    'Gelar dr.',
                ],
                'mission_title' => 'MISI PRODI PROFESI DOKTER',
                'missions' => [
                    [
                        'title' => 'Rotasi Kepaniteraan Klinik Berstandar SKDI Komprehensif',
                        'description' => 'Menyelenggarakan rotasi klinik stase mayor dan minor di RS Pendidikan Utama RSUD Praya dan RS Jejaring di bawah bimbingan langsung Dokter Spesialis Konsulen.',
                    ],
                    [
                        'title' => 'Keahlian Pelayanan Kedokteran Keluarga & Primer',
                        'description' => 'Mengasah keterampilan diagnosis komunitas, pelayanan kesehatan primer menyeluruh, dan penanganan kasus lapangan di puskesmas jejaring NTB.',
                    ],
                    [
                        'title' => 'Keterampilan Kegawatdaruratan Medis Pariwisata',
                        'description' => 'Membekali dokter muda dengan kompetensi penanganan kegawatdaruratan trauma laut, resusitasi kardiopulmoner lanjutan, dan manajemen evakuasi medis pariwisata.',
                    ],
                    [
                        'title' => 'Internship & Profesionalisme Paripurna',
                        'description' => 'Menghasilkan dokter berjiwa Five-Star Doctor WHO yang siap menempuh Program Internsip Dokter Indonesia (PIDI) dan melayani masyarakat di seluruh pelosok tanah air.',
                    ],
                ],
                'theme_color' => 'emerald',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];
    }

    /**
     * Ensure standard default records are present in the database.
     */
    public static function seedDefaults(): void
    {
        foreach (self::getInitialDefaults() as $scope => $data) {
            self::updateOrCreate(
                ['scope' => $scope],
                $data
            );
        }
    }
}
