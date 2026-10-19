@props([
    'eyebrow' => '',
    'title' => '',
    'vision' => '',
    'highlights' => [],
    'theme' => 'blue',
])

@php
    $bgGradient = match($theme) {
        'emerald' => 'from-emerald-800 to-teal-700 border-emerald-500/30',
        default => 'from-[#08244b] to-[#2466c1] border-[#2466c1]/30',
    };

    $blurBg = match($theme) {
        'emerald' => 'bg-teal-400/20',
        default => 'bg-[#2466c1]/20',
    };
@endphp

<div {{ $attributes->merge(['class' => "lg:col-span-5 rounded-2xl bg-gradient-to-br {$bgGradient} text-white p-8 shadow-md relative overflow-hidden border"]) }}>
    <div class="absolute -right-10 -bottom-10 w-44 h-44 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
    <div class="absolute -left-10 -top-10 w-36 h-36 rounded-full {{ $blurBg }} blur-2xl pointer-events-none"></div>
    <div class="relative z-10 space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-bold uppercase tracking-wider text-white">
            <x-icon name="lightbulb" class="w-3.5 h-3.5 text-amber-300" />
            <span>{{ __($eyebrow) }}</span>
        </div>
        <h3 class="text-xl sm:text-2xl font-bold leading-snug tracking-tight text-white">
            {{ __($title) }}
        </h3>
        <p class="text-sm text-blue-100/95 leading-relaxed pt-2 border-t border-white/15">
            {{ __($vision) }}
        </p>

        @if(!empty($highlights) && is_array($highlights))
            <div class="pt-2 flex flex-wrap gap-2">
                @foreach($highlights as $highlight)
                    <x-atoms.highlight-pill :text="__($highlight)" />
                @endforeach
            </div>
        @endif
    </div>
</div>
