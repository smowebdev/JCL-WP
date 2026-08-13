 @php
     $heading = $join['heading'] ?? '';
     $desc = $join['desc'] ?? '';
     $background = $join['background'] ?? [];
     $button = $join['button'] ?? [];
 @endphp
 @if ($heading)
     <section>
         <div class="relative aspect-video h-auto w-full lg:aspect-auto lg:h-[810px]">
             @if ($background['url'])
                 <img class="object-cover w-full h-full" src="{{ $background['url'] }}"
                     alt="{{ $background['alt'] ?? '' }}">
             @endif
             <div class="absolute inset-0 bg-black/45"></div>
             <div class="py-section-y-s px-page-x absolute inset-0 z-10">
                 @if ($heading)
                     <h2 class="text-h1 text-grey tracking-[0.027em] ">{!! $heading !!}</h2>
                 @endif
             </div>
         </div>
         <div class="py-section-y-s px-page-x bg-grey">
             <div class="  pb-100 flex gap-[50px] flex-col  items-start">
                 @if ($desc)
                     <div class="text-title-l leading-[normal]">
                         {!! $desc !!}
                     </div>
                 @endif

                 @if (!empty($button['url']))
                     <x-button tag="a" href="{{ $button['url'] }}" target="{{ $button['target'] ?? '_self' }}"
                         title="{{ $button['title'] ?? 'Inquiry' }}" variant="default"
                         class="cursor-pointer js-form-trigger hover:border-tertiary hover:bg-tertiary hover:text-grey" />
                 @endif
             </div>
         </div>

     </section>
 @endif
