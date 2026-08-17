@props([
    'data' => [],
])
@php
    $introduce = $data['introduce'] ?? '';
    $location = $data['location'] ?? '';
    $status = $data['status'] ?? '';
    $year = $data['year'] ?? '';
    $client = $data['client'] ?? '';
    $surface_area = $data['surface_area'] ?? '';
    $theme = $data['theme'] ?? '';
    $service = $data['service'] ?? '';
    $programmes = $data['programmes'] ?? '';
    $in_partnership_with = $data['in_partnership_with'] ?? '';
    $is_show = $data['is_show'];
@endphp
@if ($is_show)
    <section class="py-section-y-l">
        @if ($introduce)
            <div class="px-page-x">
                <div data-aos="fade-in"
                    class="text-title-l text-center leading-[1.23] tracking-[0.01em] lg:tracking-[0.02em] lg:max-w-250 lg:mx-auto">
                    {!! $introduce !!}</div>
            </div>
        @endif
        <div data-aos="fade-in" class="px-page-x pt-80">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-xl gap-y-10 lg:max-w-250 lg:mx-auto">
                @if ($location)
                    <div class="col-span-1 flex flex-col gap-1 items-center">
                        <div class="text-title-m leading-[135%] mb-0">{{ __('Location', 'sage') }}</div>
                        <p class="text-title-l leading-[normal] text-center">{!! $location !!}</p>
                    </div>
                @endif
                @if ($status)
                    <div class="col-span-1 flex flex-col gap-1 items-center">
                        <div class="text-title-m leading-[135%] mb-0">{{ __('Status', 'sage') }}</div>
                        <p class="text-title-l leading-[normal] text-center">{!! $status !!}</p>
                    </div>
                @endif
                @if ($year)
                    <div class="col-span-1 flex flex-col gap-1 items-center">
                        <div class="text-title-m leading-[135%] mb-0">{{ __('Year', 'sage') }}</div>
                        <p class="text-title-l leading-[normal] text-center">{!! $year !!}</p>
                    </div>
                @endif
                @if ($client)
                    <div class="col-span-1 flex flex-col gap-1 items-center">
                        <div class="text-title-m leading-[135%] mb-0">{{ __('Client', 'sage') }}</div>
                        <p class="text-title-l leading-[normal] text-center">{!! $client !!}</p>
                    </div>
                @endif
                @if ($surface_area)
                    <div class="col-span-1 flex flex-col gap-1 items-center">
                        <div class="text-title-m leading-[135%] mb-0">{{ __('Surface Area', 'sage') }}</div>
                        <p class="text-title-l leading-[normal] text-center">{!! $surface_area !!}</p>
                    </div>
                @endif
                @if ($theme)
                    <div class="col-span-1 flex flex-col gap-1 items-center">
                        <div class="text-title-m leading-[135%] mb-0">{{ __('Theme', 'sage') }}</div>
                        <p class="text-title-l leading-[normal] text-center">{!! $theme !!}</p>
                    </div>
                @endif
                @if ($service)
                    <div class="col-span-1 flex flex-col gap-1 items-center">
                        <div class="text-title-m leading-[135%] mb-0">{{ __('Service', 'sage') }}</div>
                        <p class="text-title-l leading-[normal] text-center">{!! $service !!}</p>
                    </div>
                @endif
                @if ($programmes)
                    <div class="col-span-1 flex flex-col gap-1 items-center">
                        <div class="text-title-m leading-[135%] mb-0">{{ __('Programmes', 'sage') }}</div>
                        <p class="text-title-l leading-[normal] text-center">{!! $programmes !!}</p>
                    </div>
                @endif
                @if ($in_partnership_with)
                    <div class="col-span-1 flex flex-col gap-1 items-center">
                        <div class="text-title-m leading-[135%] mb-0">{{ __('In partnership with', 'sage') }}</div>
                        <p class="text-title-l leading-[normal] text-center">{!! $in_partnership_with !!}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
