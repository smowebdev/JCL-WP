@php
    $heading = $services['heading'] ?? '';
    $services_list = $services['list'] ?? [];
@endphp
@if (!empty($services_list))
    <section class="about-services-sec px-page-x pt-section-y-s pb-section-y-l bg-secondary">
        @if ($heading)
            <h2 data-aos="fade-in" class="text-h1 tracking-[0.01em] font-medium mb-100">{!! $heading !!}
            </h2>
        @endif
        <div data-aos="fade-in" class="about-services-list lg:px-22.5 flex flex-wrap justify-center gap-m lg:gap-l">
            @foreach ($services_list as $item)
                @php
                    $icon = $item['icon'] ?? [];
                    $text = $item['text'] ?? '';
                @endphp
                <div
                    class="item w-[calc(50%-(var(--spacing-m)/2))] md:w-[calc((100%-(3*var(--spacing-m)))/4)] lg:w-[calc((100%-(3*var(--spacing-l)))/4)] text-center flex flex-col items-center gap-2.5">
                    @if (!empty($icon['url']))
                        <img class="h-[85px] w-[85px] object-contain lg:h-[110px] lg:w-[110px]" src="{{ $icon['url'] }}"
                            alt="{{ $icon['alt'] ?? 'Services Icon' }}">
                    @endif

                    @if ($text)
                        <p class="text-[16px] leading-[1.4] lg:text-title-m">
                            {!! $text !!}
                        </p>
                    @endif
                </div>
            @endforeach


        </div>
    </section>
@endif
