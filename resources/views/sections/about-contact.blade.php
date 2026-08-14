@php
    $heading = $contact['heading'] ?? '';
    $address = $contact['address'] ?? '';
    $telephone = $contact['telephone'] ?? '';
    $fax = $contact['fax'] ?? '';
    $inquiryEmail = $contact['inquiry_email'] ?? '';
    $button = $contact['button'] ?? [];
    $map = $contact['map'] ?? [];

    $lat = $map['latitude'] ?? '';
    $lng = $map['longitude'] ?? '';
    $zoom = $map['zoom'] ?? 16;
    $mapAddress = $map['address'] ?? $address;
@endphp

@if ($heading || $address)
    <section class="about-contact-sec px-page-x py-section-y-s">

        @if ($heading)
            <h2 data-aos="fade-in"
                class="text-h1 py-[15px] md:py-2.5 lg:py-0 font-medium tracking-[0.027em] mb-section-y-s">
                {!! $heading !!}
            </h2>
        @endif

        <div data-aos="fade-in" class="grid grid-cols-1 lg:grid-cols-[1fr_440px] gap-m">

            <div class="contact-map-wrapper h-[450px] w-full">
                @if ($lat && $lng)
                    <div id="map" class="w-full h-full" data-map-lat="{{ $lat }}"
                        data-map-lng="{{ $lng }}" data-map-zoom="{{ $zoom }}"
                        data-map-address="{{ $address }}"></div>
                @endif
            </div>

            <div>
                <div class="max-w-[350px] h-full flex flex-col justify-between gap-section-y-s items-start">

                    <div class="flex flex-col gap-m">

                        @if ($address)
                            <div class="flex flex-col gap-[5px]">
                                <span class="text-p1 leading-[normal]">
                                    {{ __('Address', 'sage') }}
                                </span>

                                <p class="text-title-l leading-[normal]">
                                    {!! nl2br(e($address)) !!}
                                </p>
                            </div>
                        @endif

                        @if ($telephone)
                            <div class="flex flex-col gap-[5px]">
                                <span class="text-p1 leading-[normal]">
                                    {{ __('Telephone', 'sage') }}
                                </span>

                                <p class="text-title-l leading-[normal]">
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $telephone) }}">
                                        {{ $telephone }}
                                    </a>
                                </p>
                            </div>
                        @endif

                        @if ($fax)
                            <div class="flex flex-col gap-[5px]">
                                <span class="text-p1 leading-[normal]">
                                    {{ __('Fax', 'sage') }}
                                </span>

                                <p class="text-title-l leading-[normal]">
                                    {{ $fax }}
                                </p>
                            </div>
                        @endif

                        @if ($inquiryEmail)
                            <div class="flex flex-col gap-[5px]">
                                <span class="text-p1 leading-[normal]">
                                    {{ __('Inquiry', 'sage') }}
                                </span>

                                <p class="text-title-l leading-[normal]">
                                    <a href="mailto:{{ $inquiryEmail }}">
                                        {{ $inquiryEmail }}
                                    </a>
                                </p>
                            </div>
                        @endif

                    </div>

                    @if (!empty($button['url']))
                        <x-button tag="a" href="{{ $button['url'] }}"
                            target="{{ $button['target'] ?? '_self' }}" title="{{ $button['title'] ?? 'Inquiry' }}"
                            variant="default" class="cursor-pointer js-form-trigger" />
                    @endif

                </div>
            </div>

        </div>

    </section>
@endif
