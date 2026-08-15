@props(['data' => []])
@php
    $image = $data['image'] ?? [];
@endphp
@if (is_array($image) && !empty($image))
    <section class="py-section-y-l ">
        <img
            src="{{ $image['url'] }}"
            class="object-cover h-[622px] md:h-[622px] lg:h-screen-without-header w-full"
            alt="{{ $image['alt'] }}"
            loading="lazy"
        >
    </section>
@endif
