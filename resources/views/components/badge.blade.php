@props([
    'variant' => 'steel', // steel, royal, neutral, success
    'class' => '',
])

@php
    $variants = [
        'steel' => 'bg-steel-50 text-steel-700 border border-steel-200',
        'royal' => 'bg-royal-50 text-royal-700 border border-royal-200',
        'neutral' => 'bg-surface text-body border border-border-subtle',
        'success' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
    ];
    $selectedVariant = $variants[$variant] ?? $variants['steel'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase {$selectedVariant} {$class}"]) }}>
    {{ $slot }}
</span>
