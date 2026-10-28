@extends('layouts.app')

@section('title', 'Fakultas Kedokteran Universitas Bumigora | Menyiapkan Dokter Masa Depan')
@section('meta_description', 'Official landing page Fakultas Kedokteran Universitas Bumigora. Pendidikan dokter yang mengintegrasikan ilmu biomedik, keterampilan klinis, etika profesi, dan kepedulian humanis.')

@section('content')

{{-- =========================================================================
     C. HERO SECTION
     ========================================================================= --}}
<section id="hero" class="relative overflow-hidden bg-white pt-8 pb-14 lg:pt-10 lg:pb-16 xl:pt-12 xl:pb-20 2xl:pt-16 2xl:pb-24 border-b border-border-subtle">
    <!-- Gradient Ambient Background Accent -->
    <div class="absolute inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute -top-24 right-0 w-96 h-96 rounded-full bg-gradient-to-br from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/15 blur-3xl"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 rounded-full bg-gradient-to-tr from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/15 blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left Text Content (7 cols) -->
            <div class="lg:col-span-7 space-y-5 sm:space-y-6 xl:space-y-8">
                <!-- Eyebrow -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase text-heading bg-gradient-to-r from-[#08244b]/10 via-[#2466C1]/15 to-[#08244b]/10 border border-[#2466C1]/25 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466C1] to-[#08244b]"></span>
                    <span>{{ __('FAKULTAS KEDOKTERAN · UNIVERSITAS BUMIGORA') }}</span>
                </div>

                <!-- Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-4xl xl:text-5xl font-extrabold text-heading tracking-tight leading-[1.15] text-balance">
                    {{ __('Pendidikan Kedokteran Berbasis Inovasi dengan Keunggulan Kesehatan Paru dan Gizi Anak') }}
                </h1>

                <!-- Description -->
                <p class="text-base sm:text-lg text-body leading-relaxed max-w-2xl text-balance">
                    {{ __('Fakultas Kedokteran Universitas Bumigora berkomitmen menyelenggarakan pendidikan kedokteran yang berkualitas dengan mengedepankan profesionalitas, inovasi, dan integritas. Melalui penguatan pendidikan, penelitian, dan pengabdian kepada masyarakat, FK UBG mengembangkan keunggulan di bidang pencegahan penyakit infeksi paru yang berkaitan dengan masalah gizi pada anak.') }}
                </p>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 pt-2">
                    <x-button href="#tentang" variant="secondary" size="lg" class="shadow-sm">
                        <span>{{ __('Kenali Fakultas') }}</span>
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
                        <span>{{ __('Informasi Pendaftaran') }}</span>
                    </x-button>
                </div>
            </div>

            <!-- Right Visual (5 cols) -->
            <div 
                class="lg:col-span-5 relative flex justify-start"
                x-data="{ inView: true, animKey: 0, initialized: false }"
                x-init="
                    const observer = new IntersectionObserver(([entry]) => {
                        if (!initialized) {
                            initialized = true;
                            inView = entry.isIntersecting;
                            return;
                        }
                        if (entry.isIntersecting) {
                            animKey++;
                            inView = true;
                        } else {
                            inView = false;
                        }
                    }, { threshold: 0.15 });
                    observer.observe($el);
                "
            >
                <div 
                    class="relative w-full max-w-sm sm:max-w-md lg:max-w-[340px] xl:max-w-[370px] 2xl:max-w-110"
                    :key="animKey"
                    :class="inView ? 'opacity-100' : 'opacity-0 transition-opacity duration-300'"
                >
                    <!-- Main Image Frame with Ease-in-out Entrance from Bottom -->
                    <div class="animate-hero-image relative">
                        <!-- Controlled frame with subtle border and muted accent -->
                        <div class="relative z-10 rounded-2xl overflow-hidden bg-surface border border-steel-200/80 shadow-md">
                            <img 
                                src="{{ asset('images/hero/hero-doctor.png') }}" 
                                alt="{{ __('Mahasiswa Kedokteran dan Dokter Pendidik Klinis Fakultas Kedokteran UBG') }}" 
                                class="w-full h-96 sm:h-110 lg:h-84 xl:h-92 2xl:h-105 object-cover object-top"
                                loading="eager"
                            >
                        </div>

                        <!-- Subtle backdrop gradient accent block -->
                        <div class="absolute -bottom-3 -right-3 w-full h-full rounded-2xl bg-gradient-to-br from-[#08244b] via-[#2466c1] to-[#08244b] opacity-35 z-0 hidden sm:block"></div>
                    </div>

                    <!-- 4 Floating Academic Pillars with Ease-in-out Entrance from Sides -->
                    @php
                        $academicPillars = [
                            [
                                'tag' => __('01 — KURIKULUM'),
                                'title' => __('Kurikulum Terintegrasi'),
                                'subtitle' => __('Pembelajaran Berbasis Masalah dan Keterampilan Klinis'),
                                'icon' => 'check',
                                'position' => 'sm:top-10 lg:top-6 xl:top-8 2xl:top-15 sm:-left-8 lg:-left-10 xl:-left-35 2xl:-left-36',
                                'animation' => 'animate-hero-pillar-left-1',
                            ],
                            [
                                'tag' => __('02 — KETERAMPILAN KLINIS'),
                                'title' => __('Skills Lab & OSCE'),
                                'subtitle' => __('Penguatan Kompetensi dan Keterampilan Klinis'),
                                'icon' => 'stethoscope',
                                'position' => 'sm:top-[24%] sm:-translate-y-1/2 sm:-right-8 lg:-right-10 xl:-right-30 2xl:-right-36',
                                'animation' => 'animate-hero-pillar-right-1',
                            ],
                            [
                                'tag' => __('03 — JEJARING PENDIDIKAN'),
                                'title' => __('Rumah Sakit Pendidikan'),
                                'subtitle' => __('Pembelajaran Klinis melalui Rumah Sakit Jejaring'),
                                'icon' => 'building',
                                'position' => 'sm:bottom-8 lg:bottom-6 xl:bottom-8 2xl:bottom-15 sm:-right-4 lg:-right-6 xl:-right-25 2xl:-right-24',
                                'animation' => 'animate-hero-pillar-right-2',
                            ],
                            [
                                'tag' => __('04 — KEUNGGULAN PROGRAM STUDI'),
                                'title' => __('Kesehatan Paru dan Gizi Anak'),
                                'subtitle' => __('Fokus pada Pencegahan Penyakit Infeksi Paru Terkait Masalah Gizi Anak'),
                                'icon' => 'heart-pulse',
                                'position' => 'sm:bottom-12 lg:bottom-10 xl:bottom-12 2xl:bottom-20 sm:-left-4 lg:-left-6 xl:-left-25 2xl:-left-24',
                                'animation' => 'animate-hero-pillar-left-2',
                            ],
                        ];
                    @endphp

                    <div class="mt-3 sm:mt-0 flex flex-col gap-2.5 sm:block">
                        @foreach($academicPillars as $pillar)
                            <x-academic-pillar-card
                                :tag="$pillar['tag']"
                                :title="$pillar['title']"
                                :subtitle="$pillar['subtitle']"
                                :icon="$pillar['icon']"
                                :position="$pillar['position']"
                                :animation="$pillar['animation']"
                            />
                        @endforeach
                    </div>
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
                            src="{{ asset('images/hero/campus-intro.png') }}" 
                            alt="{{ __('Kampus Universitas Bumigora Mataram') }}" 
                            class="w-full h-72 sm:h-140 object-cover"
                            loading="lazy"
                        >
                        <div class="p-4 bg-white text-xs border-t border-border-subtle flex items-center justify-between text-body">
                            <span class="font-medium text-heading">{{ __('Kampus Universitas Bumigora') }}</span>
                            <span>{{ __('Mataram, Nusa Tenggara Barat') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Content & Verifiable Pillars (7 cols) -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">{{ __('TENTANG FAKULTAS') }}</span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-heading tracking-tight mt-2 leading-tight">
                        {{ __('Membangun Generasi Dokter yang Berkarakter, Cakap, dan Penuh Empati') }}
                    </h2>
                </div>

                <p class="text-body text-base leading-relaxed">
                    {{ __('Universitas Bumigora (UBG) merupakan perguruan tinggi swasta yang telah berkiprah dalam pembangunan di NTB khususnya dalam menyediakan SDM yang berkualitas. Fakultas Kedokteran Universitas Bumigora (FK UBG) didirikan dengan tujuan untuk menjawab tantangan dan kebutuhan akan tenaga dokter yang berkualitas di Indonesia, khususnya di wilayah Nusa Tenggara Barat (NTB). Relevansi seleksi jurusan dapat diikuti oleh lulusan SMA atau yang sederajat.') }}
                </p>

                <!-- Verifiable Values & Pillars -->
                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-white border border-border-subtle shadow-2xs hover:border-[#2466C1]/30 transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 via-[#2466C1]/15 to-[#08244b]/15 text-[#2466C1] flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="book-open" class="w-5 h-5 text-[#2466C1]" />
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#2466C1] block mb-0.5">{{ __('01 — KURIKULUM') }}</span>
                            <h4 class="text-sm font-bold text-heading">{{ __('Kurikulum Terintegrasi') }}</h4>
                            <p class="text-xs text-body mt-1 leading-relaxed">
                                {{ __('Pembelajaran Berbasis Masalah dan Keterampilan Klinis') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-xl bg-white border border-border-subtle shadow-2xs hover:border-[#2466C1]/30 transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 via-[#2466C1]/15 to-[#08244b]/15 text-[#2466C1] flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="stethoscope" class="w-5 h-5 text-[#2466C1]" />
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#2466C1] block mb-0.5">{{ __('02 — KETERAMPILAN KLINIS') }}</span>
                            <h4 class="text-sm font-bold text-heading">{{ __('Skills Lab & OSCE') }}</h4>
                            <p class="text-xs text-body mt-1 leading-relaxed">
                                {{ __('Penguatan Kompetensi dan Keterampilan Klinis') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-xl bg-white border border-border-subtle shadow-2xs hover:border-[#2466C1]/30 transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 via-[#2466C1]/15 to-[#08244b]/15 text-[#2466C1] flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="hospital" class="w-5 h-5 text-[#2466C1]" />
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#2466C1] block mb-0.5">{{ __('03 — JEJARING PENDIDIKAN') }}</span>
                            <h4 class="text-sm font-bold text-heading">{{ __('Rumah Sakit Pendidikan') }}</h4>
                            <p class="text-xs text-body mt-1 leading-relaxed">
                                {{ __('Pembelajaran Klinis melalui Rumah Sakit Jejaring') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-xl bg-white border border-border-subtle shadow-2xs hover:border-[#2466C1]/30 transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 via-[#2466C1]/15 to-[#08244b]/15 text-[#2466C1] flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="heart-pulse" class="w-5 h-5 text-[#2466C1]" />
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#2466C1] block mb-0.5">{{ __('04 — KEUNGGULAN PROGRAM STUDI') }}</span>
                            <h4 class="text-sm font-bold text-heading">{{ __('Kesehatan Paru dan Gizi Anak') }}</h4>
                            <p class="text-xs text-body mt-1 leading-relaxed">
                                {{ __('Fokus pada Pencegahan Penyakit Infeksi Paru Terkait Masalah Gizi Anak') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <x-button href="{{ route('profile') }}" variant="outline" size="md">
                        <span>{{ __('Selengkapnya tentang Profil Fakultas') }}</span>
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
            :eyebrow="__('PROGRAM AKADEMIK')"
            :title="__('Jenjang Pendidikan Kedokteran')"
            :subtitle="__('Pendidikan berkesinambungan yang dirancang untuk mengantarkan mahasiswa dari fondasi akademik biomedik hingga gelar dokter yang siap mengabdi.')"
        />

        @if($programs->isEmpty())
            <x-empty-state 
                :title="__('Program Pendidikan Sedang Diperbarui')"
                :message="__('Data program studi resmi Fakultas Kedokteran Universitas Bumigora sedang dalam proses pemutakhiran sistem.')"
                icon="graduation-cap"
            />
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                @foreach($programs as $program)
                    <div class="rounded-2xl border border-border-subtle bg-white hover:border-[#2466C1]/40 transition-all duration-200 overflow-hidden shadow-2xs hover:shadow-sm flex flex-col justify-between group">
                        <div>
                            <!-- Top Gradient Accent Line -->
                            <div class="h-1 bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></div>

                            <!-- Cover Image -->
                            <div class="h-48 sm:h-56 relative overflow-hidden bg-steel-100">
                                @if($program->image_url)
                                    <img 
                                        src="{{ $program->image_src ?? asset($program->image_url) }}" 
                                        alt="{{ $program->name }}" 
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-102"
                                        loading="lazy"
                                    >
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold tracking-wide uppercase bg-white/95 text-heading shadow-xs">
                                        {{ __('Jenjang') }} {{ $program->degree }}
                                    </span>
                                </div>

                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <span class="text-xs uppercase tracking-wider text-slate-200 block">{{ __('Gelar Kelulusan:') }} {{ $program->degree_title }}</span>
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
                                        <span class="text-body">{{ __('Masa Studi Normal:') }}</span>
                                        <span>{{ $program->duration_semesters }} {{ __('Semester') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-heading font-medium">
                                        <span class="text-body">{{ __('Status Akreditasi:') }}</span>
                                        <span class="bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent font-bold">{{ $program->accreditation ?? 'LAM-PTKes' }}</span>
                                    </div>
                                </div>

                                @if(!empty($program->career_prospects) && is_array($program->career_prospects))
                                    <div>
                                        <span class="text-xs font-semibold uppercase tracking-wider text-heading block mb-2">{{ __('Fokus & Kompetensi Utama:') }}</span>
                                        <ul class="space-y-1.5 text-xs text-body">
                                            @foreach(array_slice($program->career_prospects, 0, 3) as $prospect)
                                                <li class="flex items-start gap-2">
                                                    <span class="text-[#2466C1] font-bold mt-0.5">•</span>
                                                    <span>{{ __($prospect) }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Action -->
                        <div class="p-6 sm:p-7 pt-0 border-t border-border-subtle/60 flex items-center justify-between gap-4">
                            <a href="{{ route('program.show', $program->slug) }}" class="text-sm font-semibold text-heading hover:text-[#2466C1] transition-colors inline-flex items-center gap-1.5">
                                <span>{{ __('Detail Kurikulum & Syarat') }}</span>
                                <x-icon name="arrow-right" class="w-4 h-4 text-[#2466C1]" />
                            </a>
                            <x-button 
                                href="{{ $settings['pmb_url'] ?? 'https://pmb.universitasbumigora.ac.id' }}" 
                                target="_blank"
                                rel="noopener noreferrer"
                                variant="outline" 
                                size="sm"
                            >
                                <span>{{ __('Pendaftaran') }}</span>
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
            :eyebrow="__('SARANA & LINGKUNGAN BELAJAR')"
            :title="__('Fasilitas Akademik Berstandar Medis')"
            :subtitle="__('Dirancang untuk mendukung pengalaman belajar kedokteran yang komprehensif, interaktif, dan berorientasi pada keselamatan pasien.')"
        />

        @if($facilities->isEmpty())
            <x-empty-state 
                :title="__('Fasilitas Sedang Diperbarui')" 
                :message="__('Informasi laboratorium dan fasilitas pembelajaran sedang disiapkan.')"
                icon="building"
            />
        @else
            <!-- Editorial Varied Grid: 1 Big Featured Card + 3 Balanced Grid Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                @php
                    $leadFacility = $facilities->first();
                    $otherFacilities = $facilities->slice(1, 2);
                @endphp

                <!-- Featured Large Card (7 cols) -->
                @if($leadFacility)
                    <div class="lg:col-span-7 rounded-2xl overflow-hidden bg-white border border-border-subtle shadow-2xs flex flex-col justify-between group">
                        <div class="h-64 sm:h-80 relative overflow-hidden bg-steel-100">
                            @if($leadFacility->image_url)
                                <img 
                                    src="{{ $leadFacility->image_src }}" 
                                    alt="{{ $leadFacility->name }}" 
                                    class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300"
                                    loading="lazy"
                                >
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 right-6 text-white">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white mb-2 uppercase tracking-wider shadow-xs">
                                    {{ __($leadFacility->category) }}
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
                                            <span>{{ __($feature) }}</span>
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
                        <div class="rounded-2xl overflow-hidden bg-white border border-border-subtle shadow-2xs p-5 sm:p-6 flex flex-col justify-between hover:border-[#2466C1]/40 transition-colors">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">
                                        {{ __($facility->category) }}
                                    </span>
                                    <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></span>
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
                                            {{ __($item) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        @endif

        @if(!$facilities->isEmpty())
            <div class="mt-10 text-center">
                <x-button href="{{ route('facilities') }}" variant="outline" size="md">
                    <span>{{ __('Lihat Seluruh Fasilitas & Laboratorium') }}</span>
                    <x-icon name="arrow-right" class="w-4 h-4 text-[#2466C1]" />
                </x-button>
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
            :eyebrow="__('TENAGA PENDIDIK & PAKAR')"
            :title="__('Dosen dan Pendidik Klinis')"
            :subtitle="__('Para dokter spesialis, akademisi biomedik, dan praktisi kesehatan berdedikasi membimbing calon dokter dengan keteladanan profesional.')"
        />

        @if($facultyMembers->isEmpty())
            <x-empty-state 
                :title="__('Daftar Dosen Sedang Diperbarui')"
                :message="__('Daftar resmi tenaga pengajar dan dokter pendidik klinis sedang dalam tahap sinkronisasi data kepegawaian.')"
                icon="users"
            />
        @else
            <!-- Filter Tabs -->
            <div class="flex flex-wrap items-center justify-center gap-2 mb-10 pb-2">
                <button 
                    @click="facultyFilter = 'all'" 
                    :class="facultyFilter === 'all' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-sm' : 'bg-surface text-body hover:bg-steel-50'"
                    class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap"
                >
                    {{ __('Semua Dosen') }}
                </button>
                @foreach(\App\Models\FacultyMember::CATEGORIES as $catKey => $catLabel)
                    <button 
                        @click="facultyFilter = '{{ $catKey }}'" 
                        :class="facultyFilter === '{{ $catKey }}' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-sm' : 'bg-surface text-body hover:bg-steel-50'"
                        class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap"
                    >
                        {{ __($catLabel) }}
                    </button>
                @endforeach
            </div>

            <!-- Faculty Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($facultyMembers as $faculty)
                    <div 
                        x-show="facultyFilter === 'all' || {{ json_encode($faculty->category) }}.includes(facultyFilter)"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-98"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="rounded-2xl border border-border-subtle bg-white p-6 shadow-2xs hover:border-[#2466C1]/40 transition-all flex flex-col justify-between group"
                    >
                        <div>
                            <!-- Header: Photo and Basic Info -->
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-20 h-20 sm:w-24 sm:h-24 aspect-square rounded-xl overflow-hidden bg-white border border-steel-200 shrink-0">
                                    @if($faculty->photo_url)
                                        <img 
                                            src="{{ $faculty->photo_src }}" 
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
                                    <span class="inline-block text-[11px] font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent mb-1">
                                        {{ $faculty->primary_category_label }}
                                    </span>
                                    <h3 class="text-base font-bold text-heading leading-snug line-clamp-2" title="{{ $faculty->name }}">
                                        {{ $faculty->name }}
                                    </h3>
                                    <p class="text-xs text-body mt-1">
                                        {{ $faculty->specialization }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="pt-3 border-t border-border-subtle flex items-center justify-between text-xs">
                            <span class="text-steel-600 truncate max-w-[200px] text-[11px]">
                                {{ $faculty->department ?? 'Fakultas Kedokteran UBG' }}
                            </span>
                            @if($faculty->email)
                                <a 
                                    href="mailto:{{ $faculty->email }}" 
                                    class="text-[#2466c1] hover:text-[#08244b] p-1.5 rounded-lg hover:bg-surface transition-colors" 
                                    title="{{ __('Hubungi melalui email') }}: {{ $faculty->email }}"
                                >
                                    <x-icon name="mail" class="w-4 h-4" />
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if(!$facultyMembers->isEmpty())
            <div class="mt-10 text-center">
                <x-button href="{{ route('faculty') }}" variant="outline" size="md">
                    <span>{{ __('Lihat Seluruh Jajaran Dosen & Tenaga Ahli') }}</span>
                    <x-icon name="arrow-right" class="w-4 h-4 text-[#2466C1]" />
                </x-button>
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
            :eyebrow="__('KABAR KAMPUS & KEGIATAN')"
            :title="__('Berita dan Pengumuman Terkini')"
            :subtitle="__('Informasi terverifikasi mengenai kegiatan akademik, kemitraan rumah sakit, dan agenda penting Fakultas Kedokteran UBG.')"
        />

        @if($news->isEmpty())
            <x-empty-state 
                :title="__('Belum Ada Berita Dipublikasikan')"
                :message="__('Warta kegiatan dan pengumuman resmi akan segera dihadirkan di halaman ini.')"
                icon="book-open"
            />
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($news as $item)
                    <article class="rounded-2xl border border-border-subtle bg-white overflow-hidden shadow-2xs hover:border-[#2466C1]/40 transition-all flex flex-col justify-between group">
                        <div>
                            <!-- Featured Image -->
                            <div class="h-44 relative overflow-hidden bg-steel-100">
                                @if($item->featured_image)
                                    <img 
                                        src="{{ $item->image_src ?? asset($item->featured_image) }}" 
                                        alt="{{ $item->title }}" 
                                        class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                @endif
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[11px] font-bold uppercase tracking-wider bg-white/95 text-heading border border-border-subtle shadow-xs">
                                        {{ $item->category }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 space-y-2.5">
                                <div class="flex items-center gap-2 text-[11px] text-steel-500">
                                    <x-icon name="calendar" class="w-3 h-3 shrink-0" />
                                    <span>{{ $item->published_at ? $item->published_at->translatedFormat('d F Y') : '-' }}</span>
                                </div>

                                <h3 class="text-sm font-bold text-heading leading-snug group-hover:text-[#2466C1] transition-colors line-clamp-2">
                                    <a href="{{ route('news.show', $item->slug) }}">
                                        {{ $item->title }}
                                    </a>
                                </h3>

                                <p class="text-xs text-body leading-relaxed line-clamp-3">
                                    {{ strip_tags($item->excerpt) }}
                                </p>
                            </div>
                        </div>

                        <div class="p-5 pt-0">
                            <a href="{{ route('news.show', $item->slug) }}" class="text-xs font-semibold bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent group-hover:opacity-80 transition-opacity inline-flex items-center gap-1">
                                <span>{{ __('Baca Selengkapnya') }}</span>
                                <x-icon name="arrow-right" class="w-3.5 h-3.5 text-[#2466C1]" />
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        @if(!$news->isEmpty())
            <div class="mt-10 text-center">
                <x-button href="{{ route('news.index') }}" variant="outline" size="md">
                    <span>{{ __('Lihat Semua Berita & Agenda Terkini') }}</span>
                    <x-icon name="arrow-right" class="w-4 h-4 text-[#2466C1]" />
                </x-button>
            </div>
        @endif

    </div>
</section>

{{-- =========================================================================
     J. ADMISSION CTA (AJAKAN PENERIMAAN MAHASISWA)
     ========================================================================= --}}
<section id="pendaftaran" class="py-16 lg:py-20 bg-gradient-to-r from-[#08244b]/10 via-[#2466c1]/10 to-[#08244b]/10 border-b border-border-subtle relative overflow-hidden">
    <!-- Ambient Gradient Orbs -->
    <div class="absolute -top-12 -right-12 w-80 h-80 rounded-full bg-[#08244b]/15 blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute -bottom-12 -left-12 w-80 h-80 rounded-full bg-[#2466C1]/15 blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6 relative z-10">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-heading bg-gradient-to-r from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/20 border border-[#2466c1]/30 shadow-2xs">
            <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></span>
            <span>{{ __('PENERIMAAN MAHASISWA BARU') }}</span>
        </div>

        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-heading tracking-tight text-balance">
            {{ __('Mulai Langkah Anda di Dunia Kedokteran') }}
        </h2>

        <p class="text-base sm:text-lg text-body max-w-2xl mx-auto leading-relaxed text-balance">
            {{ __('Dapatkan informasi resmi mengenai program pendidikan, persyaratan administrasi, jadwal tes, dan proses penerimaan mahasiswa baru di Fakultas Kedokteran Universitas Bumigora.') }}
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
                <span>{{ __('Informasi Penerimaan Mahasiswa') }}</span>
            </x-button>

            <x-button href="{{ route('contact') }}" variant="outline" size="lg" class="w-full sm:w-auto">
                <x-icon name="mail" class="w-4 h-4" />
                <span>{{ __('Konsultasi Pertanyaan') }}</span>
            </x-button>
        </div>

        <p class="text-xs text-body pt-2">
            {{ __('Pendaftaran terintegrasi secara resmi melalui Portal PMB Universitas Bumigora.') }}
        </p>
    </div>
</section>

{{-- =========================================================================
     K. INTERACTIVE CONTACT FORM SECTION (HUBUNGI FAKULTAS)
     ========================================================================= --}}
<section id="kontak" class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-section-heading 
            :eyebrow="__('LAYANAN INFORMASI & KONTAK')"
            :title="__('Hubungi Sekretariat Fakultas Kedokteran')"
            :subtitle="__('Punya pertanyaan terkait perkuliahan, admisi, atau kerjasama? Kirimkan pesan Anda langsung kepada kami.')"
        />

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 max-w-5xl mx-auto">
            
            <!-- Left Contact Info Cards (5 cols) -->
            <div class="lg:col-span-5 space-y-4">
                <div class="p-6 rounded-2xl bg-surface border border-border-subtle">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-heading mb-4">{{ __('Informasi Kontak Resmi') }}</h4>
                    <div class="space-y-4 text-xs text-body">
                        <div class="flex items-start gap-3">
                            <x-icon name="map-pin" class="w-4 h-4 text-[#2466c1] shrink-0 mt-0.5" />
                            <div>
                                <span class="font-semibold text-heading block">{{ __('Alamat Kampus:') }}</span>
                                <span>{{ $settings['campus_address'] ?? 'Jl. Ismail Marzuki No. 22, Cilinaya, Cakranegara, Mataram 83239' }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <x-icon name="phone" class="w-4 h-4 text-[#2466c1] shrink-0 mt-0.5" />
                            <div>
                                <span class="font-semibold text-heading block">{{ __('Telepon Kantor:') }}</span>
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $settings['campus_phone'] ?? '0370633837') }}" class="hover:text-heading">
                                    {{ $settings['campus_phone'] ?? '(0370) 633837' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <x-icon name="mail" class="w-4 h-4 text-[#2466c1] shrink-0 mt-0.5" />
                            <div>
                                <span class="font-semibold text-heading block">{{ __('Email Fakultas:') }}</span>
                                <a href="mailto:{{ $settings['faculty_email'] ?? 'info@fk.bumigora.ac.id' }}" class="hover:text-heading">
                                    {{ $settings['faculty_email'] ?? 'info@fk.bumigora.ac.id' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 pt-2 border-t border-border-subtle">
                            <x-icon name="clock" class="w-4 h-4 text-[#2466c1] shrink-0 mt-0.5" />
                            <div>
                                <span class="font-semibold text-heading block">{{ __('Jam Operasional Layanan:') }}</span>
                                <span>{{ __('Senin – Jumat: 08.00 – 16.00 WITA') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!empty($settings['campus_whatsapp']))
                    <div class="p-5 rounded-2xl bg-emerald-50/70 border border-emerald-200 text-xs">
                        <span class="font-bold text-emerald-800 block mb-1">{{ __('Layanan Informasi WhatsApp PMB') }}</span>
                        <p class="text-emerald-700 leading-relaxed mb-3">
                            {{ __('Hubungi narahubung admisi untuk respon cepat seputar jadwal tes dan formulir.') }}
                        </p>
                        <a 
                            href="https://wa.me/{{ $settings['campus_whatsapp'] }}" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="inline-flex items-center gap-2 text-emerald-800 font-bold hover:underline"
                        >
                            <span>{{ __('Chat WhatsApp') }} (+{{ $settings['campus_whatsapp'] }})</span>
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
                                <span class="font-bold block">{{ __('Pesan Terkirim') }}</span>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                            <span class="font-bold block">{{ __('Periksa kembali data formulir Anda:') }}</span>
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
                                {{ __('Nama Lengkap') }} <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                placeholder="{{ __('Contoh: Ahmad Fauzi') }}"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-border-subtle text-sm text-heading placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2466C1]/40 focus:border-[#2466C1] transition-all"
                            >
                        </div>

                        <!-- Email & Phone Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-xs font-semibold text-heading uppercase tracking-wider mb-1.5">
                                    {{ __('Alamat Email') }} <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    placeholder="{{ __('nama@email.com') }}"
                                    class="w-full px-3.5 py-2.5 rounded-lg border border-border-subtle text-sm text-heading placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2466C1]/40 focus:border-[#2466C1] transition-all"
                                >
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-semibold text-heading uppercase tracking-wider mb-1.5">
                                    {{ __('Nomor Telepon / WA') }}
                                </label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone') }}" 
                                    placeholder="08123456789"
                                    class="w-full px-3.5 py-2.5 rounded-lg border border-border-subtle text-sm text-heading placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2466C1]/40 focus:border-[#2466C1] transition-all"
                                >
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-xs font-semibold text-heading uppercase tracking-wider mb-1.5">
                                {{ __('Kategori Pertanyaan') }} <span class="text-rose-500">*</span>
                            </label>
                            <select 
                                id="category" 
                                name="category" 
                                required 
                                class="w-full px-3.5 py-2.5 rounded-lg border border-border-subtle text-sm text-heading bg-white focus:outline-none focus:ring-2 focus:ring-[#2466C1]/40 focus:border-[#2466C1] transition-all"
                            >
                                <option value="Informasi Pendaftaran" {{ old('category') === 'Informasi Pendaftaran' ? 'selected' : '' }}>{{ __('Informasi Penerimaan Mahasiswa Baru') }}</option>
                                <option value="Akademik & Kurikulum" {{ old('category') === 'Akademik & Kurikulum' ? 'selected' : '' }}>{{ __('Akademik & Kurikulum') }}</option>
                                <option value="Kerjasama & Wahana Klinis" {{ old('category') === 'Kerjasama & Wahana Klinis' ? 'selected' : '' }}>{{ __('Kerjasama & Wahana Klinis') }}</option>
                                <option value="Lainnya" {{ old('category') === 'Lainnya' ? 'selected' : '' }}>{{ __('Pertanyaan Umum Lainnya') }}</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-xs font-semibold text-heading uppercase tracking-wider mb-1.5">
                                {{ __('Pesan Pertanyaan') }} <span class="text-rose-500">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="4" 
                                required 
                                placeholder="{{ __('Tuliskan pertanyaan atau kebutuhan informasi Anda secara jelas...') }}"
                                class="w-full px-3.5 py-2.5 rounded-lg border border-border-subtle text-sm text-heading placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2466C1]/40 focus:border-[#2466C1] transition-all resize-y"
                            >{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <x-button type="submit" variant="primary" size="md" class="w-full sm:w-auto shadow-sm">
                                <span>{{ __('Kirim Pesan Sekarang') }}</span>
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
