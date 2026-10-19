@extends('layouts.app')

@section('title', __('Kontak & Lokasi Kampus | Fakultas Kedokteran UBG'))
@section('meta_description', __('Hubungi Sekretariat dan Tim Admisi Fakultas Kedokteran Universitas Bumigora. Informasi alamat kampus, nomor telepon, email, dan formulir konsultasi resmi.'))

@section('content')
<!-- Page Header & Breadcrumbs -->
<div class="bg-surface border-b border-border-subtle py-10 lg:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-body mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-heading transition-colors">{{ __('Beranda') }}</a>
            <span>/</span>
            <span class="text-heading font-semibold">{{ __('Kontak') }}</span>
        </nav>
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b]/20 via-[#2466c1]/20 to-[#08244b]/20 border border-[#2466c1]/30 text-heading mb-3">
                <span class="w-2 h-2 rounded-full bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b]"></span>
                <span>{{ __('LAYANAN KONSULTASI & INFORMASI') }}</span>
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-heading tracking-tight leading-tight">
                {{ __('Hubungi Fakultas Kedokteran') }}
            </h1>
            <p class="text-base sm:text-lg text-body mt-3 leading-relaxed">
                {{ __('Punya pertanyaan mengenai admisi penerimaan mahasiswa baru, kurikulum perkuliahan, atau kerjasama kemitraan? Tim sekretariat kami siap melayani Anda.') }}
            </p>
        </div>
    </div>
</div>

<!-- Main Contact Section: Info + Interactive Form -->
<section class="py-16 lg:py-24 bg-white border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Column: Official Contact Cards (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">
                        {{ __('KANTOR SEKRETARIAT') }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-heading tracking-tight mt-1">
                        {{ __('Informasi Kontak Resmi') }}
                    </h2>
                    <p class="text-xs sm:text-sm text-body mt-2 leading-relaxed">
                        {{ __('Kunjungi kantor fakultas kami atau hubungi saluran komunikasi resmi berikut untuk pelayanan langsung.') }}
                    </p>
                </div>

                <!-- Info Cards -->
                <div class="space-y-4 text-xs sm:text-sm">
                    <!-- Address -->
                    <div class="p-5 rounded-2xl bg-surface border border-border-subtle flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="map-pin" class="w-5 h-5 text-[#2466C1]" />
                        </div>
                        <div>
                            <span class="font-bold text-heading text-sm block">{{ __('Alamat Kampus Utama') }}</span>
                            <span class="text-body leading-relaxed block mt-1">
                                {{ $settings['campus_address'] ?? 'Jl. Ismail Marzuki No. 22, Cilinaya, Kec. Cakranegara, Kota Mataram, Nusa Tenggara Barat 83239' }}
                            </span>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="p-5 rounded-2xl bg-surface border border-border-subtle flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="phone" class="w-5 h-5 text-[#2466C1]" />
                        </div>
                        <div>
                            <span class="font-bold text-heading text-sm block">{{ __('Telepon Kantor') }}</span>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $settings['campus_phone'] ?? '0370633837') }}" class="text-body hover:text-[#2466C1] transition-colors mt-1 block font-medium">
                                {{ $settings['campus_phone'] ?? '(0370) 633837' }}
                            </a>
                            <span class="text-steel-500 text-xs block mt-0.5">{{ __('Senin - Jumat: 08.00 - 16.00 WITA') }}</span>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="p-5 rounded-2xl bg-surface border border-border-subtle flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="mail" class="w-5 h-5 text-[#2466C1]" />
                        </div>
                        <div>
                            <span class="font-bold text-heading text-sm block">{{ __('Email Resmi') }}</span>
                            <a href="mailto:{{ $settings['faculty_email'] ?? ($settings['campus_email'] ?? 'info@ubg.ac.id') }}" class="text-body hover:text-[#2466C1] transition-colors mt-1 block font-medium">
                                {{ $settings['faculty_email'] ?? ($settings['campus_email'] ?? 'info@ubg.ac.id') }}
                            </a>
                            <span class="text-steel-500 text-xs block mt-0.5">{{ __('Dibalas dalam 1x24 jam kerja') }}</span>
                        </div>
                    </div>

                    <!-- RS Jejaring -->
                    <div class="p-5 rounded-2xl bg-surface border border-border-subtle flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#08244b]/15 to-[#2466c1]/20 text-[#2466C1] flex items-center justify-center shrink-0 mt-0.5">
                            <x-icon name="building" class="w-5 h-5 text-[#2466C1]" />
                        </div>
                        <div>
                            <span class="font-bold text-heading text-sm block">{{ __('RS Pendidikan Utama') }}</span>
                            <span class="text-body leading-relaxed block mt-1">
                                {{ __('RSUD Praya, Kabupaten Lombok Tengah, Nusa Tenggara Barat') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="p-5 rounded-2xl border border-dashed border-border-subtle space-y-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-heading block">
                        {{ __('Jam Layanan Pelayanan Admisi & TU:') }}
                    </span>
                    <ul class="text-xs text-body space-y-1">
                        <li class="flex justify-between"><span>{{ __('Senin - Kamis:') }}</span> <strong class="text-heading">{{ __('08.00 - 16.00 WITA') }}</strong></li>
                        <li class="flex justify-between"><span>{{ __('Jumat:') }}</span> <strong class="text-heading">{{ __('08.00 - 16.30 WITA (Istirahat 11.30-13.30)') }}</strong></li>
                        <li class="flex justify-between"><span>{{ __('Sabtu:') }}</span> <strong class="text-heading">{{ __('08.00 - 13.00 WITA') }}</strong></li>
                        <li class="flex justify-between text-red-600"><span>{{ __('Minggu / Hari Libur:') }}</span> <strong>{{ __('Tutup') }}</strong></li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Interactive Form (7 cols) -->
            <div class="lg:col-span-7">
                <div class="rounded-2xl border border-border-subtle bg-white p-6 sm:p-10 shadow-sm relative">
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-start gap-3 shadow-2xs">
                            <x-icon name="check-circle" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                            <div>
                                <span class="font-bold block text-sm">{{ __('Pesan Berhasil Terkirim!') }}</span>
                                <span class="mt-0.5 block leading-relaxed">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="mb-6">
                        <span class="text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">
                            {{ __('FORMULIR PERTANYAAN') }}
                        </span>
                        <h3 class="text-xl sm:text-2xl font-bold text-heading tracking-tight mt-1">
                            {{ __('Kirim Pesan ke Tim Admisi & Sekretariat') }}
                        </h3>
                        <p class="text-xs text-body mt-1">
                            {{ __('Isi formulir di bawah ini dengan lengkap. Tim kami akan menghubungi Anda melalui email atau WhatsApp.') }}
                        </p>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-xs font-semibold text-heading mb-1.5">
                                {{ __('Nama Lengkap') }} <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                placeholder="{{ __('Contoh: Ahmad Fauzi, S.Ked') }}"
                                class="w-full text-xs rounded-xl border {{ $errors->has('name') ? 'border-red-500 bg-red-50/20' : 'border-border-subtle bg-surface' }} px-4 py-3 text-heading focus:outline-none focus:ring-2 focus:ring-[#2466C1]/30 focus:border-[#2466C1]"
                            >
                            @error('name')
                                <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Grid: Email & Telepon -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-xs font-semibold text-heading mb-1.5">
                                    {{ __('Alamat Email') }} <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    placeholder="{{ __('nama@email.com') }}"
                                    class="w-full text-xs rounded-xl border {{ $errors->has('email') ? 'border-red-500 bg-red-50/20' : 'border-border-subtle bg-surface' }} px-4 py-3 text-heading focus:outline-none focus:ring-2 focus:ring-[#2466C1]/30 focus:border-[#2466C1]"
                                >
                                @error('email')
                                    <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-semibold text-heading mb-1.5">
                                    {{ __('Nomor Telepon / WhatsApp') }}
                                </label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone') }}" 
                                    placeholder="{{ __('081234567890') }}"
                                    class="w-full text-xs rounded-xl border {{ $errors->has('phone') ? 'border-red-500 bg-red-50/20' : 'border-border-subtle bg-surface' }} px-4 py-3 text-heading focus:outline-none focus:ring-2 focus:ring-[#2466C1]/30 focus:border-[#2466C1]"
                                >
                                @error('phone')
                                    <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Kategori Pertanyaan -->
                        <div>
                            <label for="category" class="block text-xs font-semibold text-heading mb-1.5">
                                {{ __('Kategori Informasi') }} <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="category" 
                                name="category" 
                                required
                                class="w-full text-xs rounded-xl border {{ $errors->has('category') ? 'border-red-500 bg-red-50/20' : 'border-border-subtle bg-surface' }} px-4 py-3 text-heading focus:outline-none focus:ring-2 focus:ring-[#2466C1]/30 focus:border-[#2466C1]"
                            >
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>{{ __('Pilih kategori pertanyaan...') }}</option>
                                <option value="Informasi Pendaftaran" {{ old('category') === 'Informasi Pendaftaran' ? 'selected' : '' }}>{{ __('Informasi Pendaftaran Mahasiswa Baru') }}</option>
                                <option value="Kurikulum & Akademik" {{ old('category') === 'Kurikulum & Akademik' ? 'selected' : '' }}>{{ __('Kurikulum & Program Akademik') }}</option>
                                <option value="Kemitraan & Kerjasama" {{ old('category') === 'Kemitraan & Kerjasama' ? 'selected' : '' }}>{{ __('Kemitraan & Kerjasama Klinis') }}</option>
                                <option value="Lainnya" {{ old('category') === 'Lainnya' ? 'selected' : '' }}>{{ __('Pertanyaan Umum Lainnya') }}</option>
                            </select>
                            @error('category')
                                <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pesan -->
                        <div>
                            <label for="message" class="block text-xs font-semibold text-heading mb-1.5">
                                {{ __('Isi Pesan / Pertanyaan') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="5" 
                                required 
                                placeholder="{{ __('Tuliskan pertanyaan Anda secara jelas...') }}"
                                class="w-full text-xs rounded-xl border {{ $errors->has('message') ? 'border-red-500 bg-red-50/20' : 'border-border-subtle bg-surface' }} px-4 py-3 text-heading focus:outline-none focus:ring-2 focus:ring-[#2466C1]/30 focus:border-[#2466C1]"
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-[11px] text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <x-button type="submit" variant="primary" size="lg" class="w-full justify-center shadow-xs">
                                <x-icon name="send" class="w-4 h-4" />
                                <span>{{ __('Kirim Pesan Sekarang') }}</span>
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Lokasi Kampus Map & Transport -->
<section class="py-16 bg-surface border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-8">
            <span class="text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-[#08244b] via-[#2466c1] to-[#08244b] bg-clip-text text-transparent">
                {{ __('AKSESIBILITAS KAMPUS') }}
            </span>
            <h3 class="text-2xl font-bold text-heading mt-1">
                {{ __('Panduan Menuju Kampus Universitas Bumigora') }}
            </h3>
            <p class="text-xs sm:text-sm text-body mt-1 leading-relaxed">
                {{ __('Kampus terletak strategis di pusat Kota Mataram, Nusa Tenggara Barat, berdekatan dengan pusat layanan publik, rumah sakit, dan akomodasi mahasiswa.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-5 rounded-2xl bg-white border border-border-subtle shadow-2xs space-y-2">
                <span class="text-xs font-bold uppercase text-[#2466C1] block">{{ __('Dari Bandara Internasional Lombok (BIL)') }}</span>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Dapat ditempuh dalam waktu ±35 menit melalui jalan bypass bandara menggunakan taksi bandara, bus DAMRI rute Mataram, atau transportasi daring.') }}
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-border-subtle shadow-2xs space-y-2">
                <span class="text-xs font-bold uppercase text-[#2466C1] block">{{ __('Dari Pelabuhan Lembar') }}</span>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Dapat ditempuh dalam waktu ±40 menit menuju kawasan Cakranegara/Cilinaya, Kota Mataram dengan rute jalan utama lintas Lombok Barat.') }}
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-border-subtle shadow-2xs space-y-2">
                <span class="text-xs font-bold uppercase text-[#2466C1] block">{{ __('Akses Transportasi Kota') }}</span>
                <p class="text-xs text-body leading-relaxed">
                    {{ __('Dilewati angkutan kota Mataram serta mudah dijangkau layanan transportasi online roda dua dan roda empat selama 24 jam.') }}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
