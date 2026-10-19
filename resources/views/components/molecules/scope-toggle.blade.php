@props([
    'activeVar' => 'activeScope',
])

<div {{ $attributes->merge(['class' => 'flex justify-center mb-10 lg:mb-12']) }}>
    <div class="inline-flex items-center p-1.5 bg-white rounded-2xl border border-border-subtle shadow-2xs gap-1.5">
        <button 
            type="button"
            @click="{{ $activeVar }} = 'fakultas'"
            :class="{{ $activeVar }} === 'fakultas' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-xs font-bold' : 'text-body hover:text-heading hover:bg-slate-50 font-medium'"
            class="px-5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 cursor-pointer flex items-center gap-2"
        >
            <x-icon name="building" class="w-4 h-4" />
            <span>{{ __('Visi & Misi Fakultas') }}</span>
        </button>

        <button 
            type="button"
            @click="{{ $activeVar }} = 'prodi'"
            :class="{{ $activeVar }} === 'prodi' ? 'bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] text-white shadow-xs font-bold' : 'text-body hover:text-heading hover:bg-slate-50 font-medium'"
            class="px-5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 cursor-pointer flex items-center gap-2"
        >
            <x-icon name="graduation-cap" class="w-4 h-4" />
            <span>{{ __('Visi & Misi Program Studi') }}</span>
        </button>
    </div>
</div>
