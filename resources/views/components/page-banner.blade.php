@if (!empty($hero))
    @php
        $heading = $hero['heading'] ?? '';
        $desc = $hero['desc'] ?? '';
        $background = $hero['background'] ?? [];
        $award_image = $hero['award_image'] ?? [];
        $layout_type = $hero['layout_type'] ?? 'left' ?: 'left';
        $banner_type = $hero['banner_type'] ?? 'image' ?: 'image';
        $video = $hero['video'] ?? '' ?: '';

        $title_classes = [
            'left' => 'mb-xl text-h1 font-medium tracking-[0.027em]',
            'center' => 'text-h1 tracking-[0.027em] font-medium text-center',
        ];

        $wrapper_classes = [
            'left' =>
                'custom-banner about-banner relative flex min-h-[calc(100dvh-48px)] items-center overflow-hidden p-page-x text-white md:min-h-[622px] lg:min-h-[calc(100dvh-64px)]',
            'center' =>
                'custom-banner about-banner text-white flex items-center justify-center p-page-x relative overflow-hidden h-screen-without-header md:h-[622px] lg:max-h-screen-without-header',
        ];

        $desc_classes = [
            'left' => 'text-title-l leading-[22px] md:leading-[normal]',
            'center' => 'mt-xl text-title-l leading-[22px] md:leading-[normal]',
        ];

        $overlay_classes = [
            'left' => 'banner-overlay pointer-events-none absolute inset-0 z-10 bg-black/45',
            'center' => 'banner-overlay pointer-events-none absolute inset-0 z-10 bg-black/20',
        ];

    @endphp
    @if ($heading)
        <section
            class="{{ $wrapper_classes[$layout_type] }}"
            @if ($banner_type !== 'video' && !empty($background['url'])) style="background: url('{{ $background['url'] }}') no-repeat center / cover;" @endif
        >
            @if ($banner_type === 'video' && !empty($video))
            @endif
            <div class="absolute inset-0 z-0">
                <video
                    class="w-full h-full object-cover"
                    src="{{ $video }}"
                    muted
                    playsinline
                    autoplay
                    loop
                ></video>
            </div>
            <div class="{{ $overlay_classes[$layout_type] }}"></div>

            <div class="relative z-20">
                @if ($heading)
                    <h1 class="{{ $title_classes[$layout_type] }}">
                        {!! $heading !!}
                    </h1>
                @endif

                @if ($desc)
                    <div class="{{ $desc_classes[$layout_type] }}">
                        {!! $desc !!}
                    </div>
                @endif
            </div>
            @if (is_array($award_image) && !empty($award_image['url']))
                <img
                    src="{{ $award_image['url'] }}"
                    class="absolute top-0 right-5 lg:right-[50px] lg:w-[145px] lg:h-[145px] w-[100px] h-[100px] object-cover z-40"
                    alt="{{ $award_image['alt'] }}"
                    loading="lazy"
                >
            @endif
        </section>
    @endif

@endif
