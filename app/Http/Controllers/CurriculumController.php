<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\Program;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

class CurriculumController extends Controller
{
    /**
     * Display the official medical curriculum and study structure page.
     */
    public function index(): View
    {
        $settings = SiteSetting::allMap();
        $programs = Program::active()->get();

        // 1. Academic Phases
        $phases = [
            [
                'phase' => 'Fase I',
                'title' => 'Keterampilan Belajar, Perilaku, Komunikasi, dan Ilmu Biomedik',
                'semesters' => 'Semester 1 – 2 (Tahun ke-1)',
                'sks' => '',
                'description' => 'Tahap pertama berfokus pada pembentukan fondasi sebagai mahasiswa kedokteran. Mahasiswa mulai mempelajari cara belajar yang efektif, membangun perilaku profesional, mengembangkan keterampilan komunikasi, serta memahami ilmu dasar yang menjadi landasan ilmu kedokteran.',
                'color' => 'from-blue-600 to-indigo-700',
                'icon' => 'microscope',
            ],
            [
                'phase' => 'Fase II',
                'title' => 'Patofisiologi dan Ilmu Kedokteran Klinik',
                'semesters' => 'Semester 3 – 4 (Tahun ke-2)',
                'sks' => '',
                'description' => 'Tahap kedua berfokus pada pemahaman tentang mekanisme terjadinya penyakit dan kaitannya dengan fungsi normal tubuh manusia. Mahasiswa mulai menghubungkan pengetahuan ilmu dasar dengan berbagai kondisi klinis yang dialami pasien.',
                'color' => 'from-blue-600 to-indigo-700',
                'icon' => 'heart-pulse',
            ],
            [
                'phase' => 'Fase III',
                'title' => 'Patofisiologi dan Ilmu Kedokteran Klinik',
                'semesters' => 'Semester 5 – 7 (Tahun ke-3 & 4)',
                'sks' => '',
                'description' => 'Pada tahun ketiga, fokus pembelajaran dengan tema yang sama berlanjut ke pendalaman dan integrasi pengetahuan klinis. Mahasiswa diarahkan untuk menerapkan konsep patofisiologi dalam menganalisis kasus yang lebih kompleks serta mengembangkan keterampilan klinis sesuai dengan kurikulum yang diterapkan.',
                'color' => 'from-blue-600 to-indigo-700',
                'icon' => 'award',
            ],
            [
                'phase' => 'Fase IV',
                'title' => 'Manajemen Holistik dan Komprehensif dalam Perawatan Kesehatan',
                'semesters' => 'Semester 8 – 11 (2 Tahun Rotasi RS)',
                'sks' => '',
                'description' => 'Tahap keempat menekankan pendekatan menyeluruh dalam memahami dan menangani masalah kesehatan. Mahasiswa belajar mempertimbangkan kondisi biologis, psikologis, sosial, budaya, serta lingkungan pasien dalam proses pelayanan kesehatan.',
                'color' => 'from-blue-600 to-indigo-700',
                'icon' => 'stethoscope',
            ],
        ];

        // 2. Fetch from Database Curriculum Model (with fallback)
        $curriculums = Curriculum::active()->get();

        if ($curriculums->isNotEmpty()) {
            $semesterMeta = [
                1 => ['name' => 'Semester 1', 'year' => 'Tahun ke-1 (Fase I)', 'focus' => 'Landasan Keilmuan Kedokteran, Biologi Seluler & Bioetika'],
                2 => ['name' => 'Semester 2', 'year' => 'Tahun ke-1 (Fase I)', 'focus' => 'Sistem Lokomotorik, Kardiovaskular & Respirasi'],
                3 => ['name' => 'Semester 3', 'year' => 'Tahun ke-2 (Fase II)', 'focus' => 'Sistem Pencernaan, Urogenital & Imunopatologi'],
                4 => ['name' => 'Semester 4', 'year' => 'Tahun ke-2 (Fase II)', 'focus' => 'Sistem Endokrin, Reproduksi & Neuropsikiatri'],
                5 => ['name' => 'Semester 5', 'year' => 'Tahun ke-3 (Fase III)', 'focus' => 'Penginderaan Khusus, Infeksi Tropis & Kedokteran Komunitas'],
                6 => ['name' => 'Semester 6', 'year' => 'Tahun ke-3 (Fase III)', 'focus' => 'Kegawatdaruratan, Forensik Medikolegal & Proposal Skripsi'],
                7 => ['name' => 'Semester 7', 'year' => 'Tahun ke-4 (Fase III)', 'focus' => 'Kedokteran Pariwisata, Skripsi & OSCE Komprehensif'],
                8 => ['name' => 'Semester 8', 'year' => 'Tahun ke-4 (Fase III)', 'focus' => 'Transisi Pendidikan Klinik & Elektif Akhir'],
            ];

            $sarjanaGrouped = $curriculums->where('stage', 'sarjana')->groupBy('semester');
            $semesters = [];
            foreach ($semesterMeta as $semNum => $meta) {
                $blocksInSem = $sarjanaGrouped->get($semNum, collect());
                if ($blocksInSem->isEmpty()) {
                    continue;
                }

                $semesters[$semNum] = [
                    'name' => $meta['name'],
                    'year' => $meta['year'],
                    'focus' => $meta['focus'],
                    'total_sks' => (int) $blocksInSem->sum('sks'),
                    'blocks' => $blocksInSem->map(fn ($c) => [
                        'code' => $c->code,
                        'title' => (string) $c->name,
                        'sks' => $c->sks,
                        'type' => $c->type,
                    ])->values()->all(),
                ];
            }

            $profesiItems = $curriculums->where('stage', 'profesi');
            $clinicalRotations = [
                'mayor' => $profesiItems->filter(fn ($c) => str_contains(strtolower($c->type), 'mayor'))->map(fn ($c) => [
                    'name' => (string) $c->name,
                    'duration' => $c->duration ?? '10 Minggu',
                    'sks' => $c->sks,
                    'location' => $c->location ?? 'RSUD Praya',
                ])->values()->all(),
                'minor' => $profesiItems->filter(fn ($c) => ! str_contains(strtolower($c->type), 'mayor'))->map(fn ($c) => [
                    'name' => (string) $c->name,
                    'duration' => $c->duration ?? '4 Minggu',
                    'sks' => $c->sks,
                    'location' => $c->location ?? 'RSUD Praya',
                ])->values()->all(),
            ];
        } else {
            $semesters = [
                1 => [
                    'name' => 'Semester 1',
                    'year' => 'Tahun ke-1 (Fase I)',
                    'focus' => 'Landasan Keilmuan Kedokteran, Biologi Seluler & Bioetika',
                    'total_sks' => 20,
                    'blocks' => [
                        ['code' => 'KED101', 'title' => 'Pengantar Pendidikan Kedokteran & Bioetika', 'sks' => 4, 'type' => 'Blok Inti'],
                        ['code' => 'KED102', 'title' => 'Biologi Sel, Genetika & Biokimia Medis', 'sks' => 5, 'type' => 'Blok Inti'],
                        ['code' => 'KED103', 'title' => 'Homeostasis & Prinsip Biomedik Dasar', 'sks' => 5, 'type' => 'Blok Inti'],
                        ['code' => 'KLI101', 'title' => 'Keterampilan Klinis 1 (Komunikasi & Vital Sign)', 'sks' => 2, 'type' => 'Skills Lab'],
                        ['code' => 'UBG101', 'title' => 'Pendidikan Agama & Nilai Humaniora', 'sks' => 2, 'type' => 'MKDU'],
                        ['code' => 'UBG102', 'title' => 'Pancasila & Kewarganegaraan', 'sks' => 2, 'type' => 'MKDU'],
                    ],
                ],
                2 => [
                    'name' => 'Semester 2',
                    'year' => 'Tahun ke-1 (Fase I)',
                    'focus' => 'Sistem Lokomotorik, Kardiovaskular & Respirasi',
                    'total_sks' => 20,
                    'blocks' => [
                        ['code' => 'KED201', 'title' => 'Sistem Muskuloskeletal & Integumen', 'sks' => 5, 'type' => 'Blok Inti'],
                        ['code' => 'KED202', 'title' => 'Sistem Respirasi & Ventilasi Medis', 'sks' => 5, 'type' => 'Blok Inti'],
                        ['code' => 'KED203', 'title' => 'Sistem Kardiovaskular & Hemodinamik', 'sks' => 5, 'type' => 'Blok Inti'],
                        ['code' => 'KLI201', 'title' => 'Keterampilan Klinis 2 (Pemeriksaan Fisik Toraks)', 'sks' => 2, 'type' => 'Skills Lab'],
                        ['code' => 'UBG103', 'title' => 'Bahasa Inggris Medis & Komunikasi Akademik', 'sks' => 3, 'type' => 'MKDU'],
                    ],
                ],
                3 => [
                    'name' => 'Semester 3',
                    'year' => 'Tahun ke-2 (Fase II)',
                    'focus' => 'Sistem Pencernaan, Urogenital & Imunopatologi',
                    'total_sks' => 21,
                    'blocks' => [
                        ['code' => 'KED301', 'title' => 'Sistem Gastrointestinal, Hepatobilier & Nutrisi', 'sks' => 6, 'type' => 'Blok Inti'],
                        ['code' => 'KED302', 'title' => 'Sistem Ginjal, Cairan Elektrolit & Urologi', 'sks' => 6, 'type' => 'Blok Inti'],
                        ['code' => 'KED303', 'title' => 'Sistem Hematologi & Imunologi Klinis', 'sks' => 5, 'type' => 'Blok Inti'],
                        ['code' => 'KLI301', 'title' => 'Keterampilan Klinis 3 (Pemeriksaan Abdomen & Kateterisasi)', 'sks' => 2, 'type' => 'Skills Lab'],
                        ['code' => 'KED304', 'title' => 'Early Clinical Exposure (ECE) I', 'sks' => 2, 'type' => 'Lapangan'],
                    ],
                ],
                4 => [
                    'name' => 'Semester 4',
                    'year' => 'Tahun ke-2 (Fase II)',
                    'focus' => 'Sistem Endokrin, Reproduksi & Neuropsikiatri',
                    'total_sks' => 21,
                    'blocks' => [
                        ['code' => 'KED401', 'title' => 'Sistem Endokrin & Gangguan Metabolisme', 'sks' => 5, 'type' => 'Blok Inti'],
                        ['code' => 'KED402', 'title' => 'Sistem Reproduksi Manusia & Genetika Klinik', 'sks' => 6, 'type' => 'Blok Inti'],
                        ['code' => 'KED403', 'title' => 'Sistem Neuropsikiatri & Perilaku Klinis', 'sks' => 6, 'type' => 'Blok Inti'],
                        ['code' => 'KLI401', 'title' => 'Keterampilan Klinis 4 (Pemeriksaan Neurologis & Psikiatri)', 'sks' => 2, 'type' => 'Skills Lab'],
                        ['code' => 'KED404', 'title' => 'Early Clinical Exposure (ECE) II', 'sks' => 2, 'type' => 'Lapangan'],
                    ],
                ],
                5 => [
                    'name' => 'Semester 5',
                    'year' => 'Tahun ke-3 (Fase III)',
                    'focus' => 'Penginderaan Khusus, Infeksi Tropis & Kedokteran Komunitas',
                    'total_sks' => 21,
                    'blocks' => [
                        ['code' => 'KED501', 'title' => 'Penginderaan Khusus (Mata & THT-KL)', 'sks' => 5, 'type' => 'Blok Inti'],
                        ['code' => 'KED502', 'title' => 'Penyakit Tropis, Infeksi & Mikrobiologi Medis', 'sks' => 6, 'type' => 'Blok Inti'],
                        ['code' => 'KED503', 'title' => 'Kedokteran Komunitas, Epidemiologi & Kesmas', 'sks' => 5, 'type' => 'Blok Inti'],
                        ['code' => 'KLI501', 'title' => 'Keterampilan Klinis 5 (Bedah Minor & Invasif Terarah)', 'sks' => 2, 'type' => 'Skills Lab'],
                        ['code' => 'KED504', 'title' => 'Metodologi Penelitian Kedokteran & Biostatistik', 'sks' => 3, 'type' => 'Riset'],
                    ],
                ],
                6 => [
                    'name' => 'Semester 6',
                    'year' => 'Tahun ke-3 (Fase III)',
                    'focus' => 'Kegawatdaruratan, Forensik Medikolegal & Proposal Skripsi',
                    'total_sks' => 20,
                    'blocks' => [
                        ['code' => 'KED601', 'title' => 'Kegawatdaruratan Medis, Traumatologi & Anestesi', 'sks' => 6, 'type' => 'Blok Inti'],
                        ['code' => 'KED602', 'title' => 'Kedokteran Forensik, Medikolegal & Pasien Safety', 'sks' => 4, 'type' => 'Blok Inti'],
                        ['code' => 'KED603', 'title' => 'Proposal Skripsi & Etika Penelitian Medis', 'sks' => 3, 'type' => 'Riset'],
                        ['code' => 'KLI601', 'title' => 'Keterampilan Klinis 6 (Advanced Life Support & Resusitasi)', 'sks' => 3, 'type' => 'Skills Lab'],
                        ['code' => 'KED604', 'title' => 'Manajemen Praktik Dokter & Layanan Primer', 'sks' => 4, 'type' => 'Elektif'],
                    ],
                ],
                7 => [
                    'name' => 'Semester 7',
                    'year' => 'Tahun ke-4 (Fase III)',
                    'focus' => 'Kedokteran Pariwisata, Skripsi & OSCE Komprehensif',
                    'total_sks' => 22,
                    'blocks' => [
                        ['code' => 'KED701', 'title' => 'Kedokteran Pariwisata & Layanan Pesisir (Keunggulan NTB)', 'sks' => 5, 'type' => 'Keunggulan'],
                        ['code' => 'KED702', 'title' => 'Elektif Terarah (Klinis / Laboratorium / Komunitas)', 'sks' => 4, 'type' => 'Elektif'],
                        ['code' => 'KED703', 'title' => 'Skripsi & Publikasi Karya Ilmiah', 'sks' => 4, 'type' => 'Tugas Akhir'],
                        ['code' => 'KLI701', 'title' => 'OSCE Komprehensif & Ujian CBT Tahap Sarjana', 'sks' => 4, 'type' => 'Ujian Akhir'],
                        ['code' => 'KED704', 'title' => 'Transisi Pendidikan Klinik (Persiapan Koas)', 'sks' => 5, 'type' => 'Pra-Klinik'],
                    ],
                ],
            ];

            // 3. Clinical Clerkship Rotations (Tahap Profesi Dokter / Koas)
            $clinicalRotations = [
                'mayor' => [
                    ['name' => 'Ilmu Penyakit Dalam (Interna)', 'duration' => '10 Minggu', 'sks' => 5, 'location' => 'RSUD Praya'],
                    ['name' => 'Ilmu Kesehatan Anak (Pediatri)', 'duration' => '10 Minggu', 'sks' => 5, 'location' => 'RSUD Praya'],
                    ['name' => 'Ilmu Bedah (Surgery)', 'duration' => '10 Minggu', 'sks' => 5, 'location' => 'RSUD Praya'],
                    ['name' => 'Obstetri & Ginekologi (Obgyn)', 'duration' => '10 Minggu', 'sks' => 5, 'location' => 'RSUD Praya'],
                ],
                'minor' => [
                    ['name' => 'Neurologi (Ilmu Penyakit Saraf)', 'duration' => '4 Minggu', 'sks' => 2, 'location' => 'RSUD Praya / RS Jejaring'],
                    ['name' => 'Psikiatri (Kesehatan Jiwa)', 'duration' => '4 Minggu', 'sks' => 2, 'location' => 'RSJ Mutiara Sukma'],
                    ['name' => 'Ilmu Kesehatan Mata', 'duration' => '4 Minggu', 'sks' => 2, 'location' => 'RS Mata NTB / RSUD Praya'],
                    ['name' => 'Telinga Hidung Tenggorok (THT-KL)', 'duration' => '4 Minggu', 'sks' => 2, 'location' => 'RSUD Praya'],
                    ['name' => 'Dermatologi & Venereologi', 'duration' => '4 Minggu', 'sks' => 2, 'location' => 'RSUD Praya'],
                    ['name' => 'Anestesiologi & Terapi Intensif', 'duration' => '4 Minggu', 'sks' => 2, 'location' => 'RSUD Praya'],
                    ['name' => 'Radiologi & Imaging Medis', 'duration' => '4 Minggu', 'sks' => 2, 'location' => 'RSUD Praya'],
                    ['name' => 'Kedokteran Forensik & Medikolegal', 'duration' => '4 Minggu', 'sks' => 2, 'location' => 'RS Bhayangkara / RSUD Praya'],
                    ['name' => 'IKM & Kedokteran Komunitas', 'duration' => '8 Minggu', 'sks' => 4, 'location' => 'Puskesmas Jejaring NTB'],
                ],
            ];
        }

        // 4. Learning Method Pillars
        $methods = [
            [
                'title' => 'Problem-Based Learning (PBL)',
                'subtitle' => 'Diskusi Tutorial Seven Jumps',
                'description' => 'Mahasiswa belajar memecahkan skenario kasus klinis nyata dalam kelompok kecil terarah dipandu tutor dosen medis berpengalaman.',
                'icon' => 'check',
            ],
            [
                'title' => 'Skills Lab & OSCE Berstandar Nasional',
                'subtitle' => 'Pelatihan Simulasi Klinis',
                'description' => 'Latihan prosedur medis menggunakan manikin berteknologi tinggi dan simulasi pasien terstandar sebelum berinteraksi dengan pasien nyata.',
                'icon' => 'stethoscope',
            ],
            [
                'title' => 'Early Clinical Exposure (ECE)',
                'subtitle' => 'Pengenalan Klinis Sejak Dini',
                'description' => 'Kunjungan dan observasi langsung ke fasilitas layanan kesehatan primer dan rumah sakit jejaring sejak tahun pertama perkuliahan.',
                'icon' => 'building',
            ],
            [
                'title' => 'Keunggulan Kedokteran Pariwisata',
                'subtitle' => 'Kontekstual Wilayah NTB',
                'description' => 'Pengayaan kompetensi penanganan kegawatdaruratan kelautan, penyakit perjalanan (travel diseases), dan evakuasi medis pariwisata.',
                'icon' => 'award',
            ],
        ];

        return view('pages.curriculum', compact(
            'settings',
            'programs',
            'phases',
            'semesters',
            'clinicalRotations',
            'methods'
        ));
    }
}
