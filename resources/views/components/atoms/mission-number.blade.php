@props([
    'number' => 1,
    'theme' => 'blue', // 'blue' or 'emerald'
    'active' => false,
])

@php
    $themeClasses = 'bg-gradient-to-br from-[#08244b] to-[#2466c1] text-white shadow-2xs';
@endphp

<div {{ $attributes->merge(['class' => "w-8 h-8 rounded-lg {$themeClasses} flex items-center justify-center font-bold text-xs shrink-0 mt-0.5"]) }}>
    {{ $number }}
</div>
