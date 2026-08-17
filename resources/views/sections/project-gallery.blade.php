@props(['data' => []])
@php
    $gallery = $data['gallery'] ?? [];
@endphp
@if (is_array($gallery) && !empty($gallery))
    <section class="py-section-y-l px-page-x">
        <div
        data-aos="fade-in"
            id="drag-scroll"
            class="group/marquee lg:-mr-page-x overflow-hidden"
        >
            <div class="flex overflow-hidden gap-4">
                <div
                    class="animate-track group-hover/marquee:[animation-play-state:paused]! grid grid-cols-1 gap-4 select-none sm:grid-cols-2 lg:flex lg:flex-nowrap lg:min-w-fit lg:overflow-x-auto [&::-webkit-scrollbar]:hidden cursor-grab">
                    @php
                        $gallery_id = uniqid();
                    @endphp
                    @foreach ($gallery as $image)
                        @include('partials.gallery-item', [
                            'image' => $image,
                            'data_gallery' => $gallery_id,
                        ])
                    @endforeach
                </div>
                <div
                    class="animate-track group-hover/marquee:[animation-play-state:paused]! hidden gap-4 select-none sm:grid-cols-2 lg:flex lg:flex-nowrap lg:min-w-fit lg:overflow-x-auto [&::-webkit-scrollbar]:hidden cursor-grab">
                    @php
                        $gallery_id = uniqid();
                    @endphp
                    @foreach ($gallery as $image)
                        @include('partials.gallery-item', [
                            'image' => $image,
                            'data_gallery' => $gallery_id,
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
