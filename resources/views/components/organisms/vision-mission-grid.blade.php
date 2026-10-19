@props([
    'record' => null,
    'theme' => 'blue',
])

@php
    $theme = $record->theme_color ?? $theme ?? 'blue';
    $eyebrow = (string) ($record->eyebrow ?? 'VISI');
    $visionTitle = (string) ($record->vision_title ?? '');
    $vision = (string) ($record->vision ?? '');
    $highlights = $record->highlights ?? [];
    $missionTitle = (string) ($record->mission_title ?? 'MISI STRATEGIS');
    $missions = $record->missions ?? [];

    $badgeTheme = match($theme) {
        'emerald' => 'bg-emerald-600/10 text-emerald-700',
        default => 'bg-[#2466C1]/10 text-[#2466C1]',
    };

    $iconTheme = match($theme) {
        'emerald' => 'text-emerald-600',
        default => 'text-[#2466C1]',
    };
@endphp

<div {{ $attributes->merge(['class' => 'grid grid-cols-1 lg:grid-cols-12 gap-8 items-start']) }}>
    <!-- Left: Vision Card Molecule (5 cols) -->
    <x-molecules.vision-card 
        :eyebrow="$eyebrow"
        :title="$visionTitle"
        :vision="$vision"
        :highlights="$highlights"
        :theme="$theme"
    />

    <!-- Right: Mission List Card (7 cols) -->
    <div class="lg:col-span-7 rounded-2xl bg-white border border-border-subtle p-8 shadow-2xs space-y-6">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full {{ $badgeTheme }} text-xs font-bold uppercase tracking-wider">
            <x-icon name="target" class="w-3.5 h-3.5 {{ $iconTheme }}" />
            <span>{{ __($missionTitle) }}</span>
        </div>

        <div class="space-y-4">
            @foreach($missions as $index => $item)
                <x-molecules.mission-item 
                    :number="$index + 1"
                    :title="$item['title'] ?? ''"
                    :description="$item['description'] ?? ''"
                    :theme="$theme"
                />
            @endforeach
        </div>
    </div>
</div>
