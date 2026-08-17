@props([
    'data' => [],
])
@php
    $permalink = $data['permalink'] ?? '';
    $title = $data['title'] ?? '';
    $thumbnail_url = $data['thumbnail_url'] ?? '';
@endphp
<div class="flex flex-col gap-2.5 ">
    <div class="group relative overflow-hidden">
        <a href="{{ $permalink }}">
            <img
                class="aspect-video w-full object-cover"
                src="{{ $thumbnail_url }}"
                alt="{{ $title }}"
                loading="lazy"
            >
            <div
                class="absolute inset-0 flex items-center justify-center bg-black/45 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                <div
                    class="translate-y-4 text-center text-white transition-transform duration-300 group-hover:translate-y-0">

                    <div
                        class=" text-center text-white text-title-l leading-[normal] gap-1.5 flex items-center justify-center">
                        <span class="text-[12px]">{{ __('See More', 'sage') }}</span>
                        <svg
                            class="animate-arrow-move"
                            width="14"
                            height="11.38"
                            viewBox="0 0 33 27"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M30.6438 12.2637L30.6438 13.8765L-1.40998e-07 13.8765L0 12.2637L30.6438 12.2637Z"
                                fill="currentColor"
                            />
                            <path
                                d="M32.2782 13.1151L19.1631 26.2302L18.0226 25.0898L29.9973 13.1151L18.0226 1.14044L19.1631 0L32.2782 13.1151Z"
                                fill="currentColor"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </a>

    </div>
    @if ($title)
        <p class="text-title-m leading-[140%]">{!! $title !!}</p>
    @endif

</div>
