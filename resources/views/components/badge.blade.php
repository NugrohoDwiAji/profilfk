@props([
    'variant' => 'steel', // steel, royal, neutral, success
    'class' => '',
])

@php
    $variants = [
        'gradient' => 'bg-gradient-to-r from-[#08244b]/10 via-[#2466C1]/15 to-[#08244b]/10 text-heading border border-[#2466C1]/25',
        'steel' => 'bg-steel-50 text-steel-700 border border-steel-200',
        'royal' => 'bg-[#2466C1]/10 text-[#1e56a4] border border-[#2466C1]/20',
        'neutral' => 'bg-surface text-body border border-border-subtle',
        'success' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
    ];
    $selectedVariant = $variants[$variant] ?? $variants['gradient'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase {$selectedVariant} {$class}"]) }}>
    {{ $slot }}
</span>
