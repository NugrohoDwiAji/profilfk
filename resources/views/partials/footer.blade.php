<footer class="bg-[#1e2936] text-slate-300 relative border-t border-slate-700/60">
    <!-- Top Gradient Theme Stripe -->
    <div class="h-1 bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 mb-12">
            <!-- Col 1: Identity & Brand (5 cols) -->
            <div class="lg:col-span-5 space-y-5">
                <div class="flex items-center gap-3.5">
                    <img 
                        src="{{ asset('images/logos/logo-ubg-white.png') }}" 
                        alt="{{ __('Logo UBG Putih') }}" 
                        class="h-12 w-auto object-contain"
                    >
                    <div>
                        <p class="text-xs font-semibold tracking-wider uppercase bg-gradient-to-r from-[#6aa7ed] via-white to-[#6aa7ed] bg-clip-text text-transparent">{{ __('Universitas Bumigora') }}</p>
                        <h3 class="text-lg font-bold text-white tracking-tight">{{ __('Fakultas Kedokteran') }}</h3>
                    </div>
                </div>
                <p class="text-sm text-slate-300/90 leading-relaxed max-w-md">
                    {{ __('Institusi pendidikan kedokteran yang berorientasi pada keunggulan akademik, etika kedokteran, penguasaan keterampilan klinis, dan kepedulian terhadap kemaslahatan kesehatan masyarakat di Nusa Tenggara Barat dan Indonesia.') }}
                </p>
                <div class="pt-2 flex items-center gap-3">
                    @if(!empty($settings['facebook_url']))
                        <a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-gradient-to-r hover:from-[#08244b] hover:via-[#2466c1] hover:to-[#08244b] text-slate-300 hover:text-white flex items-center justify-center transition-all duration-200" aria-label="{{ __('Facebook') }}">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings['instagram_url']))
                        <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-gradient-to-r hover:from-[#08244b] hover:via-[#2466c1] hover:to-[#08244b] text-slate-300 hover:text-white flex items-center justify-center transition-all duration-200" aria-label="{{ __('Instagram') }}">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings['youtube_url']))
                        <a href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-gradient-to-r hover:from-[#08244b] hover:via-[#2466c1] hover:to-[#08244b] text-slate-300 hover:text-white flex items-center justify-center transition-all duration-200" aria-label="{{ __('YouTube') }}">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Col 2: Navigation Links (3 cols) -->
            <div class="lg:col-span-3 space-y-4">
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider">{{ __('Navigasi Utama') }}</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('profile') }}" class="hover:text-white transition-colors">{{ __('Profil & Visi Fakultas') }}</a></li>
                    <li><a href="{{ route('curriculum') }}" class="hover:text-white transition-colors">{{ __('Kurikulum & Tahapan Studi') }}</a></li>
                    <li><a href="{{ route('facilities') }}" class="hover:text-white transition-colors">{{ __('Fasilitas & Laboratorium') }}</a></li>
                    <li><a href="{{ route('hospital') }}" class="hover:text-white transition-colors">{{ __('RS Pendidikan & Jejaring') }}</a></li>
                    <li><a href="{{ route('faculty') }}" class="hover:text-white transition-colors">{{ __('Dosen & Tenaga Pengajar') }}</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-white transition-colors">{{ __('Galeri & Dokumentasi') }}</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-white transition-colors">{{ __('Berita & Agenda Terkini') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">{{ __('Kontak & Lokasi Kampus') }}</a></li>
                </ul>
            </div>

            <!-- Col 3: Contact & Campus Info (4 cols) -->
            <div class="lg:col-span-4 space-y-4">
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider">{{ __('Kontak & Lokasi Kampus') }}</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start gap-3">
                        <x-icon name="map-pin" class="w-4 h-4 text-steel-400 shrink-0 mt-0.5" />
                        <span>{{ __($settings['campus_address'] ?? 'Jl. Ismail Marzuki No. 22, Cilinaya, Kota Mataram, NTB 83239') }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <x-icon name="phone" class="w-4 h-4 text-steel-400 shrink-0" />
                        <span>{{ $settings['campus_phone'] ?? '(0370) 633837' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <x-icon name="mail" class="w-4 h-4 text-steel-400 shrink-0" />
                        <span>{{ $settings['campus_email'] ?? 'info@ubg.ac.id' }}</span>
                    </div>
                    <div class="flex items-start gap-3 pt-2">
                        <x-icon name="building" class="w-4 h-4 text-steel-400 shrink-0 mt-0.5" />
                        <div>
                            <span class="font-medium text-white block">{{ __('RS Pendidikan Jejaring Utama:') }}</span>
                            <span class="text-slate-300 text-xs">{{ __('RSUD Praya, Lombok Tengah, Nusa Tenggara Barat') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-8 mt-8 border-t border-slate-700/60 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <p>© {{ date('Y') }} {{ __('Fakultas Kedokteran Universitas Bumigora. Hak cipta dilindungi undang-undang.') }}</p>
            <div class="flex items-center gap-6">
                <span>{{ __('Mataram, Nusa Tenggara Barat') }}</span>
                <span>•</span>
                <a href="{{ $settings['pmb_url'] ?? 'https://pmb.universitasbumigora.ac.id' }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">
                    {{ __('Portal PMB') }}
                </a>
            </div>
        </div>
    </div>
</footer>
