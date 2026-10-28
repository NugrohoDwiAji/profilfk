@extends('layouts.app')

@section('title', __('Galeri Foto & Dokumentasi | Fakultas Kedokteran UBG'))
@section('meta_description', __('Galeri dokumentasi kegiatan akademik, praktikum laboratorium, simulasi klinis, wahana rumah sakit pendidikan, dan aktivitas kemahasiswaan Fakultas Kedokteran Universitas Bumigora.'))

@section('content')
<!-- Page Header & Breadcrumbs -->
<div class="bg-surface border-b border-border-subtle py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-body mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-heading transition-colors">{{ __('Beranda') }}</a>
            <span>/</span>
            <span class="text-heading font-semibold">{{ __('Galeri') }}</span>
        </nav>
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/20 border border-[#2466c1]/30 text-heading mb-3">
                <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></span>
                <span>{{ __('DOKUMENTASI & AKTIVITAS') }}</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-heading tracking-tight leading-tight">
                {!! __('Galeri Foto & Aktivitas Kampus') !!}
            </h1>
            <p class="text-base sm:text-lg text-body mt-3 leading-relaxed">
                {{ __('Dokumentasi berbagai kegiatan akademik, penelitian, pengabdian kepada masyarakat, kemahasiswaan, serta kerja sama yang diselenggarakan oleh Fakultas Kedokteran Universitas Bumigora.') }}
            </p>
        </div>
    </div>
</div>

<!-- Main Gallery Section with Alpine.js Lightbox Modal -->
<section 
    x-data="{ 
        activeModal: false, 
        currentImage: '', 
        currentTitle: '', 
        currentCategory: '', 
        openLightbox(img, title, cat) {
            this.currentImage = img;
            this.currentTitle = title;
            this.currentCategory = cat;
            this.activeModal = true;
            document.body.style.overflow = 'hidden';
        },
        closeLightbox() {
            this.activeModal = false;
            document.body.style.overflow = '';
        }
    }"
    @keydown.escape.window="closeLightbox()"
    class="py-16 lg:py-24 bg-white border-b border-border-subtle"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter Pills -->
        <div class="flex items-center justify-start sm:justify-center gap-2 mb-12 overflow-x-auto pb-3">
            <a 
                href="{{ route('gallery.index') }}" 
                class="px-4 py-2 rounded-xl text-xs font-semibold uppercase tracking-wider transition-all whitespace-nowrap {{ !request()->filled('category') || request('category') === 'all' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-sm' : 'bg-surface text-body hover:bg-steel-50 border border-border-subtle' }}"
            >
                {{ __('Semua Kegiatan') }}
            </a>
            @foreach($categories as $cat)
                <a 
                    href="{{ route('gallery.index', ['category' => $cat]) }}" 
                    class="px-4 py-2 rounded-xl text-xs font-semibold uppercase tracking-wider transition-all whitespace-nowrap {{ request('category') === $cat ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-sm' : 'bg-surface text-body hover:bg-steel-50 border border-border-subtle' }}"
                >
                    {{ __($cat) }}
                </a>
            @endforeach
        </div>

        @if($galleries->isEmpty())
            <x-empty-state 
                title="{{ __('Belum Ada Foto Galeri') }}"
                message="{{ __('Dokumentasi foto kegiatan akademik dan sarana kampus sedang dipersiapkan untuk dipublikasikan.') }}"
                icon="photo"
            />
        @else
            <!-- Photo Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($galleries as $gallery)
                    @php
                        $imageSrc = $gallery->image_src;
                        $titleStr = (string) $gallery->title;
                        $categoryStr = (string) ($gallery->category ?? '');
                    @endphp
                    <div 
                        @click="openLightbox('{{ $imageSrc }}', @js($titleStr), @js($categoryStr))"
                        title="{{ $titleStr }}"
                        class="group relative rounded-2xl overflow-hidden border border-border-subtle bg-white shadow-xs hover:shadow-xl hover:border-[#2466C1]/50 transition-all duration-300 cursor-pointer flex flex-col justify-between"
                    >
                        <!-- Image Container with Aspect Ratio -->
                        <div class="aspect-[16/10] w-full overflow-hidden bg-steel-100 relative">
                            @if($imageSrc)
                                <img 
                                    src="{{ $imageSrc }}" 
                                    alt="{{ $titleStr }}" 
                                    class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500 ease-out"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center text-steel-400">
                                    <x-icon name="photo" class="w-12 h-12" />
                                </div>
                            @endif

                            <!-- Top-Left Category Label & Zoom Indicator -->
                            <div class="absolute bottom-3 inset-x-3 flex items-start justify-between z-10 pointer-events-none ">
                                @if($categoryStr)
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-white/70 backdrop-blur-md text-royal-800 shadow-md  border border-white/60 group-hover:bg-[#2466C1] group-hover:text-white transition-all duration-200">
                                        {{ __($categoryStr) }}
                                    </span>
                                @else
                                    <span></span>
                                @endif

                                <span class="w-8 h-8 rounded-full bg-black/40 backdrop-blur-md text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 shrink-0 ml-2">
                                    <x-icon name="maximize" class="w-4 h-4" />
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            @if($galleries->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $galleries->links() }}
                </div>
            @endif
        @endif

    </div>

    <!-- Lightbox Modal Component (Alpine.js) -->
    <div 
        x-show="activeModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/90 backdrop-blur-md"
        style="display: none;"
    >
        <!-- Backdrop Click to Close -->
        <div class="fixed inset-0" @click="closeLightbox()"></div>

        <!-- Modal Dialog Content -->
        <div 
            x-show="activeModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative z-10 max-w-4xl w-full bg-slate-900 rounded-2xl overflow-hidden shadow-2xl border border-white/10"
        >
            <!-- Close Button -->
            <button 
                @click="closeLightbox()"
                type="button" 
                class="absolute top-3 right-3 z-20 w-10 h-10 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center transition-colors cursor-pointer border border-white/20 focus:outline-none"
                aria-label="{{ __('Tutup foto') }}"
            >
                <x-icon name="x" class="w-5 h-5" />
            </button>

            <!-- Large Image Container -->
            <div class="relative bg-black flex items-center justify-center max-h-[72vh] overflow-hidden">
                <img 
                    :src="currentImage" 
                    :alt="currentTitle" 
                    class="max-h-[72vh] w-auto max-w-full object-contain select-none"
                >
            </div>

            <!-- Modal Caption Footer -->
            <div class="p-5 sm:p-6 bg-slate-900/95 border-t border-white/10 text-white">
                <div class="flex items-center gap-2 mb-2" x-show="currentCategory">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-500/20 text-blue-300 border border-blue-400/30" x-text="currentCategory"></span>
                </div>
                <h4 class="text-lg sm:text-xl font-bold leading-tight" x-text="currentTitle"></h4>
            </div>
        </div>
    </div>
</section>
@endsection
