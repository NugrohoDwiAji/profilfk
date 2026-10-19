@props([
    'eyebrow' => null,
    'title' => '',
    'subtitle' => null,
    'align' => 'center', // center, left
    'class' => '',
])

@php
    $alignment = $align === 'left' ? 'text-left items-start' : 'text-center items-center mx-auto';
    $eyebrowText = $eyebrow ? __((string) $eyebrow) : null;
    $titleText = __((string) $title);
    $subtitleText = $subtitle ? __((string) $subtitle) : null;
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col {$alignment} max-w-3xl mb-12 lg:mb-16 {$class}"]) }}>
    @if($eyebrowText)
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase text-heading bg-gradient-to-r from-[#08244b]/10 via-[#2466C1]/15 to-[#08244b]/10 border border-[#2466C1]/25 shadow-2xs mb-3">
            <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466C1] to-[#08244b]"></span>
            <span>{!! $eyebrowText !!}</span>
        </div>
    @endif

    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-heading text-balance leading-tight">
        {!! $titleText !!}
    </h2>

    @if($subtitleText)
        <p class="mt-4 text-base sm:text-lg text-body leading-relaxed text-balance">
            {!! $subtitleText !!}
        </p>
    @endif
</div>
