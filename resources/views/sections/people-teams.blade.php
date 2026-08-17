@php
    $heading = $teams['heading'] ?? '';
    $items = $teams['items'] ?? [];
@endphp
@if (!empty($items))
    <section class="py-section-y-s px-page-x bg-secondary">

        @if ($heading)
            <h2 data-aos="fade-in" class="text-h1  font-medium tracking-[0.027em]">
                {!! $heading !!}
            </h2>
        @endif

        <div class="py-100 flex flex-wrap gap-y-xxl gap-x-s justify-center">

            @foreach ($items as $team)
                <div data-aos="fade-in"
                    class="flex flex-col  gap-s
                    w-[calc((100%-var(--spacing-s))/2)]
                    md:w-[calc((100%-3*var(--spacing-s))/4)]
                    lg:w-[calc((100%-4*var(--spacing-s))/5)]">

                    @if ($team['image'])
                        <div class="aspect-square overflow-hidden block">
                            <img class="w-full h-full object-cover" src="{{ $team['image'] }}"
                                alt="{{ $team['name'] ?? '' }}">
                        </div>
                    @endif

                    <div class="flex flex-col gap-1">

                        @if ($team['name'])
                            <div class="text-title-l leading-[normal]">
                                {{ $team['name'] }}
                            </div>
                        @endif

                        @if (!empty($team['roles']))
                            @foreach ($team['roles'] as $role)
                                @if (!empty($role['role']))
                                    <span class="inline-block font-medium text-p1 leading-[normal]">
                                        {{ $role['role'] }}
                                    </span>
                                @endif
                            @endforeach
                        @endif

                    </div>

                </div>
            @endforeach

        </div>

    </section>
@endif
