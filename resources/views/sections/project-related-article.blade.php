@props(['data' => []])
@php
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $link = $data['link'] ?? [];
    $image = $data['image'] ?? [];
    $is_show =
        (is_array($image) && !empty($image['url'])) ||
        (is_array($link) && !empty($link['url'])) ||
        !empty($title) ||
        !empty($description);
@endphp
@if ($is_show)
    <section class="pb-section-y-l px-page-x">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-xl">
            <div
                class="flex flex-col justify-between lg:justify-start items-start gap-[30px] lg:gap-[82px] lg:col-span-2">
                <h2 class="text-h1 tracking-[0.027em] leading-[1]">{!! __('Related <br>Article', 'sage') !!}</h2>
                <div class="flex flex-col gap-4">
                    @if ($title)
                        <h3 class="text-p1 leading-[normal] font-medium">{!! $title !!}</h3>
                    @endif
                    @if ($description)
                        <div class="text-[18px] tracking-[-0.02em] leading-[1.2] font-light">
                            {!! $description !!}</div>
                    @endif
                </div>
                @if (is_array($link) && !empty($link['url']))
                    <x-button
                        tag="a"
                        href="{{ $link['url'] }}"
                        target="{{ $link['target'] ?? '_self' }}"
                        title="{{ __('Read more', 'sage') }}"
                        variant="default"
                        class="cursor-pointer js-form-trigger"
                    />
                @endif
            </div>
            <div class="lg:col-span-3">
                @if (is_array($image) && !empty($image['url']))
                    <img
                        class="w-full object-cover h-[59.556vw] sm:h-[60.833vw] lg:h-[30.563vw]"
                        src="{{ $image['url'] }}"
                        alt="{{ $image['alt'] }}"
                        loading="lazy"
                    >
                @endif
            </div>

        </div>
    </section>
@endif
