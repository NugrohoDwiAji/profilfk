@extends('layouts.app')

@section('title', __('Profil Fakultas Kedokteran | Universitas Bumigora'))
@section('meta_description', __('Profil lengkap, Visi, Misi, Sejarah, Profil Lulusan, dan Jajaran Pimpinan Fakultas Kedokteran Universitas Bumigora (UBG) di Mataram, Nusa Tenggara Barat.'))

@section('content')
<!-- Page Header & Breadcrumbs -->
<div class="bg-surface border-b border-border-subtle py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-body mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-heading transition-colors">{{ __('Beranda') }}</a>
            <span>/</span>
            <span class="text-heading font-semibold">{{ __('Profil Fakultas') }}</span>
        </nav>
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/20 border border-[#2466c1]/30 text-heading mb-3">
                <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></span>
                <span>{{ __('TENTANG KAMI') }}</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-heading tracking-tight leading-tight">
                {{ __('Profil Fakultas Kedokteran') }}
            </h1>
            <p class="text-base sm:text-lg text-body mt-3 leading-relaxed">
                {{ __('Mencetak dokter masa depan yang memiliki ketangguhan integritas, penguasaan keterampilan klinis mutakhir, dan komitmen mendalam terhadap perbaikan derajat kesehatan masyarakat.') }}
            </p>
        </div>
    </div>
</div>

<!-- Sambutan Dekan -->
<section class="py-16 lg:py-20 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Dekan Photo Card (4 cols) -->
            <div class="lg:col-span-4">
                <div class="relative max-w-sm mx-auto">
                    <div class="rounded-2xl overflow-hidden border border-border-subtle shadow-md bg-white p-3">
                        <div class="aspect-4/5 rounded-xl overflow-hidden bg-steel-100">
                            <img 
                                src="{{ asset('images/pimpinan/dekan.jpeg') }}" 
                                alt="dr. Karina Anindita, Sp.PD, M.Biomed., FINASIM, AIFO-K" 
                                class="w-full h-full object-cover object-top"
                                loading="lazy"
                            >
                        </div>
                        <div class="pt-4 pb-2 text-center">
                            <h3 class="text-base font-bold text-heading">dr. Karina Anindita, Sp.PD, M.Biomed., FINASIM, AIFO-K</h3>
                            <p class="text-xs font-semibold bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent mt-0.5">
                                {{ __('Dekan Fakultas Kedokteran UBG') }}
                            </p>
                            <p class="text-[11px] text-body mt-1">
                                {{ __('Pakar Pendidikan Kedokteran & Kesehatan Masyarakat') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sambutan Content (8 cols) -->
            <div class="lg:col-span-8 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">
                        {{ __('SAMBUTAN DEKAN') }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-heading tracking-tight mt-1 leading-snug">
                        {{ __('Menjawab Panggilan Kemanusiaan Melalui Pendidikan Kedokteran Unggul') }}
                    </h2>
                </div>

                <div class="space-y-4 text-body text-sm sm:text-base leading-relaxed">
                    <p>
                        <span class="text-heading font-medium">{{ __("Assalamu'alaikum Warahmatullahi Wabarakatuh, Salam Sejahtera, Om Swastiastu, Namo Buddhaya.") }}</span>
                    </p>
                    <p>
                        {{ __('Selamat datang di Fakultas Kedokteran Universitas Bumigora. Pendirian Fakultas Kedokteran ini lahir dari kesadaran mendalam akan perlunya pemerataan akses pelayanan kesehatan yang bermutu tinggi dan penguatan rasio dokter berkeahlian di Nusa Tenggara Barat serta kawasan Indonesia Timur.') }}
                    </p>
                    <p>
                        {{ __('Kami memandang bahwa profesi dokter adalah amanah mulia yang menggabungkan ketajaman analisis sains dengan kelembutan sanubari humanis. Karena itu, kurikulum di FK UBG dibangun di atas pilar Problem-Based Learning, pelatihan simulasi keterampilan klinis yang intensif, penguasaan kedokteran keluarga dan pencegahan primer, serta penanaman etika kedokteran yang kokoh sejak hari pertama perkuliahan.') }}
                    </p>
                    <p>
                        {{ __('Bersama rumah sakit pendidikan mitra utama seperti RSUD Praya dan wahana puskesmas di NTB, kami bertekad membimbing putra-putri terbaik bangsa untuk tumbuh menjadi dokter yang tidak hanya mahir secara teknis medis, namun juga berjiwa empati dan siap mengabdi di manapun masyarakat membutuhkan.') }}
                    </p>
                </div>

                <div class="pt-2 flex items-center gap-4">
                    <div class="h-10 w-1 bg-gradient-to-b from-[#08244b] via-[#2466c1] to-[#08244b] rounded-full"></div>
                    <div>
                        <div class="text-sm font-bold text-heading">dr. Karina Anindita, Sp.PD, M.Biomed., FINASIM, AIFO-K</div>
                        <div class="text-xs text-body">{{ __('Dekan Fakultas Kedokteran Universitas Bumigora') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi, Misi, dan Tujuan (Atomic Design Organism) -->
<section class="py-16 lg:py-24 bg-surface border-b border-border-subtle" x-data="{ activeScope: 'fakultas' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-heading 
            :eyebrow="__('KOMPAS STRATEGIS')"
            :title="__('Visi, Misi, dan Sasaran Institusi')"
            :subtitle="__('Prinsip dasar dan arah kebijakan yang menjadi pedoman penyelenggaraan Tridharma Perguruan Tinggi di Fakultas Kedokteran UBG.')"
            class="mb-6 lg:mb-8"
        />

        <!-- Molecule: Scope Toggle Switch (Fakultas vs Program Studi) -->
        <x-molecules.scope-toggle active-var="activeScope" />

        <!-- Organism 1: Visi & Misi Fakultas (Dari Database) -->
        <div 
            x-show="activeScope === 'fakultas'"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
        >
            <x-organisms.vision-mission-grid :record="$facultyVisionMission" theme="blue" />
        </div>

        <!-- Organism 2: Visi & Misi Program Studi Sarjana Kedokteran (Dari Database) -->
        <div 
            x-show="activeScope === 'prodi'"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            style="display: none;"
        >
            <x-organisms.vision-mission-grid :record="$prodiSarjanaVisionMission" theme="blue" />
        </div>
    </div>
</section>

<!-- Profil Lulusan (Graduate Profile) -->
<section class="py-16 lg:py-24 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-heading 
            :eyebrow="__('STANDAR KOMPETENSI DOKTER')"
            :title="__('Profil Lulusan')"
            :subtitle="__('Mengacu pada Standar Kompetensi Dokter Indonesia (SKDI) dan konsep Five-Star Doctor WHO, lulusan Fakultas Kedokteran Universitas Bumigora disiapkan untuk menguasai lima peran profesional unggulan.')"
        />

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <div class="p-6 rounded-2xl bg-surface border border-border-subtle hover:border-[#2466C1]/40 transition-colors space-y-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="stethoscope" class="w-6 h-6 text-[#2466C1]" />
                </div>
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#2466C1] block mb-1">{{ __('Peran I') }}</span>
                    <h4 class="text-base font-bold text-heading">Care Provider</h4>
                    <p class="text-[11px] text-steel-500 font-medium">{{ __('Pemberi Pelayanan Kesehatan (Health Care Provider)') }}</p>
                </div>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Mampu memberikan pelayanan kedokteran paripurna, holistik, berbasis bukti ilmiah (evidence-based medicine), serta berorientasi pada keselamatan pasien dan nilai etika luhur.') }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-surface border border-border-subtle hover:border-[#2466C1]/40 transition-colors space-y-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="shield-check" class="w-6 h-6 text-[#2466C1]" />
                </div>
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#2466C1] block mb-1">{{ __('Peran II') }}</span>
                    <h4 class="text-base font-bold text-heading">Decision Maker</h4>
                    <p class="text-[11px] text-steel-500 font-medium">{{ __('Pengambil Keputusan') }}</p>
                </div>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Mampu menetapkan pertimbangan klinis, penegakan diagnosis, dan terapi yang rasional, kritis, etis, serta efisien demi keselamatan pasien dan masyarakat.') }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-surface border border-border-subtle hover:border-[#2466C1]/40 transition-colors space-y-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="users" class="w-6 h-6 text-[#2466C1]" />
                </div>
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#2466C1] block mb-1">{{ __('Peran III') }}</span>
                    <h4 class="text-base font-bold text-heading">Communicator</h4>
                    <p class="text-[11px] text-steel-500 font-medium">{{ __('Komunikator Efektif') }}</p>
                </div>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Mampu membangun komunikasi terapeutik yang empatik dan persuasif dengan pasien serta keluarga, dan berkolaborasi harmonis dalam tim kesehatan interprofesional.') }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-surface border border-border-subtle hover:border-[#2466C1]/40 transition-colors space-y-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="award" class="w-6 h-6 text-[#2466C1]" />
                </div>
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#2466C1] block mb-1">{{ __('Peran IV') }}</span>
                    <h4 class="text-base font-bold text-heading">Community Leader</h4>
                    <p class="text-[11px] text-steel-500 font-medium">{{ __('Pemimpin Komunitas') }}</p>
                </div>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Mampu menjadi teladan kesehatan masyarakat dan memimpin advokasi kesehatan dalam upaya promotif serta preventif, khususnya kesehatan wilayah kepulauan dan pariwisata.') }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-surface border border-border-subtle hover:border-[#2466C1]/40 transition-colors space-y-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="building" class="w-6 h-6 text-[#2466C1]" />
                </div>
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#2466C1] block mb-1">{{ __('Peran V') }}</span>
                    <h4 class="text-base font-bold text-heading">Manager</h4>
                    <p class="text-[11px] text-steel-500 font-medium">{{ __('Pengelola Layanan') }}</p>
                </div>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Mampu mengelola fasilitas pelayanan kesehatan, sumber daya klinis, dan tim kerja kesehatan secara adaptif, profesional, serta berorientasi pada peningkatan mutu berkelanjutan.') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Struktur Organisasi Fakultas (Bagan SOTK) -->
<section id="struktur-organisasi" class="py-16 lg:py-24 bg-surface border-b border-border-subtle" x-data="{ lightboxOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-heading 
            :eyebrow="__('STRUKTUR ORGANISASI')"
            :title="$organizationStructure->title ?? __('Bagan Struktur Organisasi Fakultas Kedokteran')"
            :subtitle="$organizationStructure->description ?? __('Bagan tata kelola dan hierarki kepemimpinan Fakultas Kedokteran Universitas Bumigora.')"
        />

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div class="flex flex-wrap items-center gap-2">
                @if(!empty($organizationStructure->academic_period))
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white border border-border-subtle text-heading shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>{{ $organizationStructure->academic_period }}</span>
                    </span>
                @endif
                <span class="text-xs text-body hidden sm:inline">• {{ __('Klik bagan untuk memperbesar tampilan') }}</span>
            </div>

            <div class="flex items-center gap-2">
                <button 
                    type="button" 
                    @click="lightboxOpen = true" 
                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-white border border-border-subtle hover:border-[#2466C1]/40 text-heading hover:text-[#2466C1] transition-all shadow-2xs cursor-pointer"
                >
                    <x-icon name="maximize" class="w-3.5 h-3.5 text-[#2466C1]" />
                    <span>{{ __('Buka Ukuran Penuh') }}</span>
                </button>

                <a 
                    href="{{ $organizationStructure->image_src }}" 
                    target="_blank" 
                    download 
                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-gradient-to-r from-[#08244b] to-[#2466c1] text-white hover:opacity-95 transition-all shadow-2xs"
                >
                    <x-icon name="download" class="w-3.5 h-3.5" />
                    <span>{{ __('Unduh Bagan') }}</span>
                </a>
            </div>
        </div>

        <!-- Main Chart Container Card -->
        <div class="rounded-2xl border border-border-subtle bg-white p-3 sm:p-6 lg:p-8 shadow-xs relative group">
            <div 
                @click="lightboxOpen = true" 
                class="cursor-zoom-in relative rounded-xl overflow-hidden border border-border-subtle/80 bg-slate-50/60 flex items-center justify-center min-h-[300px] max-h-[720px] p-2 sm:p-4"
            >
                <img 
                    src="{{ $organizationStructure->image_src }}" 
                    alt="{{ $organizationStructure->title ?? __('Bagan Struktur Organisasi FK UBG') }}" 
                    class="w-full h-auto max-h-[680px] object-contain transition-transform duration-300 group-hover:scale-[1.01]"
                    loading="lazy"
                >

                <!-- Hover hint overlay -->
                <div class="absolute inset-0 bg-slate-900/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-4 pointer-events-none">
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold bg-white/95 text-heading shadow-md backdrop-blur-xs">
                        <x-icon name="search" class="w-3.5 h-3.5 text-[#2466C1]" />
                        <span>{{ __('Klik untuk memperbesar tampilan bagan') }}</span>
                    </span>
                </div>
            </div>

            <!-- Caption footer -->
            <div class="mt-4 pt-4 border-t border-border-subtle flex flex-col sm:flex-row sm:items-center sm:justify-between text-xs text-body gap-2">
                <div class="flex items-center gap-2">
                    <x-icon name="shield-check" class="w-4 h-4 text-emerald-600 shrink-0" />
                    <span class="font-medium text-heading">{{ $organizationStructure->title ?? __('Bagan Struktur Organisasi Tata Kelola (SOTK)') }}</span>
                </div>
                <span class="text-steel-400 text-[11px]">{{ __('Disahkan oleh Dekanat & Senat Fakultas Kedokteran Universitas Bumigora') }}</span>
            </div>
        </div>

        <!-- Lightbox Modal (Alpine.js) -->
        <div 
            x-show="lightboxOpen" 
            x-transition:enter="transition ease-out duration-200" 
            x-transition:enter-start="opacity-0" 
            x-transition:enter-end="opacity-100" 
            x-transition:leave="transition ease-in duration-150" 
            x-transition:leave-start="opacity-100" 
            x-transition:leave-end="opacity-0" 
            @keydown.escape.window="lightboxOpen = false" 
            class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6 bg-slate-950/80 backdrop-blur-sm" 
            style="display: none;"
        >
            <div 
                @click.outside="lightboxOpen = false" 
                class="bg-white rounded-2xl border border-border-subtle shadow-2xl max-w-6xl w-full max-h-[92vh] flex flex-col overflow-hidden"
            >
                <!-- Modal Header -->
                <div class="px-5 py-3.5 border-b border-border-subtle flex items-center justify-between bg-surface">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#2466C1]"></span>
                        <div>
                            <h3 class="text-sm font-bold text-heading leading-tight">{{ $organizationStructure->title ?? __('Bagan Struktur Organisasi') }}</h3>
                            <p class="text-[11px] text-body">{{ $organizationStructure->academic_period ?? 'Fakultas Kedokteran UBG' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a 
                            href="{{ $organizationStructure->image_src }}" 
                            target="_blank" 
                            download 
                            class="p-2 text-body hover:text-heading hover:bg-slate-100 rounded-lg transition-colors" 
                            title="{{ __('Unduh Bagan') }}"
                        >
                            <x-icon name="download" class="w-4 h-4" />
                        </a>
                        <button 
                            type="button" 
                            @click="lightboxOpen = false" 
                            class="p-2 text-body hover:text-heading hover:bg-slate-100 rounded-lg transition-colors cursor-pointer" 
                            title="{{ __('Tutup (Esc)') }}"
                        >
                            <x-icon name="x" class="w-5 h-5" />
                        </button>
                    </div>
                </div>

                <!-- Modal Image Body (Scrollable & Zoom-friendly) -->
                <div class="p-4 sm:p-6 overflow-auto flex-1 flex items-center justify-center bg-slate-50">
                    <img 
                        src="{{ $organizationStructure->image_src }}" 
                        alt="{{ $organizationStructure->title ?? __('Bagan Struktur Organisasi') }}" 
                        class="max-w-none w-auto max-h-[75vh] object-contain rounded-lg shadow-sm"
                    >
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pimpinan Fakultas (Leadership) -->
@if(!empty($leadership) && $leadership->isNotEmpty())
<section class="py-16 lg:py-24 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-heading 
            :eyebrow="__('STRUKTUR MANAJEMEN')"
            :title="__('Pimpinan Fakultas Kedokteran')"
            :subtitle="__('Jajaran dekanat yang memimpin arah pengembangan akademik, penjaminan mutu, sarana prasarana, dan kerjasama institusi.')"
        />

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($leadership as $leader)
                <div class="rounded-2xl border border-border-subtle bg-white p-6 shadow-2xs hover:border-[#2466C1]/40 transition-all flex flex-col justify-between">
                    <div>
                        <div class="aspect-square rounded-xl overflow-hidden bg-white border border-border-subtle mb-4">
                            @if($leader->photo_url)
                                <img 
                                    src="{{ $leader->photo_src }}" 
                                    alt="{{ $leader->name }}" 
                                    class="w-full h-full object-cover object-top"
                                    loading="lazy"
                                    onerror="this.onerror=null; this.src='{{ asset('images/faculty/dr1.png') }}';"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center text-steel-400">
                                    <x-icon name="users" class="w-10 h-10" />
                                </div>
                            @endif
                        </div>
                        <span class="inline-block text-[11px] font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent mb-1">
                            {{ $leader->primary_category_label }}
                        </span>
                        <h4 class="text-base font-bold text-heading leading-snug">
                            {{ $leader->name }}
                        </h4>
                        <p class="text-xs text-body mt-1">
                            {{ $leader->specialization }}
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-border-subtle flex items-center justify-between text-xs">
                        <span class="text-steel-600 truncate text-[11px]">
                            {{ $leader->department }}
                        </span>
                        @if($leader->email)
                            <a href="mailto:{{ $leader->email }}" class="text-[#2466c1] hover:text-[#08244b] transition-colors" title="{{ $leader->email }}">
                                <x-icon name="mail" class="w-4 h-4" />
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Mitra Rumah Sakit & Wahana Pendidikan -->
<section class="py-16 lg:py-24 bg-surface border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-6 space-y-5">
                <span class="text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">
                    {{ __('WAHANA KLINIS RESMI') }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-heading tracking-tight leading-snug">
                    {{ __('Kerjasama Rumah Sakit Pendidikan Utama: RSUD Praya') }}
                </h2>
                <p class="text-body text-sm sm:text-base leading-relaxed">
                    {{ __('Sebagai fondasi utama pembelajaran tahap kepaniteraan klinis, Fakultas Kedokteran UBG bermitra strategis dengan Rumah Sakit Umum Daerah (RSUD) Praya, Kabupaten Lombok Tengah. Wahana ini menyediakan ragam kasus klinis yang kaya, fasilitas rawat inap modern, unit gawat darurat, kamar bedah, dan bimbingan langsung dari konsulen dokter spesialis senior.') }}
                </p>
                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="p-3.5 rounded-xl bg-white border border-border-subtle">
                        <span class="text-xs text-body block">{{ __('Status Rumah Sakit') }}</span>
                        <span class="text-sm font-bold text-heading mt-0.5 block">{{ __('RS Pendidikan Utama') }}</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white border border-border-subtle">
                        <span class="text-xs text-body block">{{ __('Wahana Komunitas') }}</span>
                        <span class="text-sm font-bold text-heading mt-0.5 block">{{ __('Jejaring Puskesmas NTB') }}</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6">
                <div class="rounded-2xl overflow-hidden border border-border-subtle shadow-sm bg-white">
                    <img 
                        src="{{ asset('images/facilities/hospital.jpg') }}" 
                        alt="{{ __('Rumah Sakit Pendidikan Utama RSUD Praya') }}" 
                        class="w-full h-72 sm:h-84 object-cover" 
                        loading="lazy"
                    >
                    <div class="p-4 bg-white text-xs border-t border-border-subtle flex items-center justify-between text-body">
                        <span class="font-medium text-heading">{{ __('RSUD Praya, Lombok Tengah') }}</span>
                        <span>{{ __('Rumah Sakit Pendidikan Utama FK UBG') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Next Navigation CTA -->
<section class="py-14 bg-gradient-to-r from-[#08244b]/10 via-[#2466c1]/10 to-[#08244b]/10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h3 class="text-xl sm:text-2xl font-bold text-heading">
            {{ __('Ingin Mengenal Lebih Dekat Sarana Belajar Kami?') }}
        </h3>
        <p class="text-sm text-body max-w-xl mx-auto">
            {{ __('Jelajahi laboratorium Skills Lab, ruang anatomi, perpustakaan medis digital, dan sarana penunjang akademik lainnya.') }}
        </p>
        <div class="pt-2 flex flex-wrap justify-center gap-3">
            <x-button href="{{ route('facilities') }}" variant="primary" size="md">
                <span>{{ __('Lihat Fasilitas Pembelajaran') }}</span>
                <x-icon name="arrow-right" class="w-4 h-4" />
            </x-button>
            <x-button href="{{ route('faculty') }}" variant="outline" size="md">
                <span>{{ __('Kenali Dosen & Tenaga Ahli') }}</span>
            </x-button>
        </div>
    </div>
</section>
@endsection
