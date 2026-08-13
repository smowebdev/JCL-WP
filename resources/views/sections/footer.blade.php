 <footer class="footer-site px-page-x border-t border-grey pt-[15px] pb-s md:pt-5.5 md:pb-[23px]">
     <div class="flex flex-col md:flex-row flex-wrap justify-between items-center gap-2.5">
         <div class="flex-1">
             @if ($copyright)
                 <p class="text-p1 leading-[normal] block md:inline-block  text-center md:text-left">©
                     {{ date('Y') }}
                     {!! $copyright !!}
                 </p>
             @endif
         </div>
         @if (!empty($socials))
             <div class="flex gap-s">
                 @foreach ($socials as $social)
                     @php
                         $icon = $social['icon'] ?? [];
                         $type = $social['type'] ?? '';
                         $link = $social['link'] ?? [];
                         $qr = $social['qr'] ?? [];
                     @endphp

                     @if ($type === 'link' && !empty($link['url']))
                         <a href="{{ $link['url'] }}" target="{{ $link['target'] ?: '_self' }}"
                             @if ($link['target'] === '_blank') rel="noopener noreferrer" @endif>
                             @if (!empty($icon['url']))
                                 <img class="w-auto max-h-[24px] object-contain" src="{{ $icon['url'] }}"
                                     alt="{{ $icon['alt'] ?? ($link['title'] ?? '') }}">
                             @endif

                         </a>
                     @elseif ($type === 'qr' && !empty($qr['url']))
                         <div class="relative group js-wechat cursor-pointer">
                             <button type="button" class="cursor-pointer js-wechat-trigger">
                                 @if (!empty($icon['url']))
                                     <img class="w-auto max-h-[24px] object-contain" src="{{ $icon['url'] }}"
                                         alt="{{ $icon['alt'] }}">
                                 @endif
                             </button>
                             <div
                                 class="absolute left-1/2 bottom-full z-50 pb-2
               hidden -translate-x-1/2
               md:group-hover:block
               js-wechat-qr">
                                 <img class="w-24 h-24 max-w-[unset] object-contain bg-white p-2 shadow-lg"
                                     src="{{ $qr['url'] }}" alt="{{ $qr['alt'] }}">
                             </div>
                         </div>
                     @endif
                 @endforeach
             </div>
         @endif

     </div>
 </footer>
