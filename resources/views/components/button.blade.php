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
        // Primary: Soft Royal Purple CTA
        'primary' => 'bg-[#9064C2] hover:bg-[#7d4fad] text-white shadow-sm hover:shadow focus:ring-[#9064C2]/50',
        // Secondary: Steel Blue Accent
        'secondary' => 'bg-[#7D99B0] hover:bg-[#628099] text-white shadow-sm hover:shadow focus:ring-[#7D99B0]/50',
        // Outline: Steel / Border Line
        'outline' => 'bg-white hover:bg-steel-50 text-heading border border-steel-300 hover:border-steel-400 focus:ring-steel-400/50',
        // Ghost: Text only with light hover
        'ghost' => 'text-heading hover:text-[#9064C2] hover:bg-royal-50 focus:ring-royal-300',
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
