@props(['data' => []])
@php
    $layout = $data['layout'] ?? 'it' ?: 'it';
    $image = $data['image'] ?? [];
    $text = $data['text'] ?? '';
    $is_show = (is_array($image) && !empty($image['url'])) || !empty($text);
    $wrapper_class = [
        'it' => 'grid grid-cols-1 lg:grid-cols-3 gap-xl lg:gap-0',
        'ti' => 'grid grid-cols-1 lg:grid-cols-3 gap-xl lg:gap-0',
    ];

    $image_div_classes = [
        'it' => 'col-span-1 lg:col-span-2',
        'ti' => 'col-span-1 lg:col-span-2 lg:order-2',
    ];

    $text_div_classes = [
        'it' =>
            'col-span-1 px-page-x text-center lg:text-start text-title-l leading-[1.22] flex flex-col gap-[22px] lg:gap-[28px] [&_p]:mb-0! md:tracking-[0.01em] lg:tracking-[0.019em] lg:pl-[36px] lg:pr-[50px]',
        'ti' =>
            'col-span-1 px-page-x text-center lg:text-start text-title-l leading-[1.22] flex flex-col gap-[22px] lg:gap-[28px] [&_p]:mb-0! md:tracking-[0.01em] lg:tracking-[0.019em] lg:pl-[50px] lg:pr-[36px] lg:order-1',
    ];
@endphp
@if ($is_show)
    <section>
        <div class="{{ $wrapper_class[$layout] }}">
            <div class="{{ $image_div_classes[$layout] }}">
                @if (is_array($image) && !empty($image['url']))
                    <div class="aspect-4/5 md:aspect-5/3">
                        <img
                            src="{{ $image['url'] }}"
                            class="w-full h-full object-cover"
                            alt="{{ $image['alt'] }}"
                            loading="lazy"
                        >
                    </div>
                @endif
            </div>
            <div class="{{ $text_div_classes[$layout] }}">
                {!! $text !!}</div>
        </div>
    </section>
@endif
