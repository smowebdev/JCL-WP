@php
    $count = $project_logo['count'] ?? '';
    $heading = $project_logo['heading'] ?? '';
    $project_list = $project_logo['items'] ?? [];
@endphp
@if ($project_list)
    <section data-aos="fade-in"
        class="project-logo-sec  px-m  md:px-[48px] lg:px-0 pt-[150px] md:pt-[188px] pb-[120px] md:pb-[150px] lg:pt-[250px] lg:pb-[200px]">
        <div class="flex justify-center mb-xxl">
            @if ($count || $heading)
                <div class="flex flex-col md:flex-row items-start md:items-end md:justify-center gap-2.5 ">
                    @if ($count)
                        <div class=" min-w-[211px] font-abel tracking-[-0.01em] text-[100px] leading-[0.8]">
                            <span class="js-counter" data-count="{{ $count }}">0</span>+
                        </div>
                    @endif
                    @if ($heading)
                        <h2 class="text-h1 tracking-[0.03em] font-medium">{!! $heading !!}</h2>
                    @endif
                </div>
            @endif
        </div>
        <div class="client-logo-wrap  overflow-hidden">
            <div class="client-logo-marquee flex w-max gap-[50px] will-change-transform">
                <div
                    class="client-logo-track  flex w-max flex-wrap justify-center lg:justify-stretch lg:flex-nowrap gap-[35px]  lg:gap-[50px]">
                    @foreach ($project_list as $project)
                        <a href="{{ $project['link'] }}"
                            class="w-max shrink-0 group inline-flex lg:min-h-[83px] items-center"
                            aria-label="{{ $project['title'] }}">
                            <img class="max-h-[83px] grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-default"
                                src="{{ $project['logo']['url'] }}"
                                alt="{{ $project['logo']['alt'] ?? $project['title'] }}">
                        </a>
                    @endforeach



                </div>

            </div>
        </div>
    </section>
@endif
