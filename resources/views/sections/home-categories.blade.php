<section class="project-cate-sec px-5 md:px-8.75 lg:px-80 py-section-y-l">

    @if (!empty($categories['items']))

        <div
            class="project-cate-list max-w-7xl mx-auto grid md:grid-cols-2 lg:grid-cols-3 lg:gap-x-l gap-y-14 md:gap-y-12 md:p-xxl">

            @foreach ($categories['items'] as $index => $category)
                @php
                    $image = $category['image'] ?? [];
                    $imageUrl = $image['url'] ?? '';
                    $imageAlt = $image['alt'] ?? $category['title'];
                    $title = $category['title'] ?? '';
                    $link = $category['link'] ?? '#';

                    $layouts = [
                        0 => [
                            'item' => 'order-1',
                            'wrapper' => 'lg:min-h-[255px] flex items-start lg:items-end justify-center lg:justify-end',
                            'image' => 'w-[250px] h-[157px] md:w-[280px] md:h-[176px] lg:w-[300px] lg:h-[200px]',
                            'label' => 'absolute z-1 -left-10 -top-5.5 md:-top-6 md:-left-10 lg:-top-5.5 lg:-left-10',
                        ],
                        1 => [
                            'item' => 'order-3 lg:order-2',
                            'wrapper' => 'lg:min-h-[255px] flex items-center justify-center',
                            'image' => 'w-[230px] h-[230px] lg:w-[255px] lg:h-[255px]',
                            'label' => 'absolute z-1 -left-10 -top-5.5 md:-top-6 lg:-top-5.5 lg:-left-10',
                        ],
                        2 => [
                            'item' => 'order-4 lg:order-3',
                            'wrapper' => 'lg:min-h-[255px] flex items-center justify-center lg:justify-start',
                            'image' => 'w-[250px] h-[167px] lg:w-[330px] lg:h-[220px]',
                            'label' => 'absolute z-1 -bottom-5.5 -left-10',
                        ],
                        3 => [
                            'item' => 'order-2 lg:order-4',
                            'wrapper' => 'lg:min-h-[270px] flex items-center justify-center',
                            'image' => 'w-[180px] h-[180px] lg:w-[200px] lg:h-[200px]',
                            'label' => 'absolute z-1 -bottom-5.5 lg:-bottom-5.5 -right-10.5 lg:-right-10.5',
                        ],
                        4 => [
                            'item' => 'order-6 md:order-5',
                            'wrapper' => 'lg:min-h-[270px] flex items-center justify-center',
                            'image' => 'w-[250px] h-[187px] lg:w-[313px] lg:h-[176px]',
                            'label' => 'absolute z-1 -top-6 lg:-top-5.5 -left-10',
                        ],
                        5 => [
                            'item' => 'order-5 md:order-6',
                            'wrapper' => 'min-h-[270px] flex items-center justify-center',
                            'image' => 'w-[180px] h-[270px]',
                            'label' => 'absolute z-1 -bottom-5 -right-11 lg:-bottom-5.5 lg:-right-11',
                        ],
                    ];

                    $layout = $layouts[$index] ?? $layouts[0];
                @endphp

                @if ($imageUrl)
                    <a href="{{ $link }}"
                        class="cate-item group relative px-4 lg:px-0 {{ $layout['item'] }} {{ $layout['wrapper'] }}">

                        <div class="{{ $layout['image'] }} relative">

                            <div
                                class="absolute inset-0 bg-black/57 pointer-events-none transition-default opacity-0 group-hover:opacity-100">
                            </div>

                            <img class="w-full h-full object-cover" src="{{ $imageUrl }}" alt="{{ $imageAlt }}">

                            <div
                                class="absolute text-[12px] leading-[normal] font-light text-white inline-flex items-center justify-center w-full gap-1.5 top-1/2 -translate-y-1/2 transition-default opacity-0 group-hover:opacity-100">
                                <span>See More</span>

                                <img class="animate-arrow-move"
                                    src="{{ Vite::asset('resources/images/arrow-right-white.svg') }}" alt="">
                            </div>

                            <div
                                class="{{ $layout['label'] }} inline-block text-title-l leading-[normal] py-2 px-5.5 border border-primary bg-white whitespace-nowrap">
                                {{ $title }}
                            </div>

                        </div>

                    </a>
                @endif
            @endforeach

        </div>

    @endif
    @if (!empty($categories['button_view_all']['url']))
        <div class="mt-xxl text-center md:mt-l">
            <x-button-arrow :href="$categories['button_view_all']['url']" :label="$categories['button_view_all']['title']" :target="$categories['button_view_all']['target'] ?: '_self'" />
        </div>
    @endif



</section>
