@extends('layouts.app')

@section('title', 'Fakultas Kedokteran Universitas Bumigora | Menyiapkan Dokter Masa Depan')
@section('meta_description', 'Official landing page Fakultas Kedokteran Universitas Bumigora. Pendidikan dokter yang mengintegrasikan ilmu biomedik, keterampilan klinis, etika profesi, dan kepedulian humanis.')

@section('content')

{{-- =========================================================================
     C. HERO SECTION
     ========================================================================= --}}
<section id="hero" class="relative overflow-hidden bg-white pt-8 pb-16 lg:pt-16 lg:pb-24 border-b border-border-subtle">
    <!-- Subtle Background Accent (Academic minimal, no AI slop gradients) -->
    <div class="absolute inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute -top-24 right-0 w-96 h-96 rounded-full bg-steel-50/80 blur-3xl"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 rounded-full bg-royal-50/60 blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left Text Content (7 cols) -->
            <div class="lg:col-span-7 space-y-6 sm:space-y-8">
                <!-- Eyebrow -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase text-steel-700 bg-steel-50 border border-steel-200">
                    <span class="w-2 h-2 rounded-full bg-[#9064C2]"></span>
                    <span>FAKULTAS KEDOKTERAN · UNIVERSITAS BUMIGORA</span>
                </div>

                <!-- Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-heading tracking-tight leading-[1.15] text-balance">
                    Menyiapkan Dokter Masa Depan yang Kompeten dan Humanis
                </h1>

                <!-- Description -->
                <p class="text-base sm:text-lg text-body leading-relaxed max-w-2xl text-balance">
                    Jelajahi perjalanan pendidikan kedokteran yang mengintegrasikan ilmu pengetahuan, keterampilan klinis, etika profesi, dan kepedulian terhadap masyarakat.
                </p>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 pt-2">
                    <x-button href="#tentang" variant="secondary" size="lg" class="shadow-sm">
                        <span>Kenali Fakultas</span>
                        <x-icon name="arrow-right" class="w-4 h-4" />
                    </x-button>

                    <x-button 
                        href="{{ $settings['pmb_url'] ?? 'https://pmb.universitasbumigora.ac.id' }}" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        variant="primary" 
                        size="lg"
                        class="shadow-sm"
                    >
                        <x-icon name="graduation-cap" class="w-5 h-5" />
                        <span>Informasi Pendaftaran</span>
                    </x-button>
                </div>

                <!-- Verified Academic Pillars Indicator -->
                <div class="pt-6 border-t border-border-subtle grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div class="flex items-start gap-2.5">
                        <div class="p-1 rounded bg-steel-100/80 text-steel-700 shrink-0 mt-0.5">
                            <x-icon name="check" class="w-3.5 h-3.5" />
                        </div>
                        <div>
                            <span class="font-semibold text-heading block">Kurikulum Terintegrasi</span>
                            <span class="text-body text-[11px]">Problem-Based Learning & Blok</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="p-1 rounded bg-steel-100/80 text-steel-700 shrink-0 mt-0.5">
                            <x-icon name="stethoscope" class="w-3.5 h-3.5" />
                        </div>
                        <div>
                            <span class="font-semibold text-heading block">Skills Lab & OSCE</span>
                            <span class="text-body text-[11px]">Simulasi Klinis Standar Nasional</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="p-1 rounded bg-steel-100/80 text-steel-700 shrink-0 mt-0.5">
                            <x-icon name="building" class="w-3.5 h-3.5" />
                        </div>
                        <div>
                            <span class="font-semibold text-heading block">RSUD Praya</span>
                            <span class="text-body text-[11px]">RS Pendidikan Jejaring Utama</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Visual (5 cols) -->
            <div class="lg:col-span-5 relative flex justify-center lg:justify-end">
                <div class="relative w-full max-w-md lg:max-w-none">
                    <!-- Controlled frame with subtle border and muted accent -->
                    <div class="relative z-10 rounded-2xl overflow-hidden bg-surface border border-steel-200/80 shadow-md">
                        <img 
                            src="{{ asset('images/hero/hero-doctor.png') }}" 
                            alt="Mahasiswa Kedokteran dan Dokter Pendidik Klinis Fakultas Kedokteran UBG" 
                            class="w-full h-[400px] sm:h-[460px] object-cover object-top"
                            loading="eager"
                        >
                        <!-- Bottom Info Badge -->
                        <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-sm rounded-xl p-3.5 border border-steel-200/60 shadow-xs flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-steel-100 text-steel-700 flex items-center justify-center shrink-0">
                                <x-icon name="shield-check" class="w-5 h-5 text-[#7D99B0]" />
                            </div>
                            <div class="text-xs">
                                <span class="font-bold text-heading block">Komitmen Profesionalisme</span>
                                <span class="text-body">Pendidikan dokter berintegritas tinggi & peduli masyarakat.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Subtle backdrop accent block -->
                    <div class="absolute -bottom-3 -right-3 w-full h-full rounded-2xl border-2 border-[#7D99B0]/30 -z-1 hidden sm:block"></div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- =========================================================================
     D. FACULTY INTRODUCTION (TENTANG FAKULTAS)
     ========================================================================= --}}
<section id="tentang" class="py-16 lg:py-24 bg-surface border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left: Editorial Photo (5 cols) -->
            <div class="lg:col-span-5">
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden border border-border-subtle shadow-sm bg-white">
                        <img 
                            src="{{ asset('images/hero/campus-intro.jpg') }}" 
                            alt="Kampus Universitas Bumigora Mataram" 
                            class="w-full h-72 sm:h-96 object-cover"
                            loading="lazy"
                        >
                        <div class="p-4 bg-white text-xs border-t border-border-subtle flex items-center justify-between text-body">
                            <span class="font-medium text-heading">Kampus Universitas Bumigora</span>
                            <span>Mataram, Nusa Tenggara Barat</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Content & Verifiable Pillars (7 cols) -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#9064C2]">TENTANG FAKULTAS</span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-heading tracking-tight mt-2 leading-tight">
                        Membangun Generasi Dokter yang Berkarakter, Cakap, dan Penuh Empati
                    </h2>
                </div>

                <p class="text-body text-base leading-relaxed">
                    Fakultas Kedokteran Universitas Bumigora didirikan dengan tekad mulia memenuhi kebutuhan tenaga medis berkualitas tinggi di Nusa Tenggara Barat dan kawasan timur Indonesia. Pembelajaran dirancang secara komprehensif mulai dari dasar ilmu biomedik, keterampilan simulasi klinis terstruktur, hingga kepaniteraan klinik di rumah sakit pendidikan mitra.
                </p>

                <!-- Verifiable Values & Pillars -->
                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-white border border-border-subtle shadow-2xs">
                        <div class="w-10 h-10 rounded-lg bg-steel-50 text-steel-600 flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="book-open" class="w-5 h-5" />
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-heading">Kurikulum Blok & Problem-Based Learning</h4>
                            <p class="text-xs text-body mt-1 leading-relaxed">
                                Mahasiswa dilatih memecahkan skenario kasus klinis nyata sejak dini, melatih penalaran diferensial, penalaran etis, dan kebiasaan belajar mandiri sepanjang hayat.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-xl bg-white border border-border-subtle shadow-2xs">
                        <div class="w-10 h-10 rounded-lg bg-royal-50 text-royal-600 flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="stethoscope" class="w-5 h-5 text-[#9064C2]" />
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-heading">Skills Lab Terpadu & Standar OSCE</h4>
                            <p class="text-xs text-body mt-1 leading-relaxed">
                                Laboratorium keterampilan klinis berstandar nasional yang melatih komunikasi terapeutik, pemeriksaan fisik sistem organ, dan tata laksana kegawatdaruratan medis.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-xl bg-white border border-border-subtle shadow-2xs">
                        <div class="w-10 h-10 rounded-lg bg-steel-50 text-steel-600 flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="heart-pulse" class="w-5 h-5 text-[#7D99B0]" />
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-heading">Orientasi Kedokteran Komunitas & Layanan Primer</h4>
                            <p class="text-xs text-body mt-1 leading-relaxed">
                                Menanamkan kepekaan sosial dan kompetensi promotif-preventif guna menjawab tantangan kesehatan riil masyarakat kepulauan dan pedesaan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <x-button href="#pendidikan" variant="outline" size="md">
                        <span>Selengkapnya tentang Program Pendidikan</span>
                        <x-icon name="chevron-right" class="w-4 h-4" />
                    </x-button>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- =========================================================================
     E. ACADEMIC PROGRAMS (PROGRAM PENDIDIKAN)
     ========================================================================= --}}
<section id="pendidikan" class="py-16 lg:py-24 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-section-heading 
            eyebrow="PROGRAM AKADEMIK"
            title="Jenjang Pendidikan Kedokteran"
            subtitle="Pendidikan berkesinambungan yang dirancang untuk mengantarkan mahasiswa dari fondasi akademik biomedik hingga gelar dokter yang siap mengabdi."
        />

        @if($programs->isEmpty())
            <x-empty-state 
                title="Program Pendidikan Sedang Diperbarui"
                message="Data program studi resmi Fakultas Kedokteran Universitas Bumigora sedang dalam proses pemutakhiran sistem."
                icon="graduation-cap"
            />
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                @foreach($programs as $program)
                    <div class="rounded-2xl border border-border-subtle bg-white hover:border-steel-300 transition-all duration-200 overflow-hidden shadow-2xs hover:shadow-sm flex flex-col justify-between group">
                        <div>
                            <!-- Cover Image -->
                            <div class="h-48 sm:h-56 relative overflow-hidden bg-steel-100">
                                @if($program->image_url)
                                    <img 
                                        src="{{ asset($program->image_url) }}" 
                                        alt="{{ $program->name }}" 
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-102"
                                        loading="lazy"
                                    >
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold tracking-wide uppercase bg-white/95 text-heading shadow-xs">
                                        Jenjang {{ $program->degree }}
                                    </span>
                                </div>

                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <span class="text-xs uppercase tracking-wider text-slate-200 block">Gelar Kelulusan: {{ $program->degree_title }}</span>
                                    <h3 class="text-xl font-bold tracking-tight text-white">{{ $program->name }}</h3>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-6 sm:p-7 space-y-4">
                                <p class="text-sm text-body leading-relaxed">
                                    {{ $program->description }}
                                </p>

                                <div class="p-3.5 rounded-xl bg-surface border border-border-subtle text-xs space-y-2">
                                    <div class="flex items-center justify-between text-heading font-medium">
                                        <span class="text-body">Masa Studi Normal:</span>
                                        <span>{{ $program->duration_semesters }} Semester</span>
                                    </div>
                                    <div class="flex items-center justify-between text-heading font-medium">
                                        <span class="text-body">Status Akreditasi:</span>
                                        <span class="text-[#7D99B0] font-bold">{{ $program->accreditation ?? 'LAM-PTKes' }}</span>
                                    </div>
                                </div>

                                @if(!empty($program->career_prospects) && is_array($program->career_prospects))
                                    <div>
                                        <span class="text-xs font-semibold uppercase tracking-wider text-heading block mb-2">Fokus & Kompetensi Utama:</span>
                                        <ul class="space-y-1.5 text-xs text-body">
                                            @foreach(array_slice($program->career_prospects, 0, 3) as $prospect)
                                                <li class="flex items-start gap-2">
                                                    <span class="text-[#9064C2] font-bold mt-0.5">•</span>
                                                    <span>{{ $prospect }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Action -->
                        <div class="p-6 sm:p-7 pt-0 border-t border-border-subtle/60 flex items-center justify-between gap-4">
                            <a href="{{ route('program.show', $program->slug) }}" class="text-sm font-semibold text-heading hover:text-[#9064C2] transition-colors inline-flex items-center gap-1.5">
                                <span>Detail Kurikulum & Syarat</span>
                                <x-icon name="arrow-right" class="w-4 h-4 text-[#9064C2]" />
                            </a>
                            <x-button 
                                href="{{ $settings['pmb_url'] ?? 'https://pmb.universitasbumigora.ac.id' }}" 
                                target="_blank"
                                rel="noopener noreferrer"
                                variant="outline" 
                                size="sm"
                            >
                                <span>Pendaftaran</span>
                            </x-button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

{{-- =========================================================================
     F. ACADEMIC HIGHLIGHTS / LEARNING ENVIRONMENT (LINGKUNGAN PEMBELAJARAN)
     ========================================================================= --}}
<section id="lingkungan" class="py-16 lg:py-24 bg-surface border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-section-heading 
            eyebrow="SARANA & LINGKUNGAN BELAJAR"
            title="Fasilitas Akademik Berstandar Medis"
            subtitle="Dirancang untuk mendukung pengalaman belajar kedokteran yang komprehensif, interaktif, dan berorientasi pada keselamatan pasien."
        />

        @if($facilities->isEmpty())
            <x-empty-state 
                title="Fasilitas Sedang Diperbarui" 
                message="Informasi laboratorium dan fasilitas pembelajaran sedang disiapkan."
                icon="building"
            />
        @else
            <!-- Editorial Varied Grid: 1 Big Featured Card + 3 Balanced Grid Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                @php
                    $leadFacility = $facilities->first();
                    $otherFacilities = $facilities->slice(1);
                @endphp

                <!-- Featured Large Card (7 cols) -->
                @if($leadFacility)
                    <div class="lg:col-span-7 rounded-2xl overflow-hidden bg-white border border-border-subtle shadow-2xs flex flex-col justify-between group">
                        <div class="h-64 sm:h-80 relative overflow-hidden bg-steel-100">
                            @if($leadFacility->image_url)
                                <img 
                                    src="{{ asset($leadFacility->image_url) }}" 
                                    alt="{{ $leadFacility->name }}" 
                                    class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300"
                                    loading="lazy"
                                >
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 right-6 text-white">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-[#7D99B0] text-white mb-2 uppercase tracking-wider">
                                    {{ $leadFacility->category }}
                                </span>
                                <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-white">{{ $leadFacility->name }}</h3>
                            </div>
                        </div>
                        <div class="p-6 sm:p-8 space-y-4">
                            <p class="text-sm text-body leading-relaxed">
                                {{ $leadFacility->description }}
                            </p>
                            @if(!empty($leadFacility->features) && is_array($leadFacility->features))
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pt-2">
                                    @foreach($leadFacility->features as $feature)
                                        <div class="flex items-start gap-2 text-xs text-heading">
                                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                                            <span>{{ $feature }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- 2-3 Supporting Cards (5 cols stacked) -->
                <div class="lg:col-span-5 flex flex-col gap-6">
                    @foreach($otherFacilities as $facility)
                        <div class="rounded-2xl overflow-hidden bg-white border border-border-subtle shadow-2xs p-5 sm:p-6 flex flex-col justify-between hover:border-steel-300 transition-colors">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase tracking-wider text-[#9064C2]">
                                        {{ $facility->category }}
                                    </span>
                                    <span class="w-2 h-2 rounded-full bg-steel-300"></span>
                                </div>
                                <h4 class="text-base sm:text-lg font-bold text-heading">
                                    {{ $facility->name }}
                                </h4>
                                <p class="text-xs text-body leading-relaxed line-clamp-3">
                                    {{ $facility->description }}
                                </p>
                            </div>
                            @if(!empty($facility->features) && is_array($facility->features))
                                <div class="mt-4 pt-3 border-t border-border-subtle flex flex-wrap gap-2">
                                    @foreach(array_slice($facility->features, 0, 2) as $item)
                                        <span class="inline-flex items-center text-[11px] text-body bg-surface px-2.5 py-1 rounded-md border border-border-subtle">
                                            {{ $item }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        @endif

    </div>
</section>

{{-- =========================================================================
     G. FACULTY MEMBERS (DOSEN & TENAGA PENDIDIK)
     ========================================================================= --}}
<section id="dosen" class="py-16 lg:py-24 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ facultyFilter: 'all' }">
        
        <x-section-heading 
            eyebrow="TENAGA PENDIDIK & PAKAR"
            title="Dosen dan Pendidik Klinis"
            subtitle="Para dokter spesialis, akademisi biomedik, dan praktisi kesehatan berdedikasi membimbing calon dokter dengan keteladanan profesional."
        />

        @if($facultyMembers->isEmpty())
            <x-empty-state 
                title="Daftar Dosen Sedang Diperbarui"
                message="Daftar resmi tenaga pengajar dan dokter pendidik klinis sedang dalam tahap sinkronisasi data kepegawaian."
                icon="users"
            />
        @else
            <!-- Filter Tabs -->
            <div class="flex items-center justify-center gap-2 mb-10 overflow-x-auto pb-2">
                <button 
                    @click="facultyFilter = 'all'" 
                    :class="facultyFilter === 'all' ? 'bg-[#7D99B0] text-white shadow-xs' : 'bg-surface text-body hover:bg-steel-50'"
                    class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all cursor-pointer"
                >
                    Semua Staf
                </button>
                <button 
                    @click="facultyFilter = 'pimpinan'" 
                    :class="facultyFilter === 'pimpinan' ? 'bg-[#7D99B0] text-white shadow-xs' : 'bg-surface text-body hover:bg-steel-50'"
                    class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all cursor-pointer"
                >
                    Pimpinan Fakultas
                </button>
                <button 
                    @click="facultyFilter = 'dosen_klinis'" 
                    :class="facultyFilter === 'dosen_klinis' ? 'bg-[#7D99B0] text-white shadow-xs' : 'bg-surface text-body hover:bg-steel-50'"
                    class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all cursor-pointer"
                >
                    Dokter Spesialis & Klinis
                </button>
            </div>

            <!-- Faculty Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($facultyMembers as $faculty)
                    <div 
                        x-show="facultyFilter === 'all' || facultyFilter === '{{ $faculty->category }}'"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-98"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="rounded-2xl border border-border-subtle bg-white p-6 shadow-2xs hover:border-steel-300 transition-all flex flex-col justify-between group"
                    >
                        <div>
                            <!-- Photo and Badge -->
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden bg-steel-100 border border-steel-200 shrink-0">
                                    @if($faculty->photo_url)
                                        <img 
                                            src="{{ asset($faculty->photo_url) }}" 
                                            alt="{{ $faculty->name }}" 
                                            class="w-full h-full object-cover object-top"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-steel-400">
                                            <x-icon name="users" class="w-8 h-8" />
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="inline-block text-[11px] font-bold uppercase tracking-wider text-[#9064C2] mb-1">
                                        {{ $faculty->position }}
                                    </span>
                                    <h4 class="text-base font-bold text-heading leading-snug truncate" title="{{ $faculty->name }}">
                                        {{ $faculty->name }}
                                    </h4>
                                    <p class="text-xs text-body mt-1">
                                        {{ $faculty->specialization }}
                                    </p>
                                </div>
                            </div>

                            <p class="text-xs text-body leading-relaxed line-clamp-3 mb-4">
                                {{ $faculty->bio }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-border-subtle flex items-center justify-between text-xs">
                            <span class="text-steel-600 truncate max-w-[180px]">
                                {{ $faculty->department ?? 'Fakultas Kedokteran' }}
                            </span>
                            @if($faculty->email)
                                <a href="mailto:{{ $faculty->email }}" class="text-[#7D99B0] hover:text-[#9064C2] p-1 rounded transition-colors" title="{{ $faculty->email }}">
                                    <x-icon name="mail" class="w-4 h-4" />
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

{{-- =========================================================================
     H. RESEARCH & COMMUNITY ENGAGEMENT (RISET & PENGABDIAN)
     ========================================================================= --}}
<section id="riset" class="py-16 lg:py-24 bg-surface border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-section-heading 
            eyebrow="KONTRIBUSI ILMIAH & SOSIAL"
            title="Penelitian dan Pengabdian Masyarakat"
            subtitle="Menghadirkan bukti ilmiah dan aksi nyata untuk meningkatkan derajat kesehatan masyarakat di tingkat regional dan nasional."
        />

        @if($researches->isEmpty())
            <x-empty-state 
                title="Agenda Riset Sedang Dimutakhirkan"
                message="Data publikasi penelitian dan kegiatan pengabdian masyarakat sedang dalam proses telaah berkala."
                icon="microscope"
            />
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($researches as $research)
                    <div class="rounded-2xl border border-border-subtle bg-white p-6 shadow-2xs hover:border-steel-300 transition-all flex flex-col justify-between">
                        <div class="space-y-4">
                            <!-- Category & Date -->
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold uppercase tracking-wider text-[#9064C2]">
                                    {{ $research->category }}
                                </span>
                                @if($research->publication_date)
                                    <span class="text-steel-500">
                                        {{ \Carbon\Carbon::parse($research->publication_date)->translatedFormat('d M Y') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Title -->
                            <h3 class="text-base sm:text-lg font-bold text-heading leading-snug">
                                {{ $research->title }}
                            </h3>

                            <!-- Summary -->
                            <p class="text-xs text-body leading-relaxed">
                                {{ $research->summary }}
                            </p>
                        </div>

                        <!-- Footer Details -->
                        <div class="mt-6 pt-4 border-t border-border-subtle text-xs space-y-1">
                            <div class="flex items-center gap-1.5 text-heading font-medium">
                                <x-icon name="users" class="w-3.5 h-3.5 text-steel-500 shrink-0" />
                                <span>{{ $research->leader_name }}</span>
                            </div>
                            @if($research->partner_institution)
                                <div class="text-[11px] text-body truncate">
                                    Mitra: {{ $research->partner_institution }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

{{-- =========================================================================
     I. NEWS & ANNOUNCEMENTS (BERITA & PENGUMUMAN)
     ========================================================================= --}}
<section id="berita" class="py-16 lg:py-24 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-section-heading 
            eyebrow="KABAR KAMPUS & KEGIATAN"
            title="Berita dan Pengumuman Terkini"
            subtitle="Informasi terverifikasi mengenai kegiatan akademik, kemitraan rumah sakit, dan agenda penting Fakultas Kedokteran UBG."
        />

        @if($news->isEmpty())
            <x-empty-state 
                title="Belum Ada Berita Dipublikasikan"
                message="Warta kegiatan dan pengumuman resmi akan segera dihadirkan di halaman ini."
                icon="book-open"
            />
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($news as $item)
                    <article class="rounded-2xl border border-border-subtle bg-white overflow-hidden shadow-2xs hover:border-steel-300 transition-all flex flex-col justify-between group">
                        <div>
                            <!-- Featured Image -->
                            <div class="h-44 relative overflow-hidden bg-steel-100">
                                @if($item->featured_image)
                                    <img 
                                        src="{{ asset($item->featured_image) }}" 
                                        alt="{{ $item->title }}" 
                                        class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                @endif
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold uppercase tracking-wider bg-white/95 text-heading shadow-xs">
                                        {{ $item->category }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 space-y-2.5">
                                <div class="flex items-center gap-2 text-[11px] text-steel-500">
                                    <x-icon name="calendar" class="w-3 h-3 shrink-0" />
                                    <span>{{ $item->published_at ? $item->published_at->translatedFormat('d F Y') : '-' }}</span>
                                    <span>•</span>
                                    <span>{{ $item->reading_time }} mnt baca</span>
                                </div>

                                <h3 class="text-sm font-bold text-heading leading-snug group-hover:text-[#9064C2] transition-colors line-clamp-2">
                                    <a href="{{ route('news.show', $item->slug) }}">
                                        {{ $item->title }}
                                    </a>
                                </h3>

                                <p class="text-xs text-body leading-relaxed line-clamp-3">
                                    {{ $item->excerpt }}
                                </p>
                            </div>
                        </div>

                        <div class="p-5 pt-0">
                            <a href="{{ route('news.show', $item->slug) }}" class="text-xs font-semibold text-[#7D99B0] group-hover:text-[#9064C2] transition-colors inline-flex items-center gap-1">
                                <span>Baca Selengkapnya</span>
                                <x-icon name="arrow-right" class="w-3.5 h-3.5" />
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

    </div>
</section>

{{-- =========================================================================
     J. ADMISSION CTA (AJAKAN PENERIMAAN MAHASISWA)
     ========================================================================= --}}
<section id="pendaftaran" class="py-16 lg:py-20 bg-gradient-to-br from-steel-50 via-white to-royal-50 border-b border-border-subtle">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-royal-700 bg-royal-100/70 border border-royal-200">
            <span>PENERIMAAN MAHASISWA BARU</span>
        </div>

        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-heading tracking-tight text-balance">
            Mulai Langkah Anda di Dunia Kedokteran
        </h2>

        <p class="text-base sm:text-lg text-body max-w-2xl mx-auto leading-relaxed text-balance">
            Dapatkan informasi resmi mengenai program pendidikan, persyaratan administrasi, jadwal tes, dan proses penerimaan mahasiswa baru di Fakultas Kedokteran Universitas Bumigora.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
            <x-button 
                href="{{ $settings['pmb_url'] ?? 'https://pmb.universitasbumigora.ac.id' }}" 
                target="_blank" 
                rel="noopener noreferrer"
                variant="primary" 
                size="lg"
                class="shadow-sm w-full sm:w-auto"
            >
                <x-icon name="graduation-cap" class="w-5 h-5" />
                <span>Informasi Penerimaan Mahasiswa</span>
            </x-button>

            <x-button href="#kontak" variant="outline" size="lg" class="w-full sm:w-auto">
                <x-icon name="mail" class="w-4 h-4" />
                <span>Konsultasi Pertanyaan</span>
            </x-button>
        </div>

        <p class="text-xs text-body pt-2">
            Pendaftaran terintegrasi secara resmi melalui Portal PMB Universitas Bumigora.
        </p>
    </div>
</section>

{{-- =========================================================================
     K. INTERACTIVE CONTACT FORM SECTION (HUBUNGI FAKULTAS)
     ========================================================================= --}}
<section id="kontak" class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-section-heading 
            eyebrow="LAYANAN INFORMASI & KONTAK"
            title="Hubungi Sekretariat Fakultas Kedokteran"
            subtitle="Punya pertanyaan terkait perkuliahan, admisi, atau kerjasama? Kirimkan pesan Anda langsung kepada kami."
        />

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 max-w-5xl mx-auto">
            
            <!-- Left Contact Info Cards (5 cols) -->
            <div class="lg:col-span-5 space-y-4">
                <div class="p-6 rounded-2xl bg-surface border border-border-subtle">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-heading mb-4">Informasi Kontak Resmi</h4>
                    <div class="space-y-4 text-xs text-body">
                        <div class="flex items-start gap-3">
                            <x-icon name="map-pin" class="w-4 h-4 text-steel-500 shrink-0 mt-0.5" />
                            <div>
                                <span class="font-semibold text-heading block">Alamat Kampus:</span>
                                <span>{{ $settings['campus_address'] ?? 'Jl. Ismail Marzuki No. 22, Cilinaya, Cakranegara, Mataram 83239' }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <x-icon name="phone" class="w-4 h-4 text-steel-500 shrink-0 mt-0.5" />
                            <div>
                                <span class="font-semibold text-heading block">Telepon Kantor:</span>
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $settings['campus_phone'] ?? '0370633837') }}" class="hover:text-heading">
                                    {{ $settings['campus_phone'] ?? '(0370) 633837' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <x-icon name="mail" class="w-4 h-4 text-steel-500 shrink-0 mt-0.5" />
                            <div>
                                <span class="font-semibold text-heading block">Email Fakultas:</span>
                                <a href="mailto:{{ $settings['faculty_email'] ?? 'info@fk.bumigora.ac.id' }}" class="hover:text-heading">
                                    {{ $settings['faculty_email'] ?? 'info@fk.bumigora.ac.id' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 pt-2 border-t border-border-subtle">
                            <x-icon name="clock" class="w-4 h-4 text-steel-500 shrink-0 mt-0.5" />
                            <div>
                                <span class="font-semibold text-heading block">Jam Operasional Layanan:</span>
                                <span>Senin – Jumat: 08.00 – 16.00 WITA</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!empty($settings['campus_whatsapp']))
                    <div class="p-5 rounded-2xl bg-emerald-50/70 border border-emerald-200 text-xs">
                        <span class="font-bold text-emerald-800 block mb-1">Layanan Informasi WhatsApp PMB</span>
                        <p class="text-emerald-700 leading-relaxed mb-3">
                            Hubungi narahubung admisi untuk respon cepat seputar jadwal tes dan formulir.
                        </p>
                        <a 
                            href="https://wa.me/{{ $settings['campus_whatsapp'] }}" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="inline-flex items-center gap-2 text-emerald-800 font-bold hover:underline"
                        >
                            <span>Chat WhatsApp (+{{ $settings['campus_whatsapp'] }})</span>
                            <x-icon name="external-link" class="w-3.5 h-3.5" />
                        </a>
                    </div>
                @endif
            </div>

            <!-- Right Contact Form (7 cols) -->
            <div class="lg:col-span-7">
                <div class="p-6 sm:p-8 rounded-2xl bg-white border border-border-subtle shadow-xs">
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-start gap-3">
                            <x-icon name="check" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                            <div>
                                <span class="font-bold block">Pesan Terkirim</span>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                            <span class="font-bold block">Periksa kembali data formulir Anda:</span>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-xs font-semibold text-heading uppercase tracking-wider mb-1.5">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                placeholder="Contoh: Ahmad Fauzi"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-border-subtle text-sm text-heading placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#7D99B0]/50 focus:border-[#7D99B0] transition-all"
                            >
                        </div>

                        <!-- Email & Phone Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-xs font-semibold text-heading uppercase tracking-wider mb-1.5">
                                    Alamat Email <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    placeholder="nama@email.com"
                                    class="w-full px-3.5 py-2.5 rounded-lg border border-border-subtle text-sm text-heading placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#7D99B0]/50 focus:border-[#7D99B0] transition-all"
                                >
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-semibold text-heading uppercase tracking-wider mb-1.5">
                                    Nomor Telepon / WA
                                </label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone') }}" 
                                    placeholder="08123456789"
                                    class="w-full px-3.5 py-2.5 rounded-lg border border-border-subtle text-sm text-heading placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#7D99B0]/50 focus:border-[#7D99B0] transition-all"
                                >
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-xs font-semibold text-heading uppercase tracking-wider mb-1.5">
                                Kategori Pertanyaan <span class="text-rose-500">*</span>
                            </label>
                            <select 
                                id="category" 
                                name="category" 
                                required
                                class="w-full px-3.5 py-2.5 rounded-lg border border-border-subtle text-sm text-heading bg-white focus:outline-none focus:ring-2 focus:ring-[#7D99B0]/50 focus:border-[#7D99B0] transition-all"
                            >
                                <option value="Informasi Pendaftaran" {{ old('category') === 'Informasi Pendaftaran' ? 'selected' : '' }}>Informasi Penerimaan Mahasiswa Baru</option>
                                <option value="Akademik & Kurikulum" {{ old('category') === 'Akademik & Kurikulum' ? 'selected' : '' }}>Akademik & Kurikulum</option>
                                <option value="Kerjasama & Wahana Klinis" {{ old('category') === 'Kerjasama & Wahana Klinis' ? 'selected' : '' }}>Kerjasama & Wahana Klinis</option>
                                <option value="Lainnya" {{ old('category') === 'Lainnya' ? 'selected' : '' }}>Pertanyaan Umum Lainnya</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-xs font-semibold text-heading uppercase tracking-wider mb-1.5">
                                Pesan Pertanyaan <span class="text-rose-500">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="4" 
                                required 
                                placeholder="Tuliskan pertanyaan atau kebutuhan informasi Anda secara jelas..."
                                class="w-full px-3.5 py-2.5 rounded-lg border border-border-subtle text-sm text-heading placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#7D99B0]/50 focus:border-[#7D99B0] transition-all resize-y"
                            >{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <x-button type="submit" variant="secondary" size="md" class="w-full sm:w-auto shadow-xs">
                                <span>Kirim Pesan Sekarang</span>
                                <x-icon name="arrow-right" class="w-4 h-4" />
                            </x-button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
</section>

@endsection
