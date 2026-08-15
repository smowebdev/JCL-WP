@props(['data' => []])
@php
    $gallery = $data['gallery'] ?? [];
@endphp
@if (is_array($gallery) && !empty($gallery))
    <section class="py-section-y-l px-page-x">
        <div
            id="drag-scroll"
            class="grid grid-cols-1 gap-4 select-none sm:grid-cols-2 lg:flex lg:flex-nowrap lg:overflow-x-auto [&::-webkit-scrollbar]:hidden cursor-grab lg:-mr-page-x"
        >
            @php
                $gallery_id = uniqid();
            @endphp
            @foreach ($gallery as $image)
                @include('partials.gallery-item', ['image' => $image, 'data_gallery' => $gallery_id])
            @endforeach
        </div>
    </section>
@endif
