@php
    $address = $settings['campus_address'] ?? 'Jl. Ismail Marzuki No. 22, Cilinaya, Kota Mataram, NTB 83239';
    $phone = $settings['campus_phone'] ?? '(0370) 633837';
    $email = $settings['campus_email'] ?? 'info@ubg.ac.id';
    $facebook = $settings['facebook_url'] ?? 'https://facebook.com/universitasbumigora';
    $instagram = $settings['instagram_url'] ?? 'https://instagram.com/universitasbumigora';
    $youtube = $settings['youtube_url'] ?? 'https://youtube.com/@universitasbumigora';
@endphp
<div class="h-1 bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></div>
<div class="bg-surface border-b border-border-subtle text-xs text-body py-1.5 sm:py-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-3">
            <!-- Left on Desktop: Contact Details -->
            <div class="hidden md:flex items-center gap-6">
                <div class="flex items-center gap-2 text-body/90">
                    <x-icon name="map-pin" class="w-3.5 h-3.5 text-[#2466c1] shrink-0" />
                    <span class="truncate max-w-xs xl:max-w-md">{{ __($address) }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <x-icon name="phone" class="w-3.5 h-3.5 text-[#2466c1] shrink-0" />
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $phone) }}" class="hover:text-heading transition-colors">
                        {{ $phone }}
                    </a>
                </div>
                <div class="hidden lg:flex items-center gap-2">
                    <x-icon name="mail" class="w-3.5 h-3.5 text-[#2466c1] shrink-0" />
                    <a href="mailto:{{ $email }}" class="hover:text-heading transition-colors">
                        {{ $email }}
                    </a>
                </div>
            </div>

            <!-- Left on Mobile: Quick contact / phone -->
            <div class="flex md:hidden items-center gap-2 text-xs">
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $phone) }}" class="flex items-center gap-1.5 text-steel-700 hover:text-heading transition-colors">
                    <x-icon name="phone" class="w-3.5 h-3.5 text-[#2466c1] shrink-0" />
                    <span class="font-medium">{{ $phone }}</span>
                </a>
            </div>

            <!-- Right: Academic Links, Social, and Language Switcher Bar -->
            <div class="flex items-center gap-3 sm:gap-4 ml-auto">
           
                <div class="hidden md:flex items-center gap-2.5 pl-2 border-l border-border-subtle">
                    @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer" class="text-steel-600 hover:text-[#2466C1] transition-colors" aria-label="{{ __('Facebook Universitas Bumigora') }}">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                    @if($instagram)
                        <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer" class="text-steel-600 hover:text-[#2466C1] transition-colors" aria-label="{{ __('Instagram Universitas Bumigora') }}">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    @if($youtube)
                        <a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer" class="text-steel-600 hover:text-[#2466C1] transition-colors" aria-label="{{ __('YouTube Universitas Bumigora') }}">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                </div>

                <div class="hidden sm:block h-3.5 w-px bg-border-subtle"></div>

                <!-- Language Switcher Bar with China, UK, and Indonesia Flags -->
                <x-language-switcher />
            </div>
        </div>
    </div>
</div>
