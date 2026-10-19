@props([
    'tag' => '',
    'title' => '',
    'subtitle' => '',
    'icon' => 'check',
    'position' => null,
    'animation' => null,
])

@if($position || $animation)
    <div class="relative sm:absolute {{ $position }} z-20 sm:w-56 lg:w-52 xl:w-56 2xl:w-64">
        <div class="{{ $animation }}">
@endif

<div {{ $attributes->merge(['class' => 'bg-white/95 backdrop-blur-md rounded-xl sm:rounded-2xl p-2 sm:p-2.5 xl:p-2 border border-steel-200/90 shadow-md shadow-steel-900/5 hover:shadow-xl hover:border-royal-500/40 transition-all duration-300']) }}>
    <div class="flex items-center gap-2 sm:gap-2.5 xl:gap-3">
        <div class="w-8 h-8 sm:w-9 sm:h-9 xl:w-10 xl:h-10 rounded-xl bg-gradient-to-br from-[#08244b]/15 via-[#2466C1]/20 to-[#08244b]/15 text-[#2466C1] flex items-center justify-center shrink-0 shadow-2xs">
            <x-icon :name="$icon" class="w-4 h-4 sm:w-4 sm:h-4 xl:w-5 xl:h-5 text-[#2466C1]" />
        </div>
        <div class="min-w-0">
            <span class="text-[9px] xl:text-[8px] 2xl:text-[9px] font-bold uppercase tracking-wider text-steel-500 block leading-tight">{{ __((string) $tag) }}</span>
            <span class="text-xs xl:text-[11px] 2xl:text-xs font-bold text-heading block leading-tight mt-0.5">{{ __((string) $title) }}</span>
            <span class="text-[10px] xl:text-[10px] 2xl:text-[10px] text-body block leading-tight mt-0.5 truncate">{{ __((string) $subtitle) }}</span>
        </div>
    </div>
</div>

@if($position || $animation)
        </div>
    </div>
@endif
