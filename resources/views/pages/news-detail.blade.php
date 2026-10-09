@extends('layouts.app')

@section('title', $article->title . ' | Fakultas Kedokteran UBG')
@section('meta_description', Str::limit(strip_tags($article->excerpt), 150))

@section('content')
<div class="py-10 lg:py-16 bg-surface border-b border-border-subtle">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-body mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-heading transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('home') }}#berita" class="hover:text-heading transition-colors">Berita</a>
            <span>/</span>
            <span class="text-heading font-medium truncate max-w-xs">{{ $article->title }}</span>
        </nav>

        <!-- Article Header -->
        <div class="space-y-4 mb-8">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-steel-100 text-steel-700">
                    {{ $article->category }}
                </span>
                <span class="text-xs text-body">
                    {{ $article->published_at ? $article->published_at->translatedFormat('l, d F Y') : '-' }}
                </span>
                <span>•</span>
                <span class="text-xs text-body">{{ $article->reading_time }} menit baca</span>
            </div>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-heading tracking-tight leading-tight">
                {{ $article->title }}
            </h1>

            <p class="text-base sm:text-lg text-body leading-relaxed border-l-4 border-[#9064C2] pl-4 italic">
                {{ $article->excerpt }}
            </p>
        </div>

        <!-- Featured Image -->
        @if($article->featured_image)
            <div class="rounded-2xl overflow-hidden mb-10 border border-border-subtle bg-white shadow-xs">
                <img 
                    src="{{ asset($article->featured_image) }}" 
                    alt="{{ $article->title }}" 
                    class="w-full max-h-[460px] object-cover"
                >
            </div>
        @endif

        <!-- Article Body -->
        <article class="bg-white rounded-2xl p-6 sm:p-10 border border-border-subtle shadow-2xs space-y-6 text-heading leading-relaxed text-base">
            <div class="prose max-w-none text-body">
                {!! nl2br(e($article->content)) !!}
            </div>

            <div class="pt-6 border-t border-border-subtle flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-body">
                <div>
                    <span class="font-semibold text-heading block">Fakultas Kedokteran Universitas Bumigora</span>
                    <span>Bidang Humas, Komunikasi & Publikasi Akademik</span>
                </div>
                <div class="flex items-center gap-2">
                    <x-button href="{{ route('home') }}#berita" variant="outline" size="sm">
                        <span>Kembali ke Berita</span>
                    </x-button>
                </div>
            </div>
        </article>

        <!-- Related News -->
        @if($relatedNews->isNotEmpty())
            <div class="mt-16 space-y-6">
                <h3 class="text-xl font-bold text-heading">Berita & Informasi Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedNews as $related)
                        <div class="bg-white rounded-xl border border-border-subtle p-5 flex flex-col justify-between hover:border-steel-300 transition-colors">
                            <div class="space-y-2">
                                <span class="text-[11px] font-bold text-[#9064C2] uppercase tracking-wider block">
                                    {{ $related->category }}
                                </span>
                                <h4 class="text-sm font-bold text-heading line-clamp-2">
                                    <a href="{{ route('news.show', $related->slug) }}" class="hover:text-[#9064C2] transition-colors">
                                        {{ $related->title }}
                                    </a>
                                </h4>
                                <p class="text-xs text-body line-clamp-2">
                                    {{ $related->excerpt }}
                                </p>
                            </div>
                            <div class="pt-3 mt-3 border-t border-border-subtle text-[11px]">
                                <a href="{{ route('news.show', $related->slug) }}" class="font-semibold text-[#7D99B0] hover:text-[#9064C2]">
                                    Baca Artikel →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
