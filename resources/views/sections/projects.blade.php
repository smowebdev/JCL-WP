<section
    x-data="projects"
    class="pb-section-y-l"
    :class="loading ? 'opacity-50 pointer-events-none' : ''"
>
    <div class="py-section-y-s px-page-x flex gap-2 lg:gap-s justify-center flex-wrap group">
        @foreach ($genres as $genre)
            <a
                href="{{ $genre->url }}"
                data-id="{{ $genre->term_id }}"
                class="btn-toggle btn shrink-0 py-1.5 px-3 lg:py-2.5 lg:px-5 text-[14px] lg:text-title-l font-medium leading-[normal] btn-default {{ $genre->is_active ? 'bg-tertiary text-white border-tertiary' : '' }}"
                x-init="{{ $genre->is_active ? 'genres.push(' . $genre->term_id . ')' : '' }}"
                x-on:click="updateTax({{ $genre->term_id }}, 'genres')"
            >
                {!! $genre->name !!}
            </a>
        @endforeach
    </div>
    <div class="border-t-2 border-primary/10 md:hidden"></div>
    <div
        class="grid grid-cols-1 md:grid-cols-[77fr_250fr] lg:grid-cols-[8fr_25fr] gap-[20px] md:gap-5 px-page-x pt-5 md:pt-0">
        <div class=" flex flex-col gap-default md:gap-12">
            @if (!empty($services))
                <div
                    x-data="{ opened: false }"
                    :class="opened ? 'gap-3' : ''"
                    class="flex flex-col md:gap-5 sector-item"
                >
                    <div
                        x-on:click="opened=!opened"
                        class="flex cursor-pointer items-center md:cursor-default gap-2.5"
                    >
                        <p class="text-title-l leading-[normal]">{{ __('Type of service', 'sage') }}</p>
                        <img
                            class="sector-icon w-[14.85px] transition-transform duration-300 md:hidden"
                            src="{!! Vite::asset('resources/images/arrow-down.svg') !!}"
                            alt="arrow down"
                        >
                    </div>
                    <div
                        x-show="opened"
                        x-collapse.min.0px
                        class="sector-content md:grid-rows-[1fr] md:opacity-100 grid transition duration-300 md:grid! md:h-auto!"
                    >
                        <div class="flex flex-col gap-2">
                            @foreach ($services as $service_key => $service)
                                @php
                                    $attrs = [
                                        'x-on:click' => 'updateTax(' . $service->term_id . ", 'services')",
                                        'x-init' => $service->is_active
                                            ? 'services.push(' . $service->term_id . ')'
                                            : '',
                                    ];
                                @endphp
                                <x-checkbox
                                    data-tab="tab{{ $service_key }}"
                                    :name="$service->name"
                                    is_active="{{ $service->is_active }}"
                                    :attrs="$attrs"
                                />
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($sectors))
                <div
                    x-data="{ opened: false }"
                    :class="opened ? 'gap-3' : ''"
                    class="flex flex-col md:gap-5 sector-item"
                >
                    <div
                        x-on:click="opened=!opened"
                        class="flex cursor-pointer items-center md:cursor-default gap-2.5"
                    >
                        <p class="text-title-l leading-[normal]">{{ __('Sector', 'sage') }}</p>
                        <img
                            class="sector-icon w-[14.85px] transition-transform duration-300 md:hidden"
                            src="{!! Vite::asset('resources/images/arrow-down.svg') !!}"
                            alt="Arrow down"
                        >
                    </div>
                    <div
                        x-show="opened"
                        x-collapse.min.0px
                        class="sector-content md:grid-rows-[1fr] md:opacity-100 grid transition duration-300 md:grid! md:h-auto!"
                    >
                        <div class="flex flex-col gap-2">
                            @foreach ($sectors as $sector_key => $sector)
                                @php
                                    $attrs = [
                                        'x-on:click' => 'updateTax(' . $sector->term_id . ", 'sectors')",
                                        'x-init' => $sector->is_active ? 'sectors.push(' . $sector->term_id . ')' : '',
                                    ];
                                @endphp
                                <x-checkbox
                                    data-tab="tab{{ $sector_key }}"
                                    :name="$sector->name"
                                    :attrs="$attrs"
                                />
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div
            id="projects-grid"
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-y-[30px]"
        >
            @if ($projects->have_posts())
                @while ($projects->have_posts())
                    @php
                        $projects->the_post();
                        $project_id = get_the_ID();
                        $project_data = \App\project_card_data($project_id);
                    @endphp
                    <x-card-project :data="$project_data" />
                @endwhile
                @php
                    wp_reset_postdata();
                @endphp
            @endif
        </div>
    </div>
</section>
