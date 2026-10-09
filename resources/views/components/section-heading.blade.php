@props([
    'eyebrow' => null,
    'title' => '',
    'subtitle' => null,
    'align' => 'center', // center, left
    'class' => '',
])

@php
    $alignment = $align === 'left' ? 'text-left items-start' : 'text-center items-center mx-auto';
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col {$alignment} max-w-3xl mb-12 lg:mb-16 {$class}"]) }}>
    @if($eyebrow)
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold tracking-wider uppercase text-steel-700 bg-steel-50 border border-steel-200/80 mb-3">
            <span class="w-1.5 h-1.5 rounded-full bg-[#9064C2]"></span>
            {{ $eyebrow }}
        </div>
    @endif

    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-heading text-balance leading-tight">
        {{ $title }}
    </h2>

    @if($subtitle)
        <p class="mt-4 text-base sm:text-lg text-body leading-relaxed text-balance">
            {{ $subtitle }}
        </p>
    @endif
</div>
