@props([
    'tag' => 'a',
    'href' => '#',
    'target' => '_self',
    'title' => '',
    'variant' => 'primary',
])

@php
    $variantClasses = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'default' => 'btn-default',
    ];

    $variantClass = $variantClasses[$variant] ?? $variantClasses['primary'];

    $classes = $attributes->get('class', '');

    $attributes = $attributes->merge([
        'class' => "btn {$variantClass} {$classes}",
    ]);
@endphp

@if ($tag === 'button')
    <button type="button" {{ $attributes }}>
        {{ $title }}
    </button>
@else
    <a href="{{ $href }}" target="{{ $target }}" {{ $attributes }}>
        {{ $title }}
    </a>
@endif
