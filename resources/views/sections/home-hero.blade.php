@if ($hero['items'])
    <section class="home-hero relative overflow-hidden text-white pb-[46px]">
        <div
            class="timeline__nav absolute right-m bottom-[66px] md:bottom-[76px] z-50 flex lg:hidden flex-col items-center gap-6">

            <button type="button"
                class="timeline__btn timeline__btn--prev flex items-center justify-center cursor-pointer"
                aria-label="Previous section">
                <img class="w-6" src="{{ Vite::asset('resources/images/arrow-hero.svg') }}" alt="">
            </button>

            <button type="button"
                class="timeline__btn timeline__btn--next flex items-center justify-center cursor-pointer"
                aria-label="Next section">
                <img class="w-6 " src="{{ Vite::asset('resources/images/arrow-hero-down.svg') }}" alt="">
            </button>

        </div>

        <div
            class="relative home-hero-inner overflow-hidden
                h-[calc(100dvh-94px)]
                md:h-[calc(100dvh-104px)]
                lg:h-[calc(100dvh-110px)]">

            <div class="relative hero-list z-20">

                <div
                    class="timeline absolute top-0 left-0 md:left-[31px] w-1/2 md:w-[170px] h-full pointer-events-none z-30">

                    <div class="timeline__line absolute top-0 right-0 w-px h-full bg-grey"></div>

                    <div class="timeline__sticky absolute top-0 left-0 w-full">
                        <div
                            class="timeline__year absolute top-6 left-3.5 md:left-0 font-abel text-[160px] leading-[0.75] tracking-[-0.03em] will-change-transform">
                            {{ $hero['timeline_prefix'] }}
                        </div>
                    </div>

                </div>


                @foreach ($hero['items'] as $index => $item)
                    @php
                        $background = $item['background'] ?? null;
                        $year = $item['year'] ?? '';
                        $description = $item['description'] ?? '';
                        $heading = $item['heading'] ?? '';
                        $button = $item['button'] ?? null;
                    @endphp

                    <div
                        class="hero-item relative overflow-hidden
                            h-[calc(100dvh-94px)]
                            md:h-[calc(100dvh-104px)]
                            lg:h-[calc(100dvh-110px)]">

                        @if ($background)
                            <div class="hero-bg absolute inset-0 z-1">
                                <img class="w-full h-full object-cover" src="{{ $background['url'] }}"
                                    alt="{{ $background['alt'] }}">
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-black/50 z-1"></div>

                        <div class="absolute left-0 w-full h-px bg-grey top-19.5 z-1"></div>

                        <div
                            class="hero-square absolute w-4.5 h-4.5 border border-grey z-1 top-17.5 left-1/2 -translate-x-1/2 md:translate-none md:left-48">
                        </div>


                        <div class="pl-m pr-m md:pr-0 md:pl-[217px] flex flex-col justify-between relative z-10 h-full">

                            <div class="relative">

                                <div
                                    class="hero-side__floating absolute top-6 left-auto md:left-0 right-0 md:right-auto flex flex-col md:flex-row items-start md:items-end gap-s md:gap-8 will-change-transform">

                                    <div class="font-abel text-[160px] leading-[0.75] tracking-[-0.03em]">
                                        {{ $year }}
                                    </div>

                                    @if ($description)
                                        <div
                                            class="text-[12px] lg:text-[18px] leading-[1.4] max-w-[143px] md:max-w-[230px]">
                                            {!! $description !!}
                                        </div>
                                    @endif

                                </div>

                            </div>

                            <div
                                class="hero-main pb-12.5 md:pr-12.5 flex flex-col lg:flex-row justify-between gap-7.5 items-start lg:items-end">

                                @if ($heading)
                                    @if ($index === 0)
                                        <h1
                                            class="hero-heading font-medium text-[25px] md:text-[32px] lg:text-[50px] tracking-[0.027em] max-w-161">
                                            {!! $heading !!}
                                        </h1>
                                    @else
                                        <h2
                                            class="hero-heading font-medium text-[25px] md:text-[32px] lg:text-[50px] tracking-[0.027em] max-w-161">
                                            {!! $heading !!}
                                        </h2>
                                    @endif
                                @endif


                                @if ($button)
                                    <a href="{{ $button['url'] ?? '#' }}" target="{{ $button['target'] ?? '_self' }}"
                                        class="btn btn-secondary shrink-0 text-[14px] md:text-title-l px-[11px] py-[5px] md:px-[19px] md:py-[9.5px]">
                                        {{ $button['title'] ?? 'See More' }}
                                    </a>
                                @endif

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        </div>


        <div class="home-hero__scroll bg-white w-full absolute bottom-0 left-0 z-40">

            <div class="hero-scroll-btn cursor-pointer px-m py-s flex items-center justify-center">

                <img class="w-auto h-3.5 object-contain" src="{{ Vite::asset('resources/images/arrow-down.svg') }}"
                    alt="">

            </div>

        </div>

    </section>
@endif
