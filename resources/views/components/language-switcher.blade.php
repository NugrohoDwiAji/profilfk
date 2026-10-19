@props([
    'variant' => 'default',
    'class' => '',
])

@php
    $currentLocale = app()->getLocale();
    if (!in_array($currentLocale, ['id', 'en', 'zh'], true)) {
        $currentLocale = 'id';
    }

    $languages = [
        [
            'code' => 'zh',
            'name' => 'China',
            'native' => '中文',
            'label' => 'China',
            'flag' => 'china',
            'title' => 'Bahasa China (中文)',
            'aria' => 'Pilih Bahasa China (Mandarin)',
        ],
        [
            'code' => 'en',
            'name' => 'Inggris',
            'native' => 'English',
            'label' => 'Inggris',
            'flag' => 'uk',
            'title' => 'Bahasa Inggris (English)',
            'aria' => 'Pilih Bahasa Inggris (English)',
        ],
        [
            'code' => 'id',
            'name' => 'Indonesia',
            'native' => 'Bahasa',
            'label' => 'Indonesia',
            'flag' => 'indonesia',
            'title' => 'Bahasa Indonesia',
            'aria' => 'Pilih Bahasa Indonesia',
        ],
    ];
@endphp

@if($variant === 'drawer')
    {{-- Mobile Drawer Variant: Larger Full-Width Option Cards --}}
    <div class="flex flex-col gap-1.5 p-2 bg-slate-50/80 rounded-xl border border-border-subtle {{ $class }}" role="group" aria-label="Pilihan Bahasa">
        <span class="text-[11px] font-semibold text-steel-500 uppercase tracking-wider px-2 pt-1">
            Bahasa / Language
        </span>
        <div class="grid grid-cols-3 gap-1.5">
            @foreach($languages as $lang)
                @php $isActive = $currentLocale === $lang['code']; @endphp
                <a 
                    href="{{ route('locale.switch', $lang['code']) }}"
                    class="flex flex-col items-center justify-center gap-1.5 py-2 px-1 rounded-lg text-xs transition-all duration-150 {{ $isActive ? 'bg-white text-[#2466C1] font-bold shadow-xs ring-1 ring-[#2466C1]/30 border border-slate-200' : 'text-body hover:text-heading hover:bg-white/80' }}"
                    title="{{ $lang['title'] }}"
                    aria-label="{{ $lang['aria'] }}"
                    aria-pressed="{{ $isActive ? 'true' : 'false' }}"
                >
                    <div class="relative">
                        @if($lang['flag'] === 'china')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480" class="w-5 h-3.5 rounded-[2px] shadow-2xs shrink-0 ring-1 ring-black/10 overflow-hidden" aria-hidden="true">
                                <rect width="640" height="480" fill="#DE2910"/>
                                <path fill="#FFDE00" d="M106.7 48.0L121.0 97.7L167.5 97.8L129.9 128.5L144.3 178.2L106.7 147.5L69.0 178.2L83.4 128.5L45.8 97.8L92.3 97.7Z"/>
                                <path fill="#FFDE00" d="M195.0 60.3L205.2 47.2L197.2 32.2L211.5 39.1L221.7 25.9L220.3 43.3L234.6 50.1L219.5 54.0L218.1 71.4L210.1 56.4Z"/>
                                <path fill="#FFDE00" d="M234.9 99.4L248.8 91.7L246.6 74.5L257.4 87.0L271.3 79.3L264.1 94.7L274.9 107.2L259.6 104.2L252.3 119.6L250.2 102.4Z"/>
                                <path fill="#FFDE00" d="M235.5 161.4L251.0 160.8L255.2 144.0L260.6 160.4L276.0 159.8L263.8 170.5L269.2 186.9L256.3 177.2L244.1 187.9L248.3 171.1Z"/>
                                <path fill="#FFDE00" d="M196.7 201.0L211.2 207.2L220.9 193.5L220.1 211.0L234.6 217.1L219.7 221.7L219.0 239.1L210.5 224.6L195.5 229.2L205.2 215.6Z"/>
                            </svg>
                        @elseif($lang['flag'] === 'uk')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480" class="w-5 h-3.5 rounded-[2px] shadow-2xs shrink-0 ring-1 ring-black/10 overflow-hidden" aria-hidden="true">
                                <path fill="#012169" d="M0 0h640v480H0z"/>
                                <path fill="#FFF" d="m75 0 244 181L562 0h78v62L400 241l240 178v61h-80L320 301 81 480H0v-60l239-178L0 64V0z"/>
                                <path fill="#C8102E" d="m424 282 216 159v39l-270-198zm-208-84L0 39V0l270 198zM640 0v10L439 160h-53L640 10zm-640 480v-10l201-150h53L0 470z"/>
                                <path fill="#FFF" d="M240 0h160v480H240zM0 160h640v160H0z"/>
                                <path fill="#C8102E" d="M267 0h106v480H267zM0 187h640v106H0z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480" class="w-5 h-3.5 rounded-[2px] shadow-2xs shrink-0 ring-1 ring-black/10 overflow-hidden" aria-hidden="true">
                                <rect width="640" height="240" fill="#E70011"/>
                                <rect y="240" width="640" height="240" fill="#FFFFFF"/>
                            </svg>
                        @endif
                        @if($isActive)
                            <span class="absolute -top-1 -right-1.5 w-2 h-2 rounded-full bg-[#2466C1]"></span>
                        @endif
                    </div>
                    <span class="text-[11px] font-semibold tracking-wide truncate max-w-full">
                        {{ $lang['name'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
@else
    {{-- Top Bar Segmented Control / Button Bar Variant --}}
    <div 
        class="inline-flex items-center p-0.5 bg-slate-200/70 rounded-full border border-slate-300/60 shadow-2xs {{ $class }}" 
        role="group" 
        aria-label="Pilihan Bahasa"
    >
        @foreach($languages as $lang)
            @php $isActive = $currentLocale === $lang['code']; @endphp
            <a 
                href="{{ route('locale.switch', $lang['code']) }}"
                class="inline-flex items-center gap-1.5 px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-full text-xs transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-[#2466C1]/40 {{ $isActive ? 'bg-white text-[#2466C1] font-bold shadow-xs ring-1 ring-black/5' : 'text-steel-700 hover:text-heading hover:bg-white/60' }}"
                title="{{ $lang['title'] }}"
                aria-label="{{ $lang['aria'] }}"
                aria-pressed="{{ $isActive ? 'true' : 'false' }}"
            >
                @if($lang['flag'] === 'china')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480" class="w-4 h-3 sm:w-4.5 sm:h-3.5 rounded-[2px] shadow-2xs shrink-0 ring-1 ring-black/10 overflow-hidden" aria-hidden="true">
                        <rect width="640" height="480" fill="#DE2910"/>
                        <path fill="#FFDE00" d="M106.7 48.0L121.0 97.7L167.5 97.8L129.9 128.5L144.3 178.2L106.7 147.5L69.0 178.2L83.4 128.5L45.8 97.8L92.3 97.7Z"/>
                        <path fill="#FFDE00" d="M195.0 60.3L205.2 47.2L197.2 32.2L211.5 39.1L221.7 25.9L220.3 43.3L234.6 50.1L219.5 54.0L218.1 71.4L210.1 56.4Z"/>
                        <path fill="#FFDE00" d="M234.9 99.4L248.8 91.7L246.6 74.5L257.4 87.0L271.3 79.3L264.1 94.7L274.9 107.2L259.6 104.2L252.3 119.6L250.2 102.4Z"/>
                        <path fill="#FFDE00" d="M235.5 161.4L251.0 160.8L255.2 144.0L260.6 160.4L276.0 159.8L263.8 170.5L269.2 186.9L256.3 177.2L244.1 187.9L248.3 171.1Z"/>
                        <path fill="#FFDE00" d="M196.7 201.0L211.2 207.2L220.9 193.5L220.1 211.0L234.6 217.1L219.7 221.7L219.0 239.1L210.5 224.6L195.5 229.2L205.2 215.6Z"/>
                    </svg>
                @elseif($lang['flag'] === 'uk')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480" class="w-4 h-3 sm:w-4.5 sm:h-3.5 rounded-[2px] shadow-2xs shrink-0 ring-1 ring-black/10 overflow-hidden" aria-hidden="true">
                        <path fill="#012169" d="M0 0h640v480H0z"/>
                        <path fill="#FFF" d="m75 0 244 181L562 0h78v62L400 241l240 178v61h-80L320 301 81 480H0v-60l239-178L0 64V0z"/>
                        <path fill="#C8102E" d="m424 282 216 159v39l-270-198zm-208-84L0 39V0l270 198zM640 0v10L439 160h-53L640 10zm-640 480v-10l201-150h53L0 470z"/>
                        <path fill="#FFF" d="M240 0h160v480H240zM0 160h640v160H0z"/>
                        <path fill="#C8102E" d="M267 0h106v480H267zM0 187h640v106H0z"/>
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480" class="w-4 h-3 sm:w-4.5 sm:h-3.5 rounded-[2px] shadow-2xs shrink-0 ring-1 ring-black/10 overflow-hidden" aria-hidden="true">
                        <rect width="640" height="240" fill="#E70011"/>
                        <rect y="240" width="640" height="240" fill="#FFFFFF"/>
                    </svg>
                @endif
                <span class="text-[11px] sm:text-xs font-semibold tracking-wide">
                    <span class="lg:hidden">{{ strtoupper($lang['code'] === 'zh' ? 'CN' : $lang['code']) }}</span>
                    <span class="hidden lg:inline">{{ $lang['name'] }}</span>
                </span>
            </a>
        @endforeach
    </div>
@endif
