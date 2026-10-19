@props([
    'text' => '',
    'theme' => 'glass', // 'glass' (white/10 on dark card), 'solid'
])

@php
    $classes = match($theme) {
        'solid' => 'bg-white border border-border-subtle text-heading shadow-2xs',
        default => 'bg-white/10 border border-white/15 text-white/95',
    };
@endphp

<span {{ $attributes->merge(['class' => "px-2.5 py-1 rounded-lg text-[11px] font-semibold {$classes}"]) }}>
    {{ $text }}
</span>
