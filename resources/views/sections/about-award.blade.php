@php
    $heading = $awards['heading'] ?? '';
    $awardList = $awards['list'] ?? [];
@endphp
@if ($heading || !empty($awardList))
    <section class="about-award-sec bg-grey px-page-x pt-section-y-s pb-section-y-l">

        @if ($heading)
            <h2 data-aos="fade-in" class="mb-100 text-h1 font-medium tracking-[0.01em]">
                {!! $heading !!}
            </h2>
        @endif

        @if (!empty($awardList))
            <div class="flex flex-col gap-xxxl lg:px-22.5">

                @foreach ($awardList as $awardYear)
                    @php
                        $year = $awardYear['years'] ?? '';
                        $items = $awardYear['items'] ?? [];
                    @endphp

                    @if ($year && !empty($items))
                        <div data-aos="fade-in" class="grid grid-cols-1 gap-s lg:grid-cols-[100px_1fr]">

                            <div>
                                <span class="inline-block text-title-l leading-[normal] text-tertiary">
                                    {{ $year }}
                                </span>
                            </div>

                            <div class="flex flex-col gap-m">

                                @foreach ($items as $item)
                                    @php
                                        $title = $item['title'] ?? '';
                                        $project = $item['project'] ?? '';
                                        $link = $item['link'] ?? '';
                                    @endphp

                                    @if ($title || $project)
                                        <div class="grid grid-cols-1 gap-2.5 lg:grid-cols-[1fr_200px] lg:gap-7">

                                            @if ($title)
                                                <p class="text-title-l leading-6 lg:leading-[27px] font-medium">
                                                    {!! $title !!}
                                                </p>
                                            @endif

                                            @if ($project && !empty($link))
                                                <a href="{{ $link }}"
                                                    class="inline-block text-[16px] leading-[19px] hover:text-tertiary hover:bg-grey">
                                                    {!! $project !!}
                                                </a>
                                            @else
                                                <span class="inline-block text-[16px] leading-[19px]">
                                                    {!! $project !!}
                                                </span>
                                            @endif

                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        @endif

    </section>
@endif
