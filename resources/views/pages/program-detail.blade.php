@extends('layouts.app')

@section('title', $program->name . ' | Fakultas Kedokteran UBG')
@section('meta_description', Str::limit(strip_tags($program->description), 150))

@section('content')
<div class="py-10 lg:py-16 bg-surface border-b border-border-subtle">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-body mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-heading transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('home') }}#pendidikan" class="hover:text-heading transition-colors">Program Pendidikan</a>
            <span>/</span>
            <span class="text-heading font-medium">{{ $program->name }}</span>
        </nav>

        <!-- Program Header -->
        <div class="space-y-4 mb-8">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-steel-100 text-steel-700">
                    Jenjang {{ $program->degree }}
                </span>
                <span class="text-xs font-semibold text-[#9064C2]">
                    Gelar: {{ $program->degree_title }}
                </span>
                <span>•</span>
                <span class="text-xs text-body">{{ $program->accreditation }}</span>
            </div>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-heading tracking-tight leading-tight">
                {{ $program->name }}
            </h1>

            @if($program->tagline)
                <p class="text-base sm:text-lg text-body leading-relaxed border-l-4 border-[#7D99B0] pl-4 italic">
                    {{ $program->tagline }}
                </p>
            @endif
        </div>

        <!-- Featured Image -->
        @if($program->image_url)
            <div class="rounded-2xl overflow-hidden mb-10 border border-border-subtle bg-white shadow-xs">
                <img 
                    src="{{ asset($program->image_url) }}" 
                    alt="{{ $program->name }}" 
                    class="w-full max-h-[420px] object-cover"
                >
            </div>
        @endif

        <!-- Program Specifications -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="p-4 rounded-xl bg-white border border-border-subtle text-center">
                <span class="text-xs text-body uppercase tracking-wider block">Masa Studi Normal</span>
                <span class="text-xl font-bold text-heading mt-1 block">{{ $program->duration_semesters }} Semester</span>
            </div>
            <div class="p-4 rounded-xl bg-white border border-border-subtle text-center">
                <span class="text-xs text-body uppercase tracking-wider block">Gelar Kelulusan</span>
                <span class="text-xl font-bold text-[#9064C2] mt-1 block">{{ $program->degree_title }}</span>
            </div>
            <div class="p-4 rounded-xl bg-white border border-border-subtle text-center">
                <span class="text-xs text-body uppercase tracking-wider block">Status Akreditasi</span>
                <span class="text-xl font-bold text-[#7D99B0] mt-1 block">{{ $program->accreditation ?? 'LAM-PTKes' }}</span>
            </div>
        </div>

        <!-- Program Details Content -->
        <div class="bg-white rounded-2xl p-6 sm:p-10 border border-border-subtle shadow-2xs space-y-8">
            <div>
                <h3 class="text-lg font-bold text-heading mb-3">Deskripsi Program</h3>
                <p class="text-body leading-relaxed text-sm sm:text-base">
                    {{ $program->description }}
                </p>
            </div>

            @if($program->curriculum_summary)
                <div class="pt-6 border-t border-border-subtle">
                    <h3 class="text-lg font-bold text-heading mb-3">Struktur Kurikulum & Pendekatan Belajar</h3>
                    <p class="text-body leading-relaxed text-sm sm:text-base">
                        {{ $program->curriculum_summary }}
                    </p>
                </div>
            @endif

            @if(!empty($program->career_prospects) && is_array($program->career_prospects))
                <div class="pt-6 border-t border-border-subtle">
                    <h3 class="text-lg font-bold text-heading mb-3">Capaian Kompetensi & Prospek Lulusan</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                        @foreach($program->career_prospects as $prospect)
                            <div class="flex items-start gap-2.5 text-xs sm:text-sm text-heading p-3 rounded-lg bg-surface border border-border-subtle">
                                <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                                <span>{{ $prospect }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Admission CTA Box -->
            <div class="pt-8 border-t border-border-subtle flex flex-col sm:flex-row items-center justify-between gap-4 p-6 rounded-xl bg-gradient-to-r from-steel-50 to-royal-50 border border-steel-200/60">
                <div>
                    <h4 class="text-base font-bold text-heading">Tertarik Mendaftar di Program Ini?</h4>
                    <p class="text-xs text-body mt-0.5">Daftarkan diri Anda melalui jalur seleksi PMB resmi Universitas Bumigora.</p>
                </div>
                <x-button 
                    href="{{ $settings['pmb_url'] ?? 'https://pmb.universitasbumigora.ac.id' }}" 
                    target="_blank"
                    rel="noopener noreferrer"
                    variant="primary" 
                    size="md"
                >
                    <x-icon name="graduation-cap" class="w-4 h-4" />
                    <span>Daftar Sekarang</span>
                </x-button>
            </div>
        </div>

    </div>
</div>
@endsection
