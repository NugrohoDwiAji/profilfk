@props([
    'activeVar' => 'prodiTab',
])

<div {{ $attributes->merge(['class' => 'flex justify-center mb-8']) }}>
    <div class="inline-flex items-center p-1 bg-white rounded-xl border border-border-subtle shadow-2xs gap-1 text-xs">
        <button 
            type="button"
            @click="{{ $activeVar }} = 'sarjana'"
            :class="{{ $activeVar }} === 'sarjana' ? 'bg-[#2466C1] text-white font-bold shadow-xs' : 'text-body hover:text-heading hover:bg-slate-50 font-medium'"
            class="px-4 py-2 rounded-lg transition-all cursor-pointer flex items-center gap-1.5"
        >
            <x-icon name="book-open" class="w-3.5 h-3.5" />
            <span>{{ __('Program Sarjana Kedokteran (S.Ked)') }}</span>
        </button>
        <button 
            type="button"
            @click="{{ $activeVar }} = 'profesi'"
            :class="{{ $activeVar }} === 'profesi' ? 'bg-gradient-to-r from-emerald-700 to-teal-700 text-white font-bold shadow-xs' : 'text-body hover:text-heading hover:bg-slate-50 font-medium'"
            class="px-4 py-2 rounded-lg transition-all cursor-pointer flex items-center gap-1.5"
        >
            <x-icon name="stethoscope" class="w-3.5 h-3.5" />
            <span>{{ __('Program Profesi Dokter (dr.)') }}</span>
        </button>
    </div>
</div>
