@extends('layouts.app')

@section('title', __('Dosen & Tenaga Pengajar | Fakultas Kedokteran UBG'))
@section('meta_description', __('Daftar dosen pendidik klinis, dokter spesialis, akademisi biomedik, dan dekanat Fakultas Kedokteran Universitas Bumigora Mataram.'))

@section('content')
<!-- Page Header & Breadcrumbs -->
<div class="bg-surface border-b border-border-subtle py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-body mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-heading transition-colors">{{ __('Beranda') }}</a>
            <span>/</span>
            <span class="text-heading font-semibold">{{ __('Dosen') }}</span>
        </nav>
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/20 border border-[#2466c1]/30 text-heading mb-3">
                <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></span>
                <span>{{ __('TENAGA PENDIDIK & PAKAR KLINIS') }}</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-heading tracking-tight leading-tight">
                {{ __('Dosen dan Tenaga Pendidik') }}
            </h1>
            <p class="text-base sm:text-lg text-body mt-3 leading-relaxed">
                {{ __('Para dokter spesialis, ilmuwan biomedik, dan pendidik kedokteran berdedikasi membimbing mahasiswa dengan keteladanan etik serta standar kompetensi klinis tertinggi.') }}
            </p>
        </div>
    </div>
</div>

<!-- Faculty Members Section -->
<section class="py-16 lg:py-24 bg-white border-b border-border-subtle" x-data="{ facultyFilter: 'all', searchQuery: '' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Controls: Category Filters & Search -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-10">
            <!-- Filter Tabs -->
            <div class="flex flex-wrap justify-center gap-2 pb-2 w-full sm:w-auto">
                <button 
                    @click="facultyFilter = 'all'" 
                    :class="facultyFilter === 'all' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-sm' : 'bg-surface text-body hover:bg-steel-50'"
                    class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap"
                >
                    {{ __('Semua Dosen') }} ({{ $facultyMembers->count() }})
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

            <!-- Instant Search Input -->
            <div class="relative w-full sm:w-72">
                <input 
                    type="text" 
                    x-model="searchQuery" 
                    placeholder="{{ __('Cari nama, spesialisasi...') }}"
                    class="w-full text-xs rounded-xl border border-border-subtle bg-surface px-3.5 py-2 pl-9 text-heading focus:outline-none focus:ring-2 focus:ring-[#2466C1]/30 focus:border-[#2466C1]"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-steel-400">
                    <x-icon name="search" class="w-3.5 h-3.5" />
                </div>
            </div>
        </div>

        @if($facultyMembers->isEmpty())
            <x-empty-state 
                :title="__('Daftar Dosen Sedang Diperbarui')"
                :message="__('Informasi tenaga pendidik dan dokter klinis sedang dalam tahap sinkronisasi data kepegawaian.')"
                icon="users"
            />
        @else
            <!-- Faculty Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($facultyMembers as $faculty)
                    <div 
                        x-show="(facultyFilter === 'all' || {{ json_encode($faculty->category) }}.includes(facultyFilter)) && (searchQuery === '' || '{{ strtolower(addslashes($faculty->name . ' ' . $faculty->specialization . ' ' . $faculty->primary_category_label)) }}'.includes(searchQuery.toLowerCase()))"
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
                                {{ $faculty->department ?? __('Fakultas Kedokteran UBG') }}
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

    </div>
</section>

<!-- Teaching Methodology Highlights -->
<section class="py-16 lg:py-20 bg-surface border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 rounded-2xl bg-white border border-border-subtle shadow-2xs space-y-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="award" class="w-5 h-5 text-[#2466C1]" />
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('Kualifikasi Klinis & Konsulen') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Dosen pendidik klinis berpraktik aktif di Rumah Sakit Pendidikan Utama dengan Surat Izin Praktik (SIP) dan sertifikasi pendidik klinis terverifikasi.') }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-border-subtle shadow-2xs space-y-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="book-open" class="w-5 h-5 text-[#2466C1]" />
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('Pembimbingan Intensif Bedside Teaching') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Rasio pembimbingan dosen terhadap mahasiswa dirancang terukur agar setiap dokter muda mendapatkan supervisi langsung pada stase rotasi klinis.') }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-border-subtle shadow-2xs space-y-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center">
                    <x-icon name="book-open" class="w-5 h-5 text-[#2466C1]" />
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('Pengembangan Ilmu Berkelanjutan') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Dosen secara konsisten memperbarui keilmuan medis terkini dan membimbing mahasiswa dalam penerapan kedokteran berbasis bukti (evidence-based medicine).') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Bottom CTA -->
<section class="py-14 bg-gradient-to-r from-[#08244b]/10 via-[#2466c1]/10 to-[#08244b]/10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h3 class="text-xl sm:text-2xl font-bold text-heading">
            {{ __('Ingin Berdiskusi Mengenai Kerjasama Akademik & Pengajaran?') }}
        </h3>
        <p class="text-sm text-body max-w-xl mx-auto">
            {{ __('Fakultas Kedokteran UBG membuka pintu kolaborasi akademis, kuliah tamu, dan program pendidikan dokter bersama institusi kesehatan terkemuka.') }}
        </p>
        <div class="pt-2 flex flex-wrap justify-center gap-3">
            <x-button href="{{ route('contact') }}" variant="primary" size="md">
                <span>{{ __('Hubungi Fakultas Kedokteran') }}</span>
                <x-icon name="arrow-right" class="w-4 h-4" />
            </x-button>
        </div>
    </div>
</section>
@endsection
