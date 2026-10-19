@props([
    'variant' => 'primary', // primary, secondary, outline, ghost
    'size' => 'md', // sm, md, lg
    'href' => null,
    'type' => 'button',
    'class' => '',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer text-center';

    $sizes = [
        'sm' => 'px-3.5 py-2 text-xs gap-1.5',
        'md' => 'px-5 py-2.5 text-sm gap-2',
        'lg' => 'px-6 py-3.5 text-base gap-2.5 font-semibold',
    ];

    $variants = [
        // Primary: Gradient #08244b to #2466c1 center gradient CTA
        'primary' => 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] hover:from-[#051833] hover:via-[#1e56a4] hover:to-[#051833] text-white shadow-sm hover:shadow-md focus:ring-2 focus:ring-[#2466C1]/50 active:scale-[0.99]',
        // Secondary: Elegant border with soft gradient hover
        'secondary' => 'bg-white hover:bg-gradient-to-r hover:from-[#08244b]/10 hover:via-[#2466C1]/10 hover:to-[#08244b]/10 text-heading border border-steel-300 hover:border-[#2466C1]/50 shadow-2xs focus:ring-2 focus:ring-[#2466C1]/40',
        // Gradient explicit variant
        'gradient' => 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] hover:from-[#051833] hover:via-[#1e56a4] hover:to-[#051833] text-white shadow-sm hover:shadow-md focus:ring-2 focus:ring-[#2466C1]/50 active:scale-[0.99]',
        // Outline: Steel / Border Line
        'outline' => 'bg-white hover:bg-steel-50 text-heading border border-steel-300 hover:border-[#2466C1]/60 focus:ring-2 focus:ring-[#2466C1]/30',
        // Ghost: Text only with light hover
        'ghost' => 'text-heading hover:text-[#2466C1] hover:bg-[#2466C1]/10 focus:ring-2 focus:ring-[#2466C1]/30',
    ];

    $classes = $baseClasses . ' ' . ($sizes[$size] ?? $sizes['md']) . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . $class;
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
