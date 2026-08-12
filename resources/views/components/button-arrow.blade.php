@props([
    'tag' => 'a',
    'href' => '#',
    'label' => '',
    'target' => '_self',
    'type' => 'button',
])

@if ($tag === 'button')
    <button type="{{ $type }}"
        {{ $attributes->merge([
            'class' => 'inline-flex gap-4 text-center text-title-l leading-[normal] text-primary hover:text-tertiary',
        ]) }}>
        <svg class="animate-arrow-move" width="33" height="27" viewBox="0 0 33 27" fill="none"
            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M30.6438 12.2637L30.6438 13.8765L-1.40998e-07 13.8765L0 12.2637L30.6438 12.2637Z"
                fill="currentColor" />

            <path
                d="M32.2782 13.1151L19.1631 26.2302L18.0226 25.0898L29.9973 13.1151L18.0226 1.14044L19.1631 0L32.2782 13.1151Z"
                fill="currentColor" />
        </svg>

        <span>{{ $label }}</span>
    </button>
@else
    <a href="{{ $href }}" target="{{ $target }}"
        {{ $attributes->merge([
            'class' => 'inline-flex gap-4 text-center text-title-l leading-[normal] text-primary hover:text-tertiary',
        ]) }}>
        <svg class="animate-arrow-move" width="33" height="27" viewBox="0 0 33 27" fill="none"
            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M30.6438 12.2637L30.6438 13.8765L-1.40998e-07 13.8765L0 12.2637L30.6438 12.2637Z"
                fill="currentColor" />

            <path
                d="M32.2782 13.1151L19.1631 26.2302L18.0226 25.0898L29.9973 13.1151L18.0226 1.14044L19.1631 0L32.2782 13.1151Z"
                fill="currentColor" />
        </svg>

        <span>{{ $label }}</span>
    </a>
@endif
