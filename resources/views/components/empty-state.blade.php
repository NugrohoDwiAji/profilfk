@props([
    'title' => 'Belum Ada Data Tersedia',
    'message' => 'Informasi ini sedang dalam proses pembaruan oleh bagian akademik.',
    'icon' => 'book-open',
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-dashed border-steel-200 bg-surface/60 p-10 text-center flex flex-col items-center justify-center max-w-lg mx-auto']) }}>
    <div class="w-12 h-12 rounded-full bg-steel-100/70 text-steel-600 flex items-center justify-center mb-4">
        <x-icon :name="$icon" class="w-6 h-6" />
    </div>
    <h3 class="text-base font-semibold text-heading mb-1">{{ $title }}</h3>
    <p class="text-sm text-body leading-relaxed">{{ $message }}</p>
</div>
