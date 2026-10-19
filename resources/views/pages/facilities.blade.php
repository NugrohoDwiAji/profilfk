@extends('layouts.app')

@section('title', __('Fasilitas & Sarana Belajar | Fakultas Kedokteran UBG'))
@section('meta_description', __('Fasilitas akademik, Skills Lab berstandar OSCE, Laboratorium Anatomi & Biomedik, Rumah Sakit Pendidikan RSUD Praya, dan Perpustakaan Medis Fakultas Kedokteran Universitas Bumigora.'))

@section('content')
<!-- Page Header & Breadcrumbs -->
<div class="bg-surface border-b border-border-subtle py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-body mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-heading transition-colors">{{ __('Beranda') }}</a>
            <span>/</span>
            <span class="text-heading font-semibold">{{ __('Fasilitas') }}</span>
        </nav>
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/20 border border-[#2466c1]/30 text-heading mb-3">
                <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></span>
                <span>{{ __('SARANA MEDIS MUTAKHIR') }}</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-heading tracking-tight leading-tight">
                {!! __('Fasilitas & Lingkungan Pembelajaran') !!}
            </h1>
            <p class="text-base sm:text-lg text-body mt-3 leading-relaxed">
                {{ __('Sarana penunjang akademik berstandar medis tinggi dirancang untuk memberikan pengalaman belajar interaktif, simulasi klinis terarah, dan perlindungan keselamatan pasien.') }}
            </p>
        </div>
    </div>
</div>

<!-- Main Facilities Section -->
<section class="py-16 lg:py-24 bg-white border-b border-border-subtle" x-data="{ activeCategory: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Tabs -->
        @php
            $categories = $facilities->pluck('category')->unique()->filter()->values();
        @endphp

        @if($categories->count() > 1)
            <div class="flex items-center justify-center gap-2 mb-12 overflow-x-auto pb-2">
                <button 
                    @click="activeCategory = 'all'" 
                    :class="activeCategory === 'all' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-sm' : 'bg-surface text-body hover:bg-steel-50'"
                    class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap"
                >
                    {{ __('Semua Fasilitas') }} ({{ $facilities->count() }})
                </button>
                @foreach($categories as $cat)
                    <button 
                        @click="activeCategory = '{{ $cat }}'" 
                        :class="activeCategory === '{{ $cat }}' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-sm' : 'bg-surface text-body hover:bg-steel-50'"
                        class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap"
                    >
                        {{ __($cat) }}
                    </button>
                @endforeach
            </div>
        @endif

        @if($facilities->isEmpty())
            <x-empty-state 
                :title="__('Informasi Fasilitas Sedang Dimutakhirkan')"
                :message="__('Data sarana dan laboratorium sedang disiapkan untuk ditampilkan secara publik.')"
                icon="building"
            />
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($facilities as $facility)
                    <div 
                        x-show="activeCategory === 'all' || activeCategory === '{{ $facility->category }}'"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-98"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="rounded-2xl border border-border-subtle bg-white overflow-hidden shadow-2xs hover:border-[#2466C1]/40 transition-all flex flex-col justify-between group"
                    >
                        <div>
                            <!-- Facility Image -->
                            <div class="h-64 sm:h-72 relative overflow-hidden bg-steel-100">
                                @if($facility->image_url)
                                    <img 
                                        src="{{ $facility->image_src }}" 
                                        alt="{{ $facility->name }}" 
                                        class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-steel-400">
                                        <x-icon name="building" class="w-12 h-12" />
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-white/95 text-heading uppercase tracking-wider shadow-xs mb-1">
                                        {{ __($facility->category) }}
                                    </span>
                                    <h3 class="text-lg sm:text-xl font-bold text-white tracking-tight">
                                        {{ $facility->name }}
                                    </h3>
                                </div>
                            </div>

                            <!-- Description & Feature Checklist -->
                            <div class="p-6 space-y-4">
                                <p class="text-sm text-body leading-relaxed">
                                    {{ $facility->description }}
                                </p>

                                @if(!empty($facility->features) && is_array($facility->features))
                                    <div class="space-y-2 pt-2 border-t border-border-subtle">
                                        <span class="text-xs font-bold uppercase tracking-wider text-heading block">
                                            {{ __('Fitur & Kelengkapan Utama:') }}
                                        </span>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            @foreach($facility->features as $feature)
                                                <div class="flex items-start gap-2 text-xs text-heading">
                                                    <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                                                    <span>{{ __($feature) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 pt-0">
                            <div class="pt-3 border-t border-border-subtle flex items-center justify-between text-xs text-body">
                                <span>{{ __('Fakultas Kedokteran UBG') }}</span>
                                <span class="font-medium text-[#2466C1]">{{ __('Terstandar Akademik') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

<!-- Additional Learning Support Environment -->
<section class="py-16 lg:py-24 bg-surface border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-heading 
            :eyebrow="__('SARANA PENDUKUNG')"
            :title="__('Kenyamanan & Ekosistem Belajar')"
            :subtitle="__('Infrastruktur kampus modern didesain untuk menjamin iklim akademik yang kolaboratif, aman, dan kondusif.')"
        />

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-2xl bg-white border border-border-subtle shadow-2xs space-y-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="laptop" class="w-5 h-5 text-[#2466C1]" />
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('CBT Center Terstandar') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Laboratorium komputer berkapasitas besar dengan koneksi intranet aman untuk pelaksanaan Ujian Blok dan persiapan Try Out UKMPPD.') }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-border-subtle shadow-2xs space-y-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="users" class="w-5 h-5 text-[#2466C1]" />
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('Ruang Diskusi Tutorial PBL') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Bilik diskusi kelompok kecil yang privat dan berpendingin udara untuk pembahasan skenario modul Problem-Based Learning dengan fasilitator.') }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-border-subtle shadow-2xs space-y-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="book-open" class="w-5 h-5 text-[#2466C1]" />
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('Akses Jurnal Digital 24/7') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Langganan portal literatur kedokteran bereputasi internasional (ScienceDirect, PubMed, ClinicalKey) yang dapat diakses dari dalam maupun luar kampus.') }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-border-subtle shadow-2xs space-y-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="shield-check" class="w-5 h-5 text-[#2466C1]" />
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('Biosafety & Keamanan Lab') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Sistem pembuangan limbah medis tersertifikasi, emergency shower, dan protokol keamanan bahan kimia/biologis terstandar K3L.') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Bottom CTA -->
<section class="py-14 bg-gradient-to-r from-[#08244b]/10 via-[#2466c1]/10 to-[#08244b]/10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h3 class="text-xl sm:text-2xl font-bold text-heading">
            {{ __('Siap Memulai Pendidikan Kedokteran Anda Bersama Kami?') }}
        </h3>
        <p class="text-sm text-body max-w-xl mx-auto">
            {{ __('Pelajari kurikulum program sarjana dan profesi dokter, atau ajukan pertanyaan kepada tim admisi kami.') }}
        </p>
        <div class="pt-2 flex flex-wrap justify-center gap-3">
            <x-button 
                href="{{ $settings['pmb_url'] ?? 'https://pmb.universitasbumigora.ac.id' }}" 
                target="_blank" 
                rel="noopener noreferrer" 
                variant="primary" 
                size="md"
            >
                <x-icon name="graduation-cap" class="w-4 h-4" />
                <span>{{ __('Pendaftaran Mahasiswa Baru') }}</span>
            </x-button>
            <x-button href="{{ route('contact') }}" variant="outline" size="md">
                <span>{{ __('Hubungi Sekretariat') }}</span>
            </x-button>
        </div>
    </div>
</section>
@endsection
