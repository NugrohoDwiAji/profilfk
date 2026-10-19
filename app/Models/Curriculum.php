<?php

namespace App\Models;

use App\Casts\TranslatableCast;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    protected $fillable = [
        'code',
        'name',
        'stage',
        'semester',
        'academic_phase',
        'sks',
        'type',
        'duration',
        'location',
        'description',
        'api_id',
        'synced_at',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'name' => TranslatableCast::class,
        'description' => TranslatableCast::class,
        'sks' => 'integer',
        'semester' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'synced_at' => 'datetime',
    ];

    public const STAGES = [
        'sarjana' => 'Sarjana Kedokteran (S.Ked)',
        'profesi' => 'Profesi Dokter (dr.) / Koas',
    ];

    public const TYPES = [
        'Blok Inti' => 'Blok Inti Sistem Organ',
        'Skills Lab' => 'Keterampilan Klinis (Skills Lab)',
        'MKDU' => 'Mata Kuliah Dasar Umum',
        'Lapangan' => 'Early Clinical Exposure (ECE)',
        'Riset' => 'Metodologi Penelitian & Skripsi',
        'Tugas Akhir' => 'Tugas Akhir Kedokteran',
        'Keunggulan' => 'Keunggulan Kedokteran Pariwisata',
        'Elektif' => 'Blok Elektif Terarah',
        'Stase Mayor' => 'Stase Mayor Kepaniteraan Klinik (10 Minggu)',
        'Stase Minor' => 'Stase Minor Kepaniteraan Klinik (4–8 Minggu)',
    ];

    public const PHASES = [
        'Fase I' => 'Fase I: Sains Kedokteran Dasar & Humaniora (Sem 1-2)',
        'Fase II' => 'Fase II: Sistem Organ & Mekanisme Patofisiologi (Sem 3-4)',
        'Fase III' => 'Fase III: Penyakit Terintegrasi, Komunitas & Riset (Sem 5-7)',
        'Fase IV' => 'Fase IV: Kepaniteraan Klinik / Profesi Dokter',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }

    public function scopeSarjana(Builder $query): Builder
    {
        return $query->where('stage', 'sarjana');
    }

    public function scopeProfesi(Builder $query): Builder
    {
        return $query->where('stage', 'profesi');
    }

    /**
     * Standard Medical Curriculum Dictionary (SNPPDI / SKDI) for API Preset & Auto-fill.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function getStandardDictionary(): array
    {
        return [
            // Semester 1
            'KED101' => [
                'code' => 'KED101',
                'name' => 'Pengantar Pendidikan Kedokteran & Bioetika',
                'stage' => 'sarjana',
                'semester' => 1,
                'academic_phase' => 'Fase I',
                'sks' => 4,
                'type' => 'Blok Inti',
                'location' => 'Kampus FK UBG',
                'description' => 'Mempelajari prinsip pendidikan kedokteran dewasa (adult learning), etika kedokteran, bioetika klinis, dan profesionalisme dokter.',
            ],
            'KED102' => [
                'code' => 'KED102',
                'name' => 'Biologi Sel, Genetika & Biokimia Medis',
                'stage' => 'sarjana',
                'semester' => 1,
                'academic_phase' => 'Fase I',
                'sks' => 5,
                'type' => 'Blok Inti',
                'location' => 'Lab Biomedik & Anatomi UBG',
                'description' => 'Struktur dan fungsi biomolekul, biologi seluler, metabolisme sel, serta genetika molekuler manusia.',
            ],
            'KED103' => [
                'code' => 'KED103',
                'name' => 'Homeostasis & Prinsip Biomedik Dasar',
                'stage' => 'sarjana',
                'semester' => 1,
                'academic_phase' => 'Fase I',
                'sks' => 5,
                'type' => 'Blok Inti',
                'location' => 'Lab Biomedik UBG',
                'description' => 'Prinsip keseimbangan internal tubuh manusia, fisiologi seluler, dan respons homeostasis.',
            ],
            'KLI101' => [
                'code' => 'KLI101',
                'name' => 'Keterampilan Klinis 1 (Komunikasi & Vital Sign)',
                'stage' => 'sarjana',
                'semester' => 1,
                'academic_phase' => 'Fase I',
                'sks' => 2,
                'type' => 'Skills Lab',
                'location' => 'Skills Lab FK UBG',
                'description' => 'Pelatihan komunikasi dokter-pasien, informed consent, dan pengukuran tanda-tanda vital dasar.',
            ],
            'UBG101' => [
                'code' => 'UBG101',
                'name' => 'Pendidikan Agama & Nilai Humaniora',
                'stage' => 'sarjana',
                'semester' => 1,
                'academic_phase' => 'Fase I',
                'sks' => 2,
                'type' => 'MKDU',
                'location' => 'Kampus FK UBG',
                'description' => 'Penguatan nilai spiritual, moralitas, dan etika kemanusiaan dalam praktik kedokteran.',
            ],
            'UBG102' => [
                'code' => 'UBG102',
                'name' => 'Pancasila & Kewarganegaraan',
                'stage' => 'sarjana',
                'semester' => 1,
                'academic_phase' => 'Fase I',
                'sks' => 2,
                'type' => 'MKDU',
                'location' => 'Kampus FK UBG',
                'description' => 'Wawasan kebangsaan, hukum kesehatan, dan pengabdian dokter bagi tanah air.',
            ],

            // Semester 2
            'KED201' => [
                'code' => 'KED201',
                'name' => 'Sistem Muskuloskeletal & Integumen',
                'stage' => 'sarjana',
                'semester' => 2,
                'academic_phase' => 'Fase I',
                'sks' => 5,
                'type' => 'Blok Inti',
                'location' => 'Lab Anatomi & Biomedik',
                'description' => 'Struktur tulang, otot, persendian, serta struktur dan fungsi sistem kulit manusia.',
            ],
            'KED202' => [
                'code' => 'KED202',
                'name' => 'Sistem Respirasi & Ventilasi Medis',
                'stage' => 'sarjana',
                'semester' => 2,
                'academic_phase' => 'Fase I',
                'sks' => 5,
                'type' => 'Blok Inti',
                'location' => 'Lab Biomedik & Skills Lab',
                'description' => 'Anatomi saluran nafas, fisiologi ventilasi, pertukaran gas, dan patologi sistem respirasi.',
            ],
            'KED203' => [
                'code' => 'KED203',
                'name' => 'Sistem Kardiovaskular & Hemodinamik',
                'stage' => 'sarjana',
                'semester' => 2,
                'academic_phase' => 'Fase I',
                'sks' => 5,
                'type' => 'Blok Inti',
                'location' => 'Lab Anatomi & Fisiologi',
                'description' => 'Struktur jantung dan pembuluh darah, elektrofisiologi jantung, tekanan darah, dan hemodinamik.',
            ],
            'KLI201' => [
                'code' => 'KLI201',
                'name' => 'Keterampilan Klinis 2 (Pemeriksaan Fisik Toraks)',
                'stage' => 'sarjana',
                'semester' => 2,
                'academic_phase' => 'Fase I',
                'sks' => 2,
                'type' => 'Skills Lab',
                'location' => 'Skills Lab FK UBG',
                'description' => 'Inspeksi, palpasi, perkusi, dan auskultasi jantung dan paru dengan manikin audio-visual.',
            ],
            'UBG103' => [
                'code' => 'UBG103',
                'name' => 'Bahasa Inggris Medis & Komunikasi Akademik',
                'stage' => 'sarjana',
                'semester' => 2,
                'academic_phase' => 'Fase I',
                'sks' => 3,
                'type' => 'MKDU',
                'location' => 'Kampus FK UBG',
                'description' => 'Kemampuan membaca literatur ilmiah kedokteran internasional dan penulisan kasus klinis berbahasa Inggris.',
            ],

            // Semester 3
            'KED301' => [
                'code' => 'KED301',
                'name' => 'Sistem Gastrointestinal, Hepatobilier & Nutrisi',
                'stage' => 'sarjana',
                'semester' => 3,
                'academic_phase' => 'Fase II',
                'sks' => 6,
                'type' => 'Blok Inti',
                'location' => 'Lab Biomedik UBG',
                'description' => 'Fisiologi dan patofisiologi saluran cerna, hati, empedu, pankreas, dan ilmu gizi klinis.',
            ],
            'KED302' => [
                'code' => 'KED302',
                'name' => 'Sistem Ginjal, Cairan Elektrolit & Urologi',
                'stage' => 'sarjana',
                'semester' => 3,
                'academic_phase' => 'Fase II',
                'sks' => 6,
                'type' => 'Blok Inti',
                'location' => 'Lab Fisiologi UBG',
                'description' => 'Filtrasi ginjal, keseimbangan asam-basa, regulasi cairan elektrolit, dan sistem urogenital.',
            ],
            'KED303' => [
                'code' => 'KED303',
                'name' => 'Sistem Hematologi & Imunologi Klinis',
                'stage' => 'sarjana',
                'semester' => 3,
                'academic_phase' => 'Fase II',
                'sks' => 5,
                'type' => 'Blok Inti',
                'location' => 'Lab Patologi Klinik',
                'description' => 'Pembentukan sel darah, hemostasis, mekanisme respon kekebalan tubuh, dan imunopatologi.',
            ],
            'KLI301' => [
                'code' => 'KLI301',
                'name' => 'Keterampilan Klinis 3 (Pemeriksaan Abdomen & Kateterisasi)',
                'stage' => 'sarjana',
                'semester' => 3,
                'academic_phase' => 'Fase II',
                'sks' => 2,
                'type' => 'Skills Lab',
                'location' => 'Skills Lab FK UBG',
                'description' => 'Pemeriksaan fisik organ perut dan prosedur pemasangan kateter urine terstandar.',
            ],
            'KED304' => [
                'code' => 'KED304',
                'name' => 'Early Clinical Exposure (ECE) I',
                'stage' => 'sarjana',
                'semester' => 3,
                'academic_phase' => 'Fase II',
                'sks' => 2,
                'type' => 'Lapangan',
                'location' => 'Puskesmas Jejaring NTB',
                'description' => 'Observasi orientasi lapangan layanan kesehatan primer tingkat pertama.',
            ],

            // Semester 4
            'KED401' => [
                'code' => 'KED401',
                'name' => 'Sistem Endokrin & Gangguan Metabolisme',
                'stage' => 'sarjana',
                'semester' => 4,
                'academic_phase' => 'Fase II',
                'sks' => 5,
                'type' => 'Blok Inti',
                'location' => 'Lab Biomedik UBG',
                'description' => 'Aksis hormonal, diabetes melitus, tiroid, adrenal, dan kelainan metabolik sistemik.',
            ],
            'KED402' => [
                'code' => 'KED402',
                'name' => 'Sistem Reproduksi Manusia & Genetika Klinik',
                'stage' => 'sarjana',
                'semester' => 4,
                'academic_phase' => 'Fase II',
                'sks' => 6,
                'type' => 'Blok Inti',
                'location' => 'Lab Fisiologi & Anatomi',
                'description' => 'Fisiologi kehamilan, persalinan, infertilitas, dan patologi sistem reproduksi pria dan wanita.',
            ],
            'KED403' => [
                'code' => 'KED403',
                'name' => 'Sistem Neuropsikiatri & Perilaku Klinis',
                'stage' => 'sarjana',
                'semester' => 4,
                'academic_phase' => 'Fase II',
                'sks' => 6,
                'type' => 'Blok Inti',
                'location' => 'Lab Anatomi & Fisiologi Saraf',
                'description' => 'Sistem saraf pusat dan tepi, gangguan neurovaskular, psikopatologi, dan kesehatan mental.',
            ],
            'KLI401' => [
                'code' => 'KLI401',
                'name' => 'Keterampilan Klinis 4 (Pemeriksaan Neurologis & Psikiatri)',
                'stage' => 'sarjana',
                'semester' => 4,
                'academic_phase' => 'Fase II',
                'sks' => 2,
                'type' => 'Skills Lab',
                'location' => 'Skills Lab FK UBG',
                'description' => 'Pemeriksaan saraf kranialis, motorik sensorik refleks, dan anamnesis psikiatri terarah.',
            ],
            'KED404' => [
                'code' => 'KED404',
                'name' => 'Early Clinical Exposure (ECE) II',
                'stage' => 'sarjana',
                'semester' => 4,
                'academic_phase' => 'Fase II',
                'sks' => 2,
                'type' => 'Lapangan',
                'location' => 'RSUD Praya',
                'description' => 'Pengenalan alur pelayanan rumah sakit rujukan sekunder.',
            ],

            // Semester 5
            'KED501' => [
                'code' => 'KED501',
                'name' => 'Penginderaan Khusus (Mata & THT-KL)',
                'stage' => 'sarjana',
                'semester' => 5,
                'academic_phase' => 'Fase III',
                'sks' => 5,
                'type' => 'Blok Inti',
                'location' => 'Lab Fisiologi & Skills Lab',
                'description' => 'Patologi refraksi, kornea, retina, serta gangguan telinga hidung tenggorok kepala leher.',
            ],
            'KED502' => [
                'code' => 'KED502',
                'name' => 'Penyakit Tropis, Infeksi & Mikrobiologi Medis',
                'stage' => 'sarjana',
                'semester' => 5,
                'academic_phase' => 'Fase III',
                'sks' => 6,
                'type' => 'Blok Inti',
                'location' => 'Lab Mikrobiologi & Parasitologi',
                'description' => 'Malaria, demam berdarah, tuberkulosis, infeksi tropis endemik NTB, dan resistensi antimikroba.',
            ],
            'KED503' => [
                'code' => 'KED503',
                'name' => 'Kedokteran Komunitas, Epidemiologi & Kesmas',
                'stage' => 'sarjana',
                'semester' => 5,
                'academic_phase' => 'Fase III',
                'sks' => 5,
                'type' => 'Blok Inti',
                'location' => 'Komunitas Wilayah NTB',
                'description' => 'Prinsip kedokteran keluarga, keselamatan kerja (K3), surveilans epidemiologi, dan promosi kesehatan.',
            ],
            'KLI501' => [
                'code' => 'KLI501',
                'name' => 'Keterampilan Klinis 5 (Bedah Minor & Invasif Terarah)',
                'stage' => 'sarjana',
                'semester' => 5,
                'academic_phase' => 'Fase III',
                'sks' => 2,
                'type' => 'Skills Lab',
                'location' => 'Skills Lab FK UBG',
                'description' => 'Teknik asepsis bedah, penjahitan luka (hecting), insisi drainase, dan bedah minor.',
            ],
            'KED504' => [
                'code' => 'KED504',
                'name' => 'Metodologi Penelitian Kedokteran & Biostatistik',
                'stage' => 'sarjana',
                'semester' => 5,
                'academic_phase' => 'Fase III',
                'sks' => 3,
                'type' => 'Riset',
                'location' => 'Kampus FK UBG',
                'description' => 'Desain penelitian biomedis dan klinis, analisis statistik SPSS/R, dan penulisan proposal skripsi.',
            ],

            // Semester 6
            'KED601' => [
                'code' => 'KED601',
                'name' => 'Kegawatdaruratan Medis, Traumatologi & Anestesi',
                'stage' => 'sarjana',
                'semester' => 6,
                'academic_phase' => 'Fase III',
                'sks' => 6,
                'type' => 'Blok Inti',
                'location' => 'Skills Lab & RSUD Praya',
                'description' => 'Penanganan syok, trauma ganda, henti jantung nafas, manajemen jalan nafas gawat darurat, dan anestesiologi.',
            ],
            'KED602' => [
                'code' => 'KED602',
                'name' => 'Kedokteran Forensik, Medikolegal & Pasien Safety',
                'stage' => 'sarjana',
                'semester' => 6,
                'academic_phase' => 'Fase III',
                'sks' => 4,
                'type' => 'Blok Inti',
                'location' => 'Lab Forensik & Medikolegal',
                'description' => 'Visum et repertum, pemeriksaan jenazah, hukum malpraktik medik, dan prinsip keselamatan pasien.',
            ],
            'KED603' => [
                'code' => 'KED603',
                'name' => 'Proposal Skripsi & Etika Penelitian Medis',
                'stage' => 'sarjana',
                'semester' => 6,
                'academic_phase' => 'Fase III',
                'sks' => 3,
                'type' => 'Riset',
                'location' => 'Kampus FK UBG',
                'description' => 'Ujian proposal penelitian skripsi dan pengajuan kelaikan etik (ethical clearance).',
            ],
            'KLI601' => [
                'code' => 'KLI601',
                'name' => 'Keterampilan Klinis 6 (Advanced Life Support & Resusitasi)',
                'stage' => 'sarjana',
                'semester' => 6,
                'academic_phase' => 'Fase III',
                'sks' => 3,
                'type' => 'Skills Lab',
                'location' => 'Skills Lab & OSCE Center',
                'description' => 'Simulasi Advanced Cardiac Life Support (ACLS), intubasi endotrakeal, dan defibrilasi.',
            ],
            'KED604' => [
                'code' => 'KED604',
                'name' => 'Manajemen Praktik Dokter & Layanan Primer',
                'stage' => 'sarjana',
                'semester' => 6,
                'academic_phase' => 'Fase III',
                'sks' => 4,
                'type' => 'Elektif',
                'location' => 'Kampus FK UBG',
                'description' => 'Kewirausahaan medis, sistem JKN/BPJS Kesehatan, dan tata kelola klinik mandiri.',
            ],

            // Semester 7
            'KED701' => [
                'code' => 'KED701',
                'name' => 'Kedokteran Pariwisata & Layanan Pesisir (Keunggulan NTB)',
                'stage' => 'sarjana',
                'semester' => 7,
                'academic_phase' => 'Fase III',
                'sks' => 5,
                'type' => 'Keunggulan',
                'location' => 'Kawasan Wisata Bahari NTB',
                'description' => 'Keunggulan lokal FK UBG: trauma penyelaman, keracunan biota laut, evakuasi medis pariwisata, dan travel medicine.',
            ],
            'KED702' => [
                'code' => 'KED702',
                'name' => 'Elektif Terarah (Klinis / Laboratorium / Komunitas)',
                'stage' => 'sarjana',
                'semester' => 7,
                'academic_phase' => 'Fase III',
                'sks' => 4,
                'type' => 'Elektif',
                'location' => 'Wahana Pilihan Mahasiswa',
                'description' => 'Pendalaman minat khusus klinis spesialistik, riset molekuler biomedik, atau pengabdian masyarakat pesisir.',
            ],
            'KED703' => [
                'code' => 'KED703',
                'name' => 'Skripsi & Publikasi Karya Ilmiah',
                'stage' => 'sarjana',
                'semester' => 7,
                'academic_phase' => 'Fase III',
                'sks' => 4,
                'type' => 'Tugas Akhir',
                'location' => 'Kampus FK UBG',
                'description' => 'Sidang skripsi akhir sarjana kedokteran dan naskah publikasi jurnal terakreditasi.',
            ],
            'KLI701' => [
                'code' => 'KLI701',
                'name' => 'OSCE Komprehensif & Ujian CBT Tahap Sarjana',
                'stage' => 'sarjana',
                'semester' => 7,
                'academic_phase' => 'Fase III',
                'sks' => 4,
                'type' => 'Tugas Akhir',
                'location' => 'OSCE Center Nasional FK UBG',
                'description' => 'Ujian akhir komprehensif keterampilan klinis 12 stase OSCE dan ujian tulis Computer-Based Test (CBT).',
            ],
            'KED704' => [
                'code' => 'KED704',
                'name' => 'Transisi Pendidikan Klinik (Persiapan Koas)',
                'stage' => 'sarjana',
                'semester' => 7,
                'academic_phase' => 'Fase III',
                'sks' => 5,
                'type' => 'Blok Inti',
                'location' => 'RSUD Praya',
                'description' => 'Pembekalan tata tertib rumah sakit, penulisan resep, rekam medis elektronik, dan keselamatan pasien.',
            ],

            // Tahap Profesi Dokter (Koas) - Stase Mayor
            'ROT001' => [
                'code' => 'ROT001',
                'name' => 'Ilmu Penyakit Dalam (Interna)',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 5,
                'type' => 'Stase Mayor',
                'duration' => '10 Minggu',
                'location' => 'RSUD Praya',
                'description' => 'Kepaniteraan klinik komprehensif penatalaksanaan kasus penyakit dalam rawat jalan, rawat inap, dan ICU.',
            ],
            'ROT002' => [
                'code' => 'ROT002',
                'name' => 'Ilmu Kesehatan Anak (Pediatri)',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 5,
                'type' => 'Stase Mayor',
                'duration' => '10 Minggu',
                'location' => 'RSUD Praya',
                'description' => 'Kepaniteraan klinik tumbuh kembang, imunisasi, perinatologi, gizi anak, dan infeksi pediatri.',
            ],
            'ROT003' => [
                'code' => 'ROT003',
                'name' => 'Ilmu Bedah (Surgery)',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 5,
                'type' => 'Stase Mayor',
                'duration' => '10 Minggu',
                'location' => 'RSUD Praya',
                'description' => 'Kepaniteraan klinik kegawatdaruratan bedah, kamar operasi (OK), manajemen luka, dan bedah elektif.',
            ],
            'ROT004' => [
                'code' => 'ROT004',
                'name' => 'Obstetri & Ginekologi (Obgyn)',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 5,
                'type' => 'Stase Mayor',
                'duration' => '10 Minggu',
                'location' => 'RSUD Praya',
                'description' => 'Pertolongan persalinan normal terstandar, antenatal care (ANC), kegawatdaruratan obstetri, dan KB.',
            ],

            // Tahap Profesi Dokter (Koas) - Stase Minor
            'ROT005' => [
                'code' => 'ROT005',
                'name' => 'Neurologi (Ilmu Penyakit Saraf)',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 2,
                'type' => 'Stase Minor',
                'duration' => '4 Minggu',
                'location' => 'RSUD Praya / RS Jejaring',
                'description' => 'Diagnosis dan tatalaksana stroke, epilepsi, nyeri kepala, infeksi susunan saraf, dan neuropati.',
            ],
            'ROT006' => [
                'code' => 'ROT006',
                'name' => 'Psikiatri (Kesehatan Jiwa)',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 2,
                'type' => 'Stase Minor',
                'duration' => '4 Minggu',
                'location' => 'RSJ Mutiara Sukma',
                'description' => 'Wawancara psikiatri, psikofarmakologi, gangguan cemas depresi, psikosis, dan ketergantungan zat.',
            ],
            'ROT007' => [
                'code' => 'ROT007',
                'name' => 'Ilmu Kesehatan Mata',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 2,
                'type' => 'Stase Minor',
                'duration' => '4 Minggu',
                'location' => 'RS Mata NTB / RSUD Praya',
                'description' => 'Pemeriksaan tajam penglihatan, katarak, glaukoma, mata merah dengan dan tanpa visus turun.',
            ],
            'ROT008' => [
                'code' => 'ROT008',
                'name' => 'Telinga Hidung Tenggorok (THT-KL)',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 2,
                'type' => 'Stase Minor',
                'duration' => '4 Minggu',
                'location' => 'RSUD Praya',
                'description' => 'Otoskopi, rinoskopi, tatalaksana otitis media, sinusitis, tonsilitis, dan epistaksis.',
            ],
            'ROT009' => [
                'code' => 'ROT009',
                'name' => 'Dermatologi & Venereologi',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 2,
                'type' => 'Stase Minor',
                'duration' => '4 Minggu',
                'location' => 'RSUD Praya',
                'description' => 'Dermatitis, infeksi jamur bakteri parasit kulit, serta infeksi menular seksual (IMS).',
            ],
            'ROT010' => [
                'code' => 'ROT010',
                'name' => 'Anestesiologi & Terapi Intensif',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 2,
                'type' => 'Stase Minor',
                'duration' => '4 Minggu',
                'location' => 'RSUD Praya',
                'description' => 'Manajemen jalan nafas, evaluasi pra-anestesi, resusitasi cairan, dan perawatan kritis ICU.',
            ],
            'ROT011' => [
                'code' => 'ROT011',
                'name' => 'Radiologi & Imaging Medis',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 2,
                'type' => 'Stase Minor',
                'duration' => '4 Minggu',
                'location' => 'RSUD Praya',
                'description' => 'Interpretasi foto toraks, muskuloskeletal, abdomen, CT-scan dasar, dan USG emergensi.',
            ],
            'ROT012' => [
                'code' => 'ROT012',
                'name' => 'Kedokteran Forensik & Medikolegal',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 2,
                'type' => 'Stase Minor',
                'duration' => '4 Minggu',
                'location' => 'RS Bhayangkara / RSUD Praya',
                'description' => 'Pembuatan Visum et Repertum korban hidup dan mati, penentuan sebab kematian, dan etika medikolegal.',
            ],
            'ROT013' => [
                'code' => 'ROT013',
                'name' => 'IKM & Kedokteran Komunitas',
                'stage' => 'profesi',
                'semester' => null,
                'academic_phase' => 'Fase IV',
                'sks' => 4,
                'type' => 'Stase Minor',
                'duration' => '8 Minggu',
                'location' => 'Puskesmas Jejaring NTB',
                'description' => 'Rotasi komprehensif dokter keluarga, diagnosis komunitas (community diagnosis), dan manajemen Puskesmas.',
            ],
        ];
    }

    /**
     * Auto-lookup course data by course code for quick form pre-fill.
     *
     * @return array<string, mixed>|null
     */
    public static function lookupByCode(string $code): ?array
    {
        $code = strtoupper(trim($code));
        $dict = self::getStandardDictionary();

        return $dict[$code] ?? null;
    }

    /**
     * Synchronize curriculum data from API Preset or External JSON API.
     *
     * @return array{success: bool, message: string, synced: int}
     */
    public static function syncFromApi(string $preset = 'demo_medical_skdi', ?string $customUrl = null, ?string $token = null): array
    {
        $data = [];

        if ($preset === 'custom_url' && filled($customUrl)) {
            try {
                $req = Http::timeout(10);
                if (filled($token)) {
                    $req->withToken($token);
                }
                $response = $req->get($customUrl);

                if ($response->successful()) {
                    $json = $response->json();
                    $data = is_array($json['data'] ?? null) ? $json['data'] : (is_array($json) ? $json : []);
                } else {
                    return [
                        'success' => false,
                        'message' => 'API merespons status: '.$response->status().'. Gagal mengambil data.',
                        'synced' => 0,
                    ];
                }
            } catch (\Throwable $e) {
                Log::warning('API sync exception: '.$e->getMessage());

                return [
                    'success' => false,
                    'message' => 'Gagal terkoneksi ke API: '.$e->getMessage(),
                    'synced' => 0,
                ];
            }
        } else {
            // Preset API (Standard SNPPDI / SKDI Konsil Kedokteran Indonesia)
            $data = array_values(self::getStandardDictionary());
        }

        if (empty($data)) {
            return [
                'success' => false,
                'message' => 'Tidak ada data yang diterima dari API sumber.',
                'synced' => 0,
            ];
        }

        $syncedCount = 0;
        $order = 1;

        foreach ($data as $item) {
            if (empty($item['code']) || empty($item['name'])) {
                continue;
            }

            self::updateOrCreate(
                ['code' => $item['code']],
                [
                    'name' => $item['name'],
                    'stage' => $item['stage'] ?? 'sarjana',
                    'semester' => $item['semester'] ?? null,
                    'academic_phase' => $item['academic_phase'] ?? null,
                    'sks' => $item['sks'] ?? 1,
                    'type' => $item['type'] ?? 'Blok Inti',
                    'duration' => $item['duration'] ?? null,
                    'location' => $item['location'] ?? null,
                    'description' => $item['description'] ?? null,
                    'api_id' => $item['api_id'] ?? $item['code'],
                    'synced_at' => now(),
                    'is_active' => true,
                    'sort_order' => $order++,
                ]
            );

            $syncedCount++;
        }

        return [
            'success' => true,
            'message' => "Berhasil menyinkronkan {$syncedCount} mata kuliah / blok kurikulum dari API.",
            'synced' => $syncedCount,
        ];
    }
}
