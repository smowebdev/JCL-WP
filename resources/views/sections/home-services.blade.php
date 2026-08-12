@php
    $heading = $services['heading'] ?? '';
    $button = $services['button'] ?? [];
@endphp

@if ($heading)
    <section class="home-services-sec bg-grey px-page-x py-section-y-l">

        <h2 class="mb-xl max-w-[900px] text-h1 font-medium tracking-[0.027em] md:py-[15px] lg:py-0">
            {!! $heading !!}
        </h2>

        @if (!empty($button['url']))
            <a href="{{ $button['url'] }}" target="{{ $button['target'] ?? '_self' }}"
                class="inline-flex gap-4 text-center text-title-l leading-[normal] text-primary hover:text-tertiary">
                <svg class="animate-arrow-move" width="33" height="27" viewBox="0 0 33 27" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M30.6438 12.2637L30.6438 13.8765L-1.40998e-07 13.8765L0 12.2637L30.6438 12.2637Z"
                        fill="currentColor"></path>
                    <path
                        d="M32.2782 13.1151L19.1631 26.2302L18.0226 25.0898L29.9973 13.1151L18.0226 1.14044L19.1631 0L32.2782 13.1151Z"
                        fill="currentColor"></path>
                </svg>

                <span>{{ $button['title'] ?? '' }}</span>
            </a>
        @endif

    </section>
@endif
