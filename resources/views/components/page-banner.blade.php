@if (!empty($hero))
    @php
        $heading = $hero['heading'] ?? '';
        $desc = $hero['desc'] ?? '';
        $background = $hero['background'] ?? [];
    @endphp

    <section
        class="custom-banner about-banner relative flex min-h-[calc(100dvh-48px)] items-center justify-center overflow-hidden p-page-x text-white md:min-h-[622px] lg:min-h-[calc(100dvh-64px)]"
        @if (!empty($background['url'])) style="background: url('{{ $background['url'] }}') no-repeat center / cover;" @endif>
        <div class="banner-overlay pointer-events-none absolute inset-0 z-0 bg-black/45"></div>

        <div class="relative z-10">
            @if ($heading)
                <h1 class="mb-xl text-h1 font-medium  tracking-[0.027em]">
                    {!! $heading !!}
                </h1>
            @endif

            @if ($desc)
                <div class="text-title-l leading-[22px] md:leading-[normal]">
                    <p>{!! $desc !!}</p>
                </div>
            @endif
        </div>
    </section>
@endif
