<header 
    :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-xs border-b border-border-subtle py-3' : 'bg-white border-b border-border-subtle py-4'"
    class="sticky top-0 z-40 transition-all duration-200"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <!-- Brand Identity -->
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group focus:outline-none focus:ring-2 focus:ring-[#2466C1]/40 rounded-lg p-1">
                <img 
                    src="{{ asset('images/logos/ubg-blue.png') }}" 
                    alt="{{ __('Logo Universitas Bumigora') }}" 
                    class="h-10 sm:h-12 w-auto object-contain transition-transform group-hover:scale-102"
                >
                <div class="flex flex-col">
                    <span class="text-xs font-bold uppercase tracking-widest bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">{{ __('Universitas Bumigora') }}</span>
                    <span class="text-base sm:text-lg font-bold text-heading leading-tight group-hover:text-[#2466C1] transition-colors">
                        {{ __('Fakultas Kedokteran') }}
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden lg:flex items-center gap-7 text-sm font-medium text-heading">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#2466C1] font-semibold after:scale-x-100' : 'text-heading hover:text-[#2466C1] after:scale-x-0' }} transition-colors py-1 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-gradient-to-r after:from-[#08244b] after:via-[#2466c1] after:to-[#08244b] hover:after:scale-x-100 after:transition-transform">
                    {{ __('Beranda') }}
                </a>
                <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'text-[#2466C1] font-semibold after:scale-x-100' : 'text-heading hover:text-[#2466C1] after:scale-x-0' }} transition-colors py-1 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-gradient-to-r after:from-[#08244b] after:via-[#2466c1] after:to-[#08244b] hover:after:scale-x-100 after:transition-transform">
                    {{ __('Profil') }}
                </a>

                <!-- Desktop Dropdown: Akademik (Kurikulum, Dosen, Fasilitas & RS Pendidikan) on Hover -->
                <div 
                    x-data="{ academicOpen: false }"
                    @mouseenter="academicOpen = true"
                    @mouseleave="academicOpen = false"
                    @keydown.escape.window="academicOpen = false"
                    class="relative py-1"
                >
                    <button 
                        @click="academicOpen = !academicOpen"
                        type="button" 
                        class="flex items-center gap-1.5 transition-colors relative cursor-pointer focus:outline-none {{ (request()->routeIs('curriculum') || request()->routeIs('faculty') || request()->routeIs('facilities') || request()->routeIs('hospital')) ? 'text-[#2466C1] font-semibold after:scale-x-100' : 'text-heading hover:text-[#2466C1] after:scale-x-0' }} after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-gradient-to-r after:from-[#08244b] after:via-[#2466c1] after:to-[#08244b] hover:after:scale-x-100 after:transition-transform"
                        aria-haspopup="true"
                        :aria-expanded="academicOpen.toString()"
                    >
                        <span>{{ __('Akademik') }}</span>
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            class="w-3.5 h-3.5 transition-transform duration-200" 
                            :class="academicOpen ? 'rotate-180 text-[#2466C1]' : 'text-steel-400 group-hover:text-heading'" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu on Hover -->
                    <div 
                        x-show="academicOpen"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1 scale-98"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-1 scale-98"
                        class="absolute top-full left-0 pt-2 z-50 w-64"
                        style="display: none;"
                    >
                        <div class="rounded-2xl bg-white border border-border-subtle shadow-xl shadow-steel-900/10 p-2 ring-1 ring-black/5">
                            <a 
                                href="{{ route('curriculum') }}" 
                                class="flex items-start gap-3 p-2.5 rounded-xl transition-all duration-150 group {{ request()->routeIs('curriculum') ? 'bg-[#2466C1]/10 text-[#2466C1]' : 'hover:bg-slate-50 text-heading' }}"
                            >
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-colors {{ request()->routeIs('curriculum') ? 'bg-[#2466C1] text-white' : 'bg-steel-100 text-[#2466C1] group-hover:bg-[#2466C1]/15' }}">
                                    <x-icon name="book-open" class="w-4 h-4" />
                                </div>
                                <div class="min-w-0">
                                    <span class="text-xs font-bold block leading-tight {{ request()->routeIs('curriculum') ? 'text-[#2466C1]' : 'text-heading group-hover:text-[#2466C1]' }}">{{ __('Kurikulum') }}</span>
                                    <span class="text-[11px] text-body block leading-tight mt-0.5 truncate">{{ __('Struktur Blok & Tahapan Studi') }}</span>
                                </div>
                            </a>

                            <a 
                                href="{{ route('faculty') }}" 
                                class="flex items-start gap-3 p-2.5 rounded-xl transition-all duration-150 group mt-1 {{ request()->routeIs('faculty') ? 'bg-[#2466C1]/10 text-[#2466C1]' : 'hover:bg-slate-50 text-heading' }}"
                            >
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-colors {{ request()->routeIs('faculty') ? 'bg-[#2466C1] text-white' : 'bg-steel-100 text-[#2466C1] group-hover:bg-[#2466C1]/15' }}">
                                    <x-icon name="users" class="w-4 h-4" />
                                </div>
                                <div class="min-w-0">
                                    <span class="text-xs font-bold block leading-tight {{ request()->routeIs('faculty') ? 'text-[#2466C1]' : 'text-heading group-hover:text-[#2466C1]' }}">{{ __('Dosen') }}</span>
                                    <span class="text-[11px] text-body block leading-tight mt-0.5 truncate">{{ __('Profil Staf Pengajar & Klinis') }}</span>
                                </div>
                            </a>

                            <a 
                                href="{{ route('facilities') }}" 
                                class="flex items-start gap-3 p-2.5 rounded-xl transition-all duration-150 group mt-1 {{ request()->routeIs('facilities') ? 'bg-[#2466C1]/10 text-[#2466C1]' : 'hover:bg-slate-50 text-heading' }}"
                            >
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-colors {{ request()->routeIs('facilities') ? 'bg-[#2466C1] text-white' : 'bg-steel-100 text-[#2466C1] group-hover:bg-[#2466C1]/15' }}">
                                    <x-icon name="building" class="w-4 h-4" />
                                </div>
                                <div class="min-w-0">
                                    <span class="text-xs font-bold block leading-tight {{ request()->routeIs('facilities') ? 'text-[#2466C1]' : 'text-heading group-hover:text-[#2466C1]' }}">{{ __('Fasilitas') }}</span>
                                    <span class="text-[11px] text-body block leading-tight mt-0.5 truncate">{{ __('Sarana Medis & Laboratorium') }}</span>
                                </div>
                            </a>

                            <a 
                                href="{{ route('hospital') }}" 
                                class="flex items-start gap-3 p-2.5 rounded-xl transition-all duration-150 group mt-1 {{ request()->routeIs('hospital') ? 'bg-[#2466C1]/10 text-[#2466C1]' : 'hover:bg-slate-50 text-heading' }}"
                            >
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-colors {{ request()->routeIs('hospital') ? 'bg-[#2466C1] text-white' : 'bg-steel-100 text-[#2466C1] group-hover:bg-[#2466C1]/15' }}">
                                    <x-icon name="hospital" class="w-4 h-4" />
                                </div>
                                <div class="min-w-0">
                                    <span class="text-xs font-bold block leading-tight {{ request()->routeIs('hospital') ? 'text-[#2466C1]' : 'text-heading group-hover:text-[#2466C1]' }}">{{ __('RS Pendidikan') }}</span>
                                    <span class="text-[11px] text-body block leading-tight mt-0.5 truncate">{{ __('Wahana Klinis & Jejaring RS') }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.*') ? 'text-[#2466C1] font-semibold after:scale-x-100' : 'text-heading hover:text-[#2466C1] after:scale-x-0' }} transition-colors py-1 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-gradient-to-r after:from-[#08244b] after:via-[#2466c1] after:to-[#08244b] hover:after:scale-x-100 after:transition-transform">
                    {{ __('Berita') }}
                </a>
                <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'text-[#2466C1] font-semibold after:scale-x-100' : 'text-heading hover:text-[#2466C1] after:scale-x-0' }} transition-colors py-1 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-gradient-to-r after:from-[#08244b] after:via-[#2466c1] after:to-[#08244b] hover:after:scale-x-100 after:transition-transform">
                    {{ __('Galeri') }}
                </a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-[#2466C1] font-semibold after:scale-x-100' : 'text-heading hover:text-[#2466C1] after:scale-x-0' }} transition-colors py-1 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-gradient-to-r after:from-[#08244b] after:via-[#2466c1] after:to-[#08244b] hover:after:scale-x-100 after:transition-transform">
                    {{ __('Kontak') }}
                </a>
            </nav>

            <!-- Desktop CTA -->
            <div class="hidden sm:flex items-center gap-3">
                <x-button 
                    href="{{ $settings['pmb_url'] ?? 'https://pmb.universitasbumigora.ac.id' }}" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    variant="primary" 
                    size="sm"
                    class="font-semibold shadow-xs"
                >
                    <x-icon name="graduation-cap" class="w-4 h-4" />
                    <span>{{ __('Informasi Pendaftaran') }}</span>
                </x-button>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex lg:hidden items-center gap-2">
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button" 
                    class="p-2 rounded-lg text-heading hover:bg-surface focus:outline-none focus:ring-2 focus:ring-steel-400"
                    aria-label="{{ __('Buka menu navigasi') }}"
                    :aria-expanded="mobileMenuOpen.toString()"
                >
                    <x-icon x-show="!mobileMenuOpen" name="menu" class="w-6 h-6" />
                    <x-icon x-show="mobileMenuOpen" name="x" class="w-6 h-6" style="display: none;" />
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Nav -->
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden bg-white border-b border-border-subtle shadow-md px-4 pt-3 pb-6 mt-3"
        style="display: none;"
    >
        <nav class="flex flex-col space-y-1.5 text-sm font-medium text-heading">
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}" class="px-3 py-2 rounded-lg {{ request()->routeIs('home') ? 'bg-[#2466C1]/10 text-[#2466C1] font-semibold' : 'hover:bg-gradient-to-r hover:from-[#08244b]/10 hover:via-[#2466C1]/10 hover:to-[#08244b]/10 hover:text-[#2466C1]' }} transition-colors">
                {{ __('Beranda') }}
            </a>
            <a @click="mobileMenuOpen = false" href="{{ route('profile') }}" class="px-3 py-2 rounded-lg {{ request()->routeIs('profile') ? 'bg-[#2466C1]/10 text-[#2466C1] font-semibold' : 'hover:bg-gradient-to-r hover:from-[#08244b]/10 hover:via-[#2466C1]/10 hover:to-[#08244b]/10 hover:text-[#2466C1]' }} transition-colors">
                {{ __('Profil') }}
            </a>

            <!-- Mobile Submenu: Akademik (Accordion) -->
            <div x-data="{ mobileAcademicOpen: {{ (request()->routeIs('curriculum') || request()->routeIs('faculty') || request()->routeIs('facilities') || request()->routeIs('hospital')) ? 'true' : 'false' }} }" class="flex flex-col">
                <button 
                    @click="mobileAcademicOpen = !mobileAcademicOpen"
                    type="button" 
                    class="w-full flex items-center justify-between px-3 py-2 rounded-lg {{ (request()->routeIs('curriculum') || request()->routeIs('faculty') || request()->routeIs('facilities') || request()->routeIs('hospital')) ? 'bg-[#2466C1]/10 text-[#2466C1] font-semibold' : 'hover:bg-slate-50 text-heading' }} transition-colors"
                >
                    <span>{{ __('Akademik') }}</span>
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        class="w-4 h-4 transition-transform duration-200" 
                        :class="mobileAcademicOpen ? 'rotate-180 text-[#2466C1]' : 'text-steel-400'" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m6 9 6 6 6-6"/>
                    </svg>
                </button>

                <div 
                    x-show="mobileAcademicOpen"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-1"
                    class="pl-4 pr-1 py-1 space-y-1"
                >
                    <a 
                        @click="mobileMenuOpen = false" 
                        href="{{ route('curriculum') }}" 
                        class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('curriculum') ? 'bg-[#2466C1]/15 text-[#2466C1] font-semibold' : 'hover:bg-slate-50 text-body hover:text-heading' }} transition-colors"
                    >
                        <x-icon name="book-open" class="w-3.5 h-3.5 text-[#2466C1]" />
                        <span>{{ __('Kurikulum') }}</span>
                    </a>
                    <a 
                        @click="mobileMenuOpen = false" 
                        href="{{ route('faculty') }}" 
                        class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('faculty') ? 'bg-[#2466C1]/15 text-[#2466C1] font-semibold' : 'hover:bg-slate-50 text-body hover:text-heading' }} transition-colors"
                    >
                        <x-icon name="users" class="w-3.5 h-3.5 text-[#2466C1]" />
                        <span>{{ __('Dosen') }}</span>
                    </a>
                    <a 
                        @click="mobileMenuOpen = false" 
                        href="{{ route('facilities') }}" 
                        class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('facilities') ? 'bg-[#2466C1]/15 text-[#2466C1] font-semibold' : 'hover:bg-slate-50 text-body hover:text-heading' }} transition-colors"
                    >
                        <x-icon name="building" class="w-3.5 h-3.5 text-[#2466C1]" />
                        <span>{{ __('Fasilitas') }}</span>
                    </a>
                    <a 
                        @click="mobileMenuOpen = false" 
                        href="{{ route('hospital') }}" 
                        class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('hospital') ? 'bg-[#2466C1]/15 text-[#2466C1] font-semibold' : 'hover:bg-slate-50 text-body hover:text-heading' }} transition-colors"
                    >
                        <x-icon name="hospital" class="w-3.5 h-3.5 text-[#2466C1]" />
                        <span>{{ __('RS Pendidikan') }}</span>
                    </a>
                </div>
            </div>

            <a @click="mobileMenuOpen = false" href="{{ route('news.index') }}" class="px-3 py-2 rounded-lg {{ request()->routeIs('news.*') ? 'bg-[#2466C1]/10 text-[#2466C1] font-semibold' : 'hover:bg-gradient-to-r hover:from-[#08244b]/10 hover:via-[#2466C1]/10 hover:to-[#08244b]/10 hover:text-[#2466C1]' }} transition-colors">
                {{ __('Berita') }}
            </a>
            <a @click="mobileMenuOpen = false" href="{{ route('gallery.index') }}" class="px-3 py-2 rounded-lg {{ request()->routeIs('gallery.*') ? 'bg-[#2466C1]/10 text-[#2466C1] font-semibold' : 'hover:bg-gradient-to-r hover:from-[#08244b]/10 hover:via-[#2466C1]/10 hover:to-[#08244b]/10 hover:text-[#2466C1]' }} transition-colors">
                {{ __('Galeri') }}
            </a>
            <a @click="mobileMenuOpen = false" href="{{ route('contact') }}" class="px-3 py-2 rounded-lg {{ request()->routeIs('contact') ? 'bg-[#2466C1]/10 text-[#2466C1] font-semibold' : 'hover:bg-gradient-to-r hover:from-[#08244b]/10 hover:via-[#2466C1]/10 hover:to-[#08244b]/10 hover:text-[#2466C1]' }} transition-colors">
                {{ __('Kontak') }}
            </a>
            <div class="pt-3 border-t border-border-subtle flex flex-col gap-2">
                <x-button 
                    href="{{ $settings['pmb_url'] ?? 'https://pmb.universitasbumigora.ac.id' }}" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    variant="primary" 
                    size="md"
                    class="w-full justify-center"
                >
                    <x-icon name="graduation-cap" class="w-4 h-4" />
                    <span>{{ __('Informasi Pendaftaran') }}</span>
                </x-button>
            </div>
        </nav>
    </div>
</header>
