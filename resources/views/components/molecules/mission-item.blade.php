@props([
    'number' => 1,
    'title' => '',
    'description' => '',
    'theme' => 'blue',
    'active' => false,
])

<div {{ $attributes->merge(['class' => 'flex items-start gap-4']) }}>
    <x-atoms.mission-number 
        :number="$number" 
        :theme="$theme" 
        :active="$active" 
    />
    <div>
        <h4 class="text-sm font-bold text-heading">{{ __($title) }}</h4>
        <p class="text-xs text-body mt-1 leading-relaxed">
            {{ __($description) }}
        </p>
    </div>
</div>
