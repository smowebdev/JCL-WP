@props(['data' => []])
@php
    $image = $data['image'] ?? [];
@endphp
@if (is_array($image) && !empty($image))
    <section class="py-section-y-l ">
        <img
            src="{{ $image['url'] }}"
            class="object-cover aspect-375/622 md:aspect-800/622 lg:aspect-auto lg:h-screen-without-header w-full"
            alt="{{ $image['alt'] }}"
            loading="lazy"
        >
    </section>
@endif
