@extends('layouts.app')

@section('title', __('Kurikulum & Struktur Pembelajaran | Fakultas Kedokteran UBG'))
@section('meta_description', __('Struktur kurikulum terintegrasi berbasis Problem-Based Learning (PBL), blok sistem organ, Skills Lab OSCE, dan rotasi kepaniteraan klinik Fakultas Kedokteran Universitas Bumigora.'))

@section('content')
<!-- Page Header & Breadcrumbs -->
<div class="bg-surface border-b border-border-subtle py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-body mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-heading transition-colors">{{ __('Beranda') }}</a>
            <span>/</span>
            <span class="text-body">{{ __('Akademik') }}</span>
            <span>/</span>
            <span class="text-heading font-semibold">{{ __('Kurikulum') }}</span>
        </nav>
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/20 border border-[#2466c1]/30 text-heading mb-3">
                <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></span>
                <span>{{ __('STANDAR NASIONAL PENDIDIKAN PROFESI DOKTER (SNPPDI)') }}</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-heading tracking-tight leading-tight">
                {{ __('Kurikulum & Struktur Pembelajaran') }}
            </h1>
            <p class="text-base sm:text-lg text-body mt-3 leading-relaxed">
                {{ __('Kurikulum pendidikan kedokteran terintegrasi dengan metode Problem-Based Learning (PBL), pelatihan simulasi klinis berstandar OSCE, dan kepaniteraan klinik komprehensif untuk melahirkan dokter yang kompeten, beretika, dan berjiwa humanis.') }}
            </p>
        </div>

        <!-- Metric Highlights -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 pt-6 border-t border-border-subtle">
            <div class="bg-white p-4 rounded-xl border border-border-subtle shadow-2xs">
                <span class="text-[11px] font-bold text-steel-500 uppercase tracking-wider block">{{ __('Total Beban Sarjana') }}</span>
                <span class="text-xl sm:text-2xl font-extrabold text-heading mt-1 block">146 SKS</span>
                <span class="text-[11px] text-body mt-0.5 block">{{ __('7 – 8 Semester (Tahap S.Ked)') }}</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-border-subtle shadow-2xs">
                <span class="text-[11px] font-bold text-steel-500 uppercase tracking-wider block">{{ __('Beban Profesi Dokter') }}</span>
                <span class="text-xl sm:text-2xl font-extrabold bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent mt-1 block">44 SKS</span>
                <span class="text-[11px] text-body mt-0.5 block">{{ __('4 Semester / 2 Tahun (Koas)') }}</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-border-subtle shadow-2xs">
                <span class="text-[11px] font-bold text-steel-500 uppercase tracking-wider block">{{ __('Model Pembelajaran') }}</span>
                <span class="text-xl sm:text-2xl font-extrabold text-heading mt-1 block">{{ __('PBL & Blok') }}</span>
                <span class="text-[11px] text-body mt-0.5 block">{{ __('Sistem Organ Terintegrasi') }}</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-border-subtle shadow-2xs">
                <span class="text-[11px] font-bold text-steel-500 uppercase tracking-wider block">{{ __('RS Pendidikan Utama') }}</span>
                <span class="text-xl sm:text-2xl font-extrabold bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent mt-1 block">RSUD Praya</span>
                <span class="text-[11px] text-body mt-0.5 block">{{ __('Wahana Jejaring Medis NTB') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- 4 Phases of Academic Journey Section -->
<section class="py-14 lg:py-20 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">
                {{ __('TAHAPAN PENDIDIKAN DOKTER') }}
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-heading tracking-tight mt-2">
                {{ __('Empat Fase Pembelajaran Menuju Dokter Kompeten') }}
            </h2>
            <p class="text-sm sm:text-base text-body mt-2.5">
                {{ __('Pendidikan dirancang berkesinambungan mulai dari penguatan ilmu biomedik dasar hingga aplikasi klinis langsung di rumah sakit pendidikan.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($phases as $phase)
                <div class="rounded-2xl border border-border-subtle bg-white p-6 shadow-2xs hover:border-[#2466C1]/40 hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider bg-gradient-to-r {{ $phase['color'] }} text-white shadow-2xs">
                                {{ __($phase['phase']) }}
                            </span>
                            @if(!empty($phase['sks']))
                                <span class="text-xs font-semibold text-steel-500">
                                    {{ $phase['sks'] }}
                                </span>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-base font-bold text-heading group-hover:text-[#2466C1] transition-colors leading-snug">
                                {{ __($phase['title']) }}
                            </h3>
                            <span class="text-xs font-medium text-[#2466C1] block mt-1">
                                {{ __($phase['semesters']) }}
                            </span>
                        </div>

                        <p class="text-xs text-body leading-relaxed">
                            {{ __($phase['description']) }}
                        </p>
                    </div>

                    <div class="pt-4 mt-4 border-t border-border-subtle flex items-center justify-between text-xs text-steel-500">
                        <span class="inline-flex items-center gap-1.5 font-medium">
                            <x-icon :name="$phase['icon']" class="w-4 h-4 text-[#2466C1]" />
                            <span>{{ __('Terintegrasi') }}</span>
                        </span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Detailed Curriculum Structure (Interactive Tabs) -->
<section class="py-14 lg:py-20 bg-slate-50/70 border-b border-border-subtle" x-data="{ activeTab: 'sem-1' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">
                    {{ __('STRUKTUR MATA KULIAH & BLOK') }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-heading tracking-tight mt-1">
                    {{ __('Distribusi Blok per Semester') }}
                </h2>
                <p class="text-xs sm:text-sm text-body mt-1">
                    {{ __('Pilih semester di bawah untuk meninjau daftar blok, beban SKS, dan modul keterampilan klinis.') }}
                </p>
            </div>

            <!-- Tab Navigation (Desktop / Mobile Scrollable) -->
            <div class="inline-flex items-center p-1 bg-white rounded-xl border border-border-subtle shadow-2xs overflow-x-auto max-w-full">
                @for($i = 1; $i <= 7; $i++)
                    <button 
                        @click="activeTab = 'sem-{{ $i }}'"
                        :class="activeTab === 'sem-{{ $i }}' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-xs font-bold' : 'text-body hover:text-heading hover:bg-slate-50 font-medium'"
                        class="px-3.5 py-1.5 rounded-lg text-xs transition-all whitespace-nowrap cursor-pointer"
                    >
                        {{ __('Sem') }} {{ $i }}
                    </button>
                @endfor
                <button 
                    @click="activeTab = 'profesi'"
                    :class="activeTab === 'profesi' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-xs font-bold' : 'text-body hover:text-heading hover:bg-slate-50 font-medium'"
                    class="px-3.5 py-1.5 rounded-lg text-xs transition-all whitespace-nowrap cursor-pointer"
                >
                    {{ __('Profesi (Koas)') }}
                </button>
            </div>
        </div>

        <!-- Semesters 1 - 7 Contents -->
        @foreach($semesters as $semNum => $semData)
            <div 
                x-show="activeTab === 'sem-{{ $semNum }}'"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                style="display: none;"
            >
                <div class="bg-white rounded-2xl border border-border-subtle shadow-xs overflow-hidden">
                    <!-- Semester Header Bar -->
                    <div class="p-5 sm:p-6 bg-gradient-to-r from-[#08244b]/5 via-[#2466c1]/10 to-[#08244b]/5 border-b border-border-subtle flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2.5">
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-[#2466C1] text-white uppercase tracking-wider">
                                    {{ __($semData['name']) }}
                                </span>
                                <span class="text-xs font-semibold text-steel-500">
                                    {{ __($semData['year']) }}
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-heading mt-2">
                                {{ __($semData['focus']) }}
                            </h3>
                        </div>
                        <div class="flex items-center gap-2 self-start sm:self-auto shrink-0">
                            <span class="text-xs text-body">{{ __('Beban Semester:') }}</span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-white border border-border-subtle text-heading shadow-2xs">
                                {{ $semData['total_sks'] }} SKS
                            </span>
                        </div>
                    </div>

                    <!-- Blocks Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs sm:text-sm">
                            <thead>
                                <tr class="border-b border-border-subtle bg-surface text-steel-500 font-semibold uppercase tracking-wider text-[11px]">
                                    <th class="py-3 px-4 sm:px-6">{{ __('Kode') }}</th>
                                    <th class="py-3 px-4 sm:px-6">{{ __('Mata Kuliah / Nama Blok') }}</th>
                                    <th class="py-3 px-4 sm:px-6">{{ __('Tipe Pembelajaran') }}</th>
                                    <th class="py-3 px-4 sm:px-6 text-right">{{ __('Beban SKS') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-subtle">
                                @foreach($semData['blocks'] as $block)
                                    <tr class="hover:bg-slate-50/70 transition-colors">
                                        <td class="py-3.5 px-4 sm:px-6 font-mono font-bold text-[#2466C1] whitespace-nowrap">
                                            {{ $block['code'] }}
                                        </td>
                                        <td class="py-3.5 px-4 sm:px-6 font-semibold text-heading">
                                            {{ __($block['title']) }}
                                        </td>
                                        <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">
                                            @php
                                                $badgeClass = match($block['type']) {
                                                    'Blok Inti' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                    'Skills Lab' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                    'Keunggulan' => 'bg-purple-50 text-purple-700 border-purple-200',
                                                    'Riset', 'Tugas Akhir' => 'bg-amber-50 text-amber-700 border-amber-200',
                                                    default => 'bg-slate-100 text-slate-700 border-slate-200',
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium border {{ $badgeClass }}">
                                                {{ __($block['type']) }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 sm:px-6 font-bold text-heading text-right whitespace-nowrap">
                                            {{ $block['sks'] }} SKS
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Tahap Profesi Dokter (Koas) Tab Content -->
        <div 
            x-show="activeTab === 'profesi'"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            style="display: none;"
        >
            <div class="space-y-8">
                <!-- Overview Banner -->
                <div class="bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white p-6 sm:p-8 rounded-2xl shadow-sm">
                    <div class="max-w-3xl space-y-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-white/20 text-white uppercase tracking-wider backdrop-blur-xs">
                            {{ __('Tahap Pendidikan Profesi Dokter (dr.)') }}
                        </span>
                        <h3 class="text-xl sm:text-2xl font-extrabold text-white">
                            {{ __('Kepaniteraan Klinik Komprehensif (44 SKS · 2 Tahun)') }}
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-100 leading-relaxed">
                            {{ __('Dilaksanakan di Rumah Sakit Pendidikan Utama RSUD Praya, RS Khusus Jejaring (RSJ Mutiara Sukma, RS Mata NTB, RS Bhayangkara), serta Puskesmas di wilayah NTB di bawah supervisi langsung Konsulen Dokter Spesialis dan Dokter Pendidik Klinis.') }}
                        </p>
                    </div>
                </div>

                <!-- Stase Mayor (4 Departemen Utama) -->
                <div class="bg-white rounded-2xl border border-border-subtle shadow-xs overflow-hidden">
                    <div class="p-5 sm:p-6 border-b border-border-subtle bg-slate-50/70 flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#2466C1]">{{ __('ROTASI MAYOR') }}</span>
                            <h4 class="text-base sm:text-lg font-bold text-heading mt-0.5">{{ __('Empat Pilar Utama Kepaniteraan Klinik (10 Minggu per Stase)') }}</h4>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white border border-border-subtle text-heading shadow-2xs shrink-0">
                            20 SKS
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-border-subtle">
                        @foreach($clinicalRotations['mayor'] as $stase)
                            <div class="p-5 sm:p-6 flex items-start justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0" />
                                        <h5 class="text-sm sm:text-base font-bold text-heading">{{ __($stase['name']) }}</h5>
                                    </div>
                                    <span class="text-xs text-body block pl-6">{{ __('Wahana:') }} {{ __($stase['location']) }}</span>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="text-xs font-bold text-[#2466C1] block">{{ __($stase['duration']) }}</span>
                                    <span class="text-[11px] text-steel-500 block">{{ $stase['sks'] }} SKS</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Stase Minor & Komunitas (9 Departemen) -->
                <div class="bg-white rounded-2xl border border-border-subtle shadow-xs overflow-hidden">
                    <div class="p-5 sm:p-6 border-b border-border-subtle bg-slate-50/70 flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#2466C1]">{{ __('ROTASI MINOR & LAYANAN PRIMER') }}</span>
                            <h4 class="text-base sm:text-lg font-bold text-heading mt-0.5">{{ __('Rotasi Departemen Spesifik & Komunitas (4 – 8 Minggu)') }}</h4>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white border border-border-subtle text-heading shadow-2xs shrink-0">
                            24 SKS
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 divide-y sm:divide-y-0 divide-border-subtle gap-px bg-border-subtle">
                        @foreach($clinicalRotations['minor'] as $stase)
                            <div class="p-5 bg-white space-y-2 flex flex-col justify-between hover:bg-slate-50/50 transition-colors">
                                <div>
                                    <div class="flex items-center justify-between gap-2">
                                        <h5 class="text-sm font-bold text-heading leading-snug">{{ __($stase['name']) }}</h5>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-steel-700 shrink-0">
                                            {{ $stase['sks'] }} SKS
                                        </span>
                                    </div>
                                    <span class="text-xs text-body block mt-1 leading-relaxed">
                                        {{ __('Wahana:') }} {{ __($stase['location']) }}
                                    </span>
                                </div>
                                <div class="pt-2 border-t border-border-subtle/60 flex items-center justify-between text-xs font-semibold text-[#2466C1]">
                                    <span>{{ __('Durasi Rotasi') }}</span>
                                    <span>{{ __($stase['duration']) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Methodological Pillars of Medical Learning -->
<section class="py-14 lg:py-20 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">
                {{ __('PROSES PEMBELAJARAN') }}
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-heading tracking-tight mt-2">
                {{ __('Pendekatan Pembelajaran di Fakultas Kedokteran') }}
            </h2>
            <p class="text-sm sm:text-base text-body mt-2.5">
                {{ __('Proses pendidikan di Fakultas Kedokteran Universitas Bumigora dilaksanakan melalui pembelajaran terintegrasi yang memadukan penguasaan ilmu kedokteran, diskusi kasus, praktikum laboratorium, dan latihan keterampilan klinis.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($methods as $method)
                <div class="p-6 rounded-2xl bg-surface border border-border-subtle space-y-3.5 shadow-2xs hover:border-[#2466C1]/40 transition-colors">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#08244b]/15 via-[#2466C1]/20 to-[#08244b]/15 text-[#2466C1] flex items-center justify-center shrink-0">
                        <x-icon :name="$method['icon']" class="w-5 h-5 text-[#2466C1]" />
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-heading leading-snug">{{ __($method['title']) }}</h3>
                        <span class="text-xs font-medium text-[#2466C1] block mt-0.5">{{ __($method['subtitle']) }}</span>
                    </div>
                    <p class="text-xs text-body leading-relaxed">
                        {{ __($method['description']) }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action / Academic Support -->
<section class="py-12 lg:py-16 bg-gradient-to-r from-[#08244b]/5 via-[#2466c1]/10 to-[#08244b]/5 border-b border-border-subtle">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white border border-border-subtle text-heading shadow-2xs">
            <x-icon name="book-open" class="w-3.5 h-3.5 text-[#2466C1]" />
            <span>{{ __('PANDUAN & KONSULTASI AKADEMIK') }}</span>
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-heading tracking-tight">
            {{ __('Ingin Mempelajari Kurikulum Kedokteran UBG Lebih Lanjut?') }}
        </h2>
        <p class="text-sm sm:text-base text-body max-w-2xl mx-auto leading-relaxed">
            {{ __('Tim Bagian Akademik dan Program Studi Kedokteran siap membantu menjawab pertanyaan terkait tahapan perkuliahan, sistem blok, dan tata cara pendaftaran mahasiswa baru.') }}
        </p>
        <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
            <x-button 
                href="{{ $settings['pmb_url'] ?? 'https://pmb.universitasbumigora.ac.id' }}" 
                target="_blank" 
                rel="noopener noreferrer" 
                variant="primary" 
                size="md" 
                class="shadow-sm"
            >
                <x-icon name="graduation-cap" class="w-4 h-4" />
                <span>{{ __('Pendaftaran Mahasiswa Baru') }}</span>
            </x-button>

            <x-button 
                href="{{ route('contact') }}" 
                variant="outline" 
                size="md"
            >
                <x-icon name="mail" class="w-4 h-4" />
                <span>{{ __('Konsultasi Akademik') }}</span>
            </x-button>
        </div>
    </div>
</section>
@endsection
