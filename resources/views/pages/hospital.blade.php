@extends('layouts.app')

@section('title', __('Rumah Sakit Pendidikan & Wahana Klinis | Fakultas Kedokteran UBG'))
@section('meta_description', __('Rumah Sakit Pendidikan Utama RSUD Praya dan jejaring rumah sakit mitra kepaniteraan klinik (koas) Fakultas Kedokteran Universitas Bumigora di NTB.'))

@section('content')
<!-- Page Header & Breadcrumbs -->
<div class="bg-surface border-b border-border-subtle py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-body mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-heading transition-colors">{{ __('Beranda') }}</a>
            <span>/</span>
            <span class="text-body">{{ __('Akademik') }}</span>
            <span>/</span>
            <span class="text-heading font-semibold">{{ __('RS Pendidikan') }}</span>
        </nav>
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/20 border border-[#2466c1]/30 text-heading mb-3">
                <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></span>
                <span>{{ __('WAHANA PENDIDIKAN KLINIS & JEJARING') }}</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-heading tracking-tight leading-tight">
                {{ __('Rumah Sakit Pendidikan & Jejaring Klinis') }}
            </h1>
            <p class="text-base sm:text-lg text-body mt-3 leading-relaxed">
                {{ __('Pusat penyelenggaraan pendidikan tahap profesi dokter (kepaniteraan klinik/koas) Fakultas Kedokteran Universitas Bumigora yang terintegrasi dengan rumah sakit terakreditasi paripurna dan wahana pelayanan kesehatan di Nusa Tenggara Barat.') }}
            </p>
        </div>
    </div>
</div>

@if($mainHospital)
<!-- Featured Section: Rumah Sakit Pendidikan Utama -->
<section class="py-14 lg:py-20 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-border-subtle bg-gradient-to-br from-white via-surface/60 to-[#2466C1]/5 p-6 sm:p-8 lg:p-12 shadow-sm overflow-hidden relative">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <!-- Info Column (7 Cols) -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-[#2466C1] text-white shadow-xs">
                            <x-icon name="award" class="w-3.5 h-3.5 text-white" />
                            <span>{{ $mainHospital->type_label }}</span>
                        </span>
                        @if($mainHospital->accreditation)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <x-icon name="shield-check" class="w-3.5 h-3.5 text-emerald-600" />
                                <span>{{ $mainHospital->accreditation }}</span>
                            </span>
                        @endif
                    </div>

                    <div>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-heading tracking-tight">
                            {{ $mainHospital->name }}
                        </h2>
                        @if($mainHospital->city)
                            <p class="text-sm font-medium text-[#2466C1] mt-1 flex items-center gap-1.5">
                                <x-icon name="map-pin" class="w-4 h-4 text-[#2466C1]" />
                                <span>{{ $mainHospital->city }}, {{ $mainHospital->province ?? 'Nusa Tenggara Barat' }}</span>
                            </p>
                        @endif
                    </div>

                    <p class="text-body text-sm sm:text-base leading-relaxed">
                        {{ $mainHospital->description }}
                    </p>

                    <!-- Key Indicators Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3.5 pt-2">
                        @if($mainHospital->capacity)
                            <div class="p-3.5 rounded-2xl bg-white border border-border-subtle shadow-2xs">
                                <span class="text-[11px] font-semibold text-body uppercase tracking-wider block">{{ __('Kapasitas Tempat Tidur') }}</span>
                                <span class="text-base font-bold text-heading mt-1 block">{{ __($mainHospital->capacity) }}</span>
                            </div>
                        @endif
                        @if($mainHospital->mou_number)
                            <div class="p-3.5 rounded-2xl bg-white border border-border-subtle shadow-2xs">
                                <span class="text-[11px] font-semibold text-body uppercase tracking-wider block">{{ __('Legalitas Kerjasama') }}</span>
                                <span class="text-xs font-bold text-heading mt-1 block truncate" title="{{ $mainHospital->mou_number }}">
                                    {{ $mainHospital->mou_number }}
                                </span>
                            </div>
                        @endif
                        @if($mainHospital->director_name)
                            <div class="p-3.5 rounded-2xl bg-white border border-border-subtle shadow-2xs">
                                <span class="text-[11px] font-semibold text-body uppercase tracking-wider block">{{ __('Pimpinan / Direktur') }}</span>
                                <span class="text-xs font-bold text-heading mt-1 block truncate" title="{{ $mainHospital->director_name }}">
                                    {{ $mainHospital->director_name }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Contact & Map Links -->
                    <div class="flex flex-wrap items-center gap-3 pt-2 text-xs text-body">
                        @if($mainHospital->address)
                            <div class="flex items-center gap-1.5">
                                <x-icon name="map-pin" class="w-3.5 h-3.5 text-steel-400" />
                                <span>{{ $mainHospital->address }}</span>
                            </div>
                        @endif
                        @if($mainHospital->phone)
                            <div class="flex items-center gap-1.5">
                                <x-icon name="phone" class="w-3.5 h-3.5 text-steel-400" />
                                <span>{{ $mainHospital->phone }}</span>
                            </div>
                        @endif
                        @if($mainHospital->website_url)
                            <a href="{{ $mainHospital->website_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-[#2466C1] hover:underline font-semibold">
                                <span>{{ __('Situs Resmi RS') }}</span>
                                <x-icon name="external-link" class="w-3 h-3" />
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Media Column (5 Cols) -->
                <div class="lg:col-span-5">
                    <div class="relative rounded-2xl overflow-hidden border border-border-subtle shadow-md bg-steel-100 group">
                        <img 
                            src="{{ $mainHospital->image_src ?? asset('images/facilities/hospital.jpg') }}" 
                            alt="{{ $mainHospital->name }}" 
                            class="w-full h-80 sm:h-96 object-cover group-hover:scale-102 transition-transform duration-300" 
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent"></div>
                        <div class="absolute bottom-5 left-5 right-5 text-white">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-[#2466C1] text-white uppercase tracking-wider mb-1.5">
                                {{ __('Wahana Utama Koas') }}
                            </span>
                            <p class="text-sm font-semibold text-white/95 leading-snug">
                                {{ __('Pusat Bimbingan Dokter Pendidik Klinis & Konsulen Spesialis FK UBG') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stase Klinis & Fasilitas Coass Tabs / Grids -->
            @if(!empty($mainHospital->departments) || !empty($mainHospital->facilities))
                <div class="mt-10 pt-8 border-t border-border-subtle grid grid-cols-1 md:grid-cols-2 gap-8">
                    @if(!empty($mainHospital->departments) && is_array($mainHospital->departments))
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-[#2466C1]/10 text-[#2466C1] flex items-center justify-center">
                                    <x-icon name="stethoscope" class="w-4 h-4 text-[#2466C1]" />
                                </div>
                                <h3 class="text-sm font-bold uppercase tracking-wider text-heading">
                                    {{ __('Stase & Departemen Rotasi Klinis') }}
                                </h3>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach($mainHospital->departments as $dept)
                                    <div class="flex items-start gap-2 p-2.5 rounded-xl bg-white border border-border-subtle text-xs text-heading">
                                        <x-icon name="check" class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" />
                                        <span>{{ __($dept) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(!empty($mainHospital->facilities) && is_array($mainHospital->facilities))
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-[#2466C1]/10 text-[#2466C1] flex items-center justify-center">
                                    <x-icon name="building" class="w-4 h-4 text-[#2466C1]" />
                                </div>
                                <h3 class="text-sm font-bold uppercase tracking-wider text-heading">
                                    {{ __('Sarana Penunjang Pendidikan Dokter Muda') }}
                                </h3>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach($mainHospital->facilities as $fac)
                                    <div class="flex items-start gap-2 p-2.5 rounded-xl bg-white border border-border-subtle text-xs text-heading">
                                        <x-icon name="check" class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" />
                                        <span>{{ __($fac) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- Network Hospitals & Satellite Facilities -->
<section class="py-16 lg:py-24 bg-surface border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-heading 
            :eyebrow="__('JEJARING RUMAH SAKIT & WAHANA SATELIT')"
            :title="__('Mitra Layanan Spesialistik & Komunitas')"
            :subtitle="__('Memperkaya ragam kasus klinis dokter muda melalui kemitraan strategis dengan rumah sakit khusus, fasilitas forensik, dan puskesmas jejaring.')"
        />

        @if($networkHospitals->isEmpty())
            <div class="bg-white rounded-2xl border border-border-subtle p-8 text-center text-sm text-body">
                {{ __('Data rumah sakit jejaring sedang dalam proses verifikasi administrasi.') }}
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($networkHospitals as $hospital)
                    <div class="rounded-2xl border border-border-subtle bg-white overflow-hidden shadow-2xs hover:border-[#2466C1]/40 transition-all flex flex-col justify-between group">
                        <div>
                            <!-- Header Photo / Fallback -->
                            <div class="h-48 relative overflow-hidden bg-steel-100">
                                @if($hospital->image_url)
                                    <img 
                                        src="{{ $hospital->image_src }}" 
                                        alt="{{ $hospital->name }}" 
                                        class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300" 
                                        loading="lazy"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-steel-400 bg-gradient-to-br from-steel-50 to-steel-100">
                                        <x-icon name="hospital" class="w-12 h-12 text-[#2466C1]/40" />
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-white/95 text-heading shadow-xs">
                                        {{ $hospital->type_label }}
                                    </span>
                                </div>
                                <div class="absolute bottom-3 left-3 right-3 text-white">
                                    <h3 class="text-base sm:text-lg font-bold text-white tracking-tight leading-snug">
                                        {{ $hospital->name }}
                                    </h3>
                                    @if($hospital->city)
                                        <p class="text-xs text-white/80 flex items-center gap-1 mt-0.5">
                                            <x-icon name="map-pin" class="w-3 h-3 text-white/80" />
                                            <span>{{ $hospital->city }}</span>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Description & Details -->
                            <div class="p-6 space-y-4">
                                <p class="text-xs sm:text-sm text-body leading-relaxed">
                                    {{ $hospital->description }}
                                </p>

                                @if($hospital->accreditation || $hospital->capacity)
                                    <div class="flex flex-wrap items-center gap-2 pt-1">
                                        @if($hospital->accreditation)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <x-icon name="shield-check" class="w-3 h-3 text-emerald-600" />
                                                <span>{{ $hospital->accreditation }}</span>
                                            </span>
                                        @endif
                                        @if($hospital->capacity)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-[11px] font-medium bg-slate-50 text-slate-700 border border-slate-200">
                                                <span>{{ __($hospital->capacity) }}</span>
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                @if(!empty($hospital->departments) && is_array($hospital->departments))
                                    <div class="pt-3 border-t border-border-subtle space-y-1.5">
                                        <span class="text-[11px] font-bold uppercase tracking-wider text-heading block">
                                            {{ __('Fokus Stase & Layanan Klinis:') }}
                                        </span>
                                        <div class="space-y-1">
                                            @foreach(array_slice($hospital->departments, 0, 3) as $dept)
                                                <div class="flex items-start gap-1.5 text-xs text-body">
                                                    <x-icon name="check" class="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" />
                                                    <span class="truncate">{{ __($dept) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 pt-0">
                            <div class="pt-3 border-t border-border-subtle flex items-center justify-between text-xs text-body">
                                <span>{{ __('Wahana Resmi FK UBG') }}</span>
                                <span class="font-semibold text-[#2466C1]">{{ __('Terstandar KKI') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Tahapan Kepaniteraan Klinik (Clinical Clerkship Journey) -->
<section class="py-16 lg:py-24 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-heading 
            :eyebrow="__('KURIKULUM KLINIS PROFESI')"
            :title="__('Tahapan Rotasi Dokter Muda (Koas)')"
            :subtitle="__('Struktur pembelajaran kepaniteraan klinik 4 semester di wahana rumah sakit pendidikan dan satelit pelayanan kesehatan.')"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Stage 1 -->
            <div class="p-6 rounded-2xl bg-surface border border-border-subtle shadow-2xs space-y-3 relative group hover:border-[#2466C1]/40 transition-all">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center font-bold text-sm">
                    01
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('Stase Mayor Primer') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Rotasi intensif di Departemen Ilmu Penyakit Dalam dan Ilmu Kesehatan Anak. Fokus pada anamnesis mendalam, pemeriksaan fisik terstandar, dan terapi rasional.') }}
                </p>
                <div class="pt-2 text-[11px] font-semibold text-[#2466C1]">
                    {{ __('Lokasi:') }} RSUD Praya
                </div>
            </div>

            <!-- Stage 2 -->
            <div class="p-6 rounded-2xl bg-surface border border-border-subtle shadow-2xs space-y-3 relative group hover:border-[#2466C1]/40 transition-all">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center font-bold text-sm">
                    02
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('Stase Mayor Bedah & Obgyn') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Kepaniteraan di Departemen Ilmu Bedah dan Obstetri-Ginekologi. Pembelajaran prosedur kamar operasi, persalinan normal, serta penanganan kasus gawat darurat bedah.') }}
                </p>
                <div class="pt-2 text-[11px] font-semibold text-[#2466C1]">
                    {{ __('Lokasi:') }} RSUD Praya
                </div>
            </div>

            <!-- Stage 3 -->
            <div class="p-6 rounded-2xl bg-surface border border-border-subtle shadow-2xs space-y-3 relative group hover:border-[#2466C1]/40 transition-all">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center font-bold text-sm">
                    03
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('Stase Minor Spesialistik') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Rotasi terarah pada spesialisasi Mata, THT-KL, Neurologi, Psikiatri, Kulit & Kelamin, Anestesiologi, Radiologi, serta Forensik Medikolegal.') }}
                </p>
                <div class="pt-2 text-[11px] font-semibold text-[#2466C1]">
                    {{ __('Lokasi:') }} {{ __('RS Jejaring Spesialis') }}
                </div>
            </div>

            <!-- Stage 4 -->
            <div class="p-6 rounded-2xl bg-surface border border-border-subtle shadow-2xs space-y-3 relative group hover:border-[#2466C1]/40 transition-all">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center font-bold text-sm">
                    04
                </div>
                <h4 class="text-base font-bold text-heading">{{ __('Komprehensif & UKMPPD') }}</h4>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Kedokteran Komunitas di Puskesmas, penguatan penalaran klinis terpadu, bimbingan intensif persiapan Uji Kompetensi Mahasiswa Program Profesi Dokter (UKMPPD).') }}
                </p>
                <div class="pt-2 text-[11px] font-semibold text-[#2466C1]">
                    {{ __('Lokasi:') }} {{ __('Puskesmas & Kampus UBG') }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bottom CTA -->
<section class="py-14 bg-gradient-to-r from-[#08244b]/10 via-[#2466c1]/10 to-[#08244b]/10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h3 class="text-xl sm:text-2xl font-bold text-heading">
            {{ __('Ingin Mengetahui Rincian Kurikulum & Sarana Lainnya?') }}
        </h3>
        <p class="text-sm text-body max-w-xl mx-auto">
            {{ __('Pelajari struktur kurikulum blok pendidikan dokter dan jelajahi laboratorium modern Fakultas Kedokteran UBG.') }}
        </p>
        <div class="pt-2 flex flex-wrap justify-center gap-3">
            <x-button href="{{ route('curriculum') }}" variant="primary" size="md">
                <x-icon name="book-open" class="w-4 h-4" />
                <span>{{ __('Lihat Kurikulum & Blok') }}</span>
            </x-button>
            <x-button href="{{ route('facilities') }}" variant="outline" size="md">
                <x-icon name="building" class="w-4 h-4" />
                <span>{{ __('Lihat Fasilitas & Lab') }}</span>
            </x-button>
            <x-button href="{{ route('contact') }}" variant="ghost" size="md">
                <span>{{ __('Hubungi Sekretariat') }}</span>
            </x-button>
        </div>
    </div>
</section>
@endsection
