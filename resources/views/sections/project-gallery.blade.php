@props(['data' => []])
@php
    $gallery = $data['gallery'] ?? [];
@endphp
@if (is_array($gallery) && !empty($gallery))
    <section class="py-section-y-l px-page-x">
        <div
            id="drag-scroll"
            class="grid grid-cols-1 gap-4 select-none sm:grid-cols-2 lg:flex lg:flex-nowrap lg:overflow-x-auto [&::-webkit-scrollbar]:hidden cursor-grab lg:-mr-page-x"
        >
            @foreach ($gallery as $image)
                @if (is_array($image) && !empty($image['url']))
                    <div
                        class="group relative overflow-hidden cursor-pointer project-image lg:min-w-[270px] lg:h-[180px] lg:w-[270px] sm:h-[29.75vw]">
                        <img
                            class="h-full w-full object-cover transition-transform duration-500 ease-out  group-hover:scale-105 aspect-335/223 md:aspect-357/238 lg:aspect-270/180"
                            src="{{ $image['url'] }}"
                            alt="{{ $image['alt'] }}"
                            loading="lazy"
                        >
                        <div
                            class="absolute inset-0 flex items-center justify-center bg-black/45 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            <div
                                class="translate-y-4 text-center text-white transition-transform duration-300 group-hover:translate-y-0">

                                <div
                                    class=" text-center text-white text-title-l leading-[normal] gap-1.5 flex items-center justify-center">
                                    <span class="text-[12px]">{{ __('Zoom in', 'sage') }}</span>
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
                                        ></path>
                                        <path
                                            d="M32.2782 13.1151L19.1631 26.2302L18.0226 25.0898L29.9973 13.1151L18.0226 1.14044L19.1631 0L32.2782 13.1151Z"
                                            fill="currentColor"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endif
