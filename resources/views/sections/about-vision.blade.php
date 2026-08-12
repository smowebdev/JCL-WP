@if (!empty($vision))
    <section
        class="our-new-vision-sec text-white relative overflow-hidden flex flex-col min-h-[622px] lg:min-h-[calc(100dvh-64px)] px-page-x pt-section-y-s pb-section-y-l"
        @if (!empty($vision['background']['url'])) style="background: url('{{ $vision['background']['url'] }}') no-repeat center / cover;" @endif>
        <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>

        <div class="relative z-1 flex-1 flex flex-col items-start justify-between gap-l">

            @if (!empty($vision['heading']))
                <h2 class="text-h1 font-medium tracking-[0.01em]">
                    {!! $vision['heading'] !!}
                </h2>
            @endif

            @if (!empty($vision['desc']))
                <div class="text-title-l leading-5.5 md:leading-6 lg:leading-[27px] max-w-[375px]">
                    {!! $vision['desc'] !!}
                </div>
            @endif

            @if (!empty($vision['button']))
                <x-button href="{{ $vision['button']['url'] ?? '#' }}"
                    target="{{ $vision['button']['target'] ?? '_self' }}"
                    title="{{ $vision['button']['title'] ?? 'Booking' }}" class="cursor-pointer js-form-trigger" />
            @endif

        </div>
    </section>
@endif
