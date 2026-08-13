@php
    $visionBackground = $vision['background']['url'] ?? '';
    $visionHeading = $vision['heading'] ?? '';
    $visionDesc = $vision['desc'] ?? '';
    $visionButton = $vision['button'] ?? [];
@endphp

@if (!empty($vision))
    @if ($visionHeading)
        <section
            class="our-new-vision-sec text-white relative overflow-hidden flex flex-col min-h-[622px] lg:min-h-[calc(100dvh-64px)] px-page-x pt-section-y-s pb-section-y-l"
            @if ($visionBackground) style="background: url('{{ $visionBackground }}') no-repeat center / cover;" @endif>
            <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>

            <div class="relative z-1 flex-1 flex flex-col items-start justify-between gap-l">

                @if ($visionHeading)
                    <h2 class="text-h1 font-medium tracking-[0.01em]">
                        {!! $visionHeading !!}
                    </h2>
                @endif

                @if ($visionDesc)
                    <div class="text-title-l leading-5.5 md:leading-6 lg:leading-[27px] max-w-[375px]">
                        {!! $visionDesc !!}
                    </div>
                @endif

                @if (!empty($visionButton))
                    <x-button href="{{ $visionButton['url'] ?? '#' }}" target="{{ $visionButton['target'] ?? '_self' }}"
                        title="{{ $visionButton['title'] ?? 'Booking' }}" class="cursor-pointer js-form-trigger" />
                @endif

            </div>
        </section>
    @endif

@endif
