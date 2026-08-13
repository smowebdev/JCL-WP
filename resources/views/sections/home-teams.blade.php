@php
    $image = $teams['image'] ?? [];
    $years = $teams['years'] ?? '';
    $year_label = $teams['year_label'];
    $desc = $teams['description'];
    $button = $teams['button'];
@endphp
@if ($image || $years)
    <section class="home-team-sec">
        <div class="grid grid-cols-1 lg:grid-cols-[2.5fr_1fr]">
            <div class="aspect-3/2 overflow-hidden block ">
                @if (!empty($image['url']))
                    <img class="w-full h-full object-cover" src="{{ $image['url'] }}" alt="{{ $image['alt'] ?? '' }}">
                @endif
            </div>
            <div class="bg-secondary px-page-x py-80 md:py-25 flex flex-col items-start justify-center gap-xl">
                @if ($years || $year_label)
                    <div>
                        @if ($years)
                            <div class="font-abel text-[100px] leading-[0.8]  tracking-[-0.01em]">
                                <span class="js-counter" data-count="{{ $years }}">0</span>+
                            </div>
                        @endif
                        @if ($year_label)
                            <div class="text-h1 mt-2.5">
                                {!! $year_label !!}
                            </div>
                        @endif

                    </div>
                @endif
                @if ($desc)
                    <div class="font-medium text-p1 leading-[19px]">
                        <p>{!! $desc !!}</p>
                    </div>
                @endif
                @if (!empty($button['url']))
                    <a href="{{ $button['url'] }}"
                        class="inline-flex text-center text-primary text-title-l leading-[normal] gap-s hover:text-tertiary"
                        target="{{ $button['target'] ?: '_self' }}">
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

            </div>
        </div>
    </section>
@endif
