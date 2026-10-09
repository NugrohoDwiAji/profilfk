<header 
    :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-xs border-b border-border-subtle py-3' : 'bg-white border-b border-border-subtle py-4'"
    class="sticky top-0 z-40 transition-all duration-200"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <!-- Brand Identity -->
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group focus:outline-none focus:ring-2 focus:ring-steel-400 rounded-lg p-1">
                <img 
                    src="{{ asset('images/logos/ubg-blue.png') }}" 
                    alt="Logo Universitas Bumigora" 
                    class="h-10 sm:h-12 w-auto object-contain transition-transform group-hover:scale-102"
                >
                <div class="flex flex-col">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#7D99B0]">Universitas Bumigora</span>
                    <span class="text-base sm:text-lg font-bold text-heading leading-tight group-hover:text-steel-600 transition-colors">
                        Fakultas Kedokteran
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden xl:flex items-center gap-7 text-sm font-medium text-heading">
                <a href="{{ route('home') }}#hero" class="text-heading hover:text-[#9064C2] transition-colors py-1 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-[#9064C2] after:scale-x-0 hover:after:scale-x-100 after:transition-transform">
                    Beranda
                </a>
                <a href="{{ route('home') }}#tentang" class="text-heading hover:text-[#9064C2] transition-colors py-1">
                    Profil Fakultas
                </a>
                <a href="{{ route('home') }}#pendidikan" class="text-heading hover:text-[#9064C2] transition-colors py-1">
                    Pendidikan
                </a>
                <a href="{{ route('home') }}#lingkungan" class="text-heading hover:text-[#9064C2] transition-colors py-1">
                    Fasilitas
                </a>
                <a href="{{ route('home') }}#dosen" class="text-heading hover:text-[#9064C2] transition-colors py-1">
                    Dosen
                </a>
                <a href="{{ route('home') }}#riset" class="text-heading hover:text-[#9064C2] transition-colors py-1">
                    Riset & Pengabdian
                </a>
                <a href="{{ route('home') }}#berita" class="text-heading hover:text-[#9064C2] transition-colors py-1">
                    Berita
                </a>
                <a href="{{ route('home') }}#kontak" class="text-heading hover:text-[#9064C2] transition-colors py-1">
                    Kontak
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
                    <span>Informasi Pendaftaran</span>
                </x-button>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex xl:hidden items-center gap-2">
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button" 
                    class="p-2 rounded-lg text-heading hover:bg-surface focus:outline-none focus:ring-2 focus:ring-steel-400"
                    aria-label="Buka menu navigasi"
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
        class="xl:hidden bg-white border-b border-border-subtle shadow-md px-4 pt-3 pb-6 mt-3"
        style="display: none;"
    >
        <nav class="flex flex-col space-y-2 text-sm font-medium text-heading">
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#hero" class="px-3 py-2 rounded-lg hover:bg-surface hover:text-[#9064C2] transition-colors">
                Beranda
            </a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#tentang" class="px-3 py-2 rounded-lg hover:bg-surface hover:text-[#9064C2] transition-colors">
                Profil Fakultas
            </a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#pendidikan" class="px-3 py-2 rounded-lg hover:bg-surface hover:text-[#9064C2] transition-colors">
                Pendidikan
            </a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#lingkungan" class="px-3 py-2 rounded-lg hover:bg-surface hover:text-[#9064C2] transition-colors">
                Fasilitas & Lingkungan Belajar
            </a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#dosen" class="px-3 py-2 rounded-lg hover:bg-surface hover:text-[#9064C2] transition-colors">
                Dosen & Tenaga Pendidik
            </a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#riset" class="px-3 py-2 rounded-lg hover:bg-surface hover:text-[#9064C2] transition-colors">
                Riset & Pengabdian Masyarakat
            </a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#berita" class="px-3 py-2 rounded-lg hover:bg-surface hover:text-[#9064C2] transition-colors">
                Berita & Agenda
            </a>
            <a @click="mobileMenuOpen = false" href="{{ route('home') }}#kontak" class="px-3 py-2 rounded-lg hover:bg-surface hover:text-[#9064C2] transition-colors">
                Kontak & Layanan
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
                    <span>Informasi Pendaftaran</span>
                </x-button>
            </div>
        </nav>
    </div>
</header>
