@extends('layouts.app')

@section('title', __('Berita & Pengumuman | Fakultas Kedokteran UBG'))
@section('meta_description', __('Berita terkini, agenda akademik, kegiatan kemahasiswaan, dan pengumuman resmi Fakultas Kedokteran Universitas Bumigora Mataram.'))

@section('content')
<!-- Page Header & Breadcrumbs -->
<div class="bg-surface border-b border-border-subtle py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-body mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-heading transition-colors">{{ __('Beranda') }}</a>
            <span>/</span>
            <span class="text-heading font-semibold">{{ __('Berita') }}</span>
        </nav>
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/20 border border-[#2466c1]/30 text-heading mb-3">
                <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></span>
                <span>{{ __('WARTA KAMPUS RESMI') }}</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-heading tracking-tight leading-tight">
                {!! __('Berita & Informasi Terkini') !!}
            </h1>
            <p class="text-base sm:text-lg text-body mt-3 leading-relaxed">
                {{ __('Liputan kegiatan akademik, kemitraan rumah sakit pendidikan, pencapaian mahasiswa, serta pengumuman resmi Fakultas Kedokteran Universitas Bumigora.') }}
            </p>
        </div>
    </div>
</div>

<!-- News Filter & Listing Section -->
<section class="py-16 lg:py-24 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search & Filter Bar -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-12">
            <!-- Category Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 w-full md:w-auto">
                <a 
                    href="{{ route('news.index') }}" 
                    class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all whitespace-nowrap {{ !request()->filled('category') || request('category') === 'all' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-sm' : 'bg-surface text-body hover:bg-steel-50 border border-border-subtle' }}"
                >
                    {{ __('Semua Kategori') }}
                </a>
                @foreach($categories as $category)
                    <a 
                        href="{{ route('news.index', ['category' => $category, 'q' => request('q')]) }}" 
                        class="px-4 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all whitespace-nowrap {{ request('category') === $category ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-sm' : 'bg-surface text-body hover:bg-steel-50 border border-border-subtle' }}"
                    >
                        {{ __($category) }}
                    </a>
                @endforeach
            </div>

            <!-- Search Form -->
            <form action="{{ route('news.index') }}" method="GET" class="w-full md:w-80 flex items-center gap-2">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="relative w-full">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ request('q') }}" 
                        placeholder="{{ __('Cari berita & artikel...') }}"
                        class="w-full text-xs rounded-xl border border-border-subtle bg-surface px-3.5 py-2.5 pl-9 text-heading focus:outline-none focus:ring-2 focus:ring-[#2466C1]/30 focus:border-[#2466C1]"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-steel-400">
                        <x-icon name="search" class="w-3.5 h-3.5" />
                    </div>
                </div>
                <button 
                    type="submit" 
                    class="px-3.5 py-2.5 bg-heading hover:bg-[#2466C1] text-white rounded-xl text-xs font-semibold transition-colors shrink-0"
                >
                    {{ __('Cari') }}
                </button>
            </form>
        </div>

        @if(request('q'))
            <div class="mb-6 flex items-center justify-between text-xs text-body bg-surface p-3 rounded-lg border border-border-subtle">
                <span>{{ __('Hasil pencarian untuk kata kunci:') }} <strong class="text-heading">"{{ request('q') }}"</strong></span>
                <a href="{{ route('news.index', ['category' => request('category')]) }}" class="text-[#2466C1] hover:underline font-semibold">
                    {{ __('Hapus Filter Pencarian') }}
                </a>
            </div>
        @endif

        @if($news->isEmpty())
            <x-empty-state 
                title="{{ __('Tidak Ada Berita Ditemukan') }}"
                message="{{ __('Belum ada artikel atau pengumuman yang sesuai dengan kriteria pencarian Anda.') }}"
                icon="book-open"
            />
        @else
            <!-- News Grid (3 cols) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $item)
                    <article class="rounded-2xl border border-border-subtle bg-white overflow-hidden shadow-2xs hover:border-[#2466C1]/40 transition-all flex flex-col justify-between group">
                        <div>
                            <!-- Featured Image -->
                            <div class="h-48 relative overflow-hidden bg-steel-100">
                                @if($item->featured_image)
                                    <img 
                                        src="{{ asset($item->featured_image) }}" 
                                        alt="{{ $item->title }}" 
                                        class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-steel-400">
                                        <x-icon name="book-open" class="w-10 h-10" />
                                    </div>
                                @endif
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[11px] font-bold uppercase tracking-wider bg-white/95 text-heading border border-border-subtle shadow-xs">
                                        {{ __($item->category) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-3">
                                <div class="flex items-center gap-2 text-[11px] text-steel-500">
                                    <x-icon name="calendar" class="w-3.5 h-3.5 shrink-0" />
                                    <span>{{ $item->published_at ? $item->published_at->translatedFormat('d F Y') : '-' }}</span>
                                    <span>•</span>
                                    <span>{{ $item->reading_time }} {{ __('mnt baca') }}</span>
                                </div>

                                <h2 class="text-base font-bold text-heading leading-snug group-hover:text-[#2466C1] transition-colors line-clamp-2">
                                    <a href="{{ route('news.show', $item->slug) }}">
                                        {{ $item->title }}
                                    </a>
                                </h2>

                                <p class="text-xs text-body leading-relaxed line-clamp-3">
                                    {{ $item->excerpt }}
                                </p>
                            </div>
                        </div>

                        <div class="p-6 pt-0">
                            <a 
                                href="{{ route('news.show', $item->slug) }}" 
                                class="text-xs font-semibold bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent group-hover:opacity-80 transition-opacity inline-flex items-center gap-1.5"
                            >
                                <span>{{ __('Baca Selengkapnya') }}</span>
                                <x-icon name="arrow-right" class="w-3.5 h-3.5 text-[#2466C1]" />
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 pt-6 border-t border-border-subtle">
                {{ $news->links() }}
            </div>
        @endif

    </div>
</section>
@endsection
