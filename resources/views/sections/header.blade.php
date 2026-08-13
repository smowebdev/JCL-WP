<header
    class="header-site  sticky top-0 left-0 z-50 w-full border-b border-black/10 bg-white px-page-x pt-3 pb-[11px] md:pt-s md:pb-[15px]">
    <div class="flex items-center justify-between gap-s">

        <a href="{{ home_url('/') }}" class="block">
            @if ($logo)
                <img class="h-6 w-auto md:h-6.5 lg:h-8" src="{{ $logo['url'] }}"
                    alt="{{ $logo['alt'] ?: get_bloginfo('name') }}">
            @endif
        </a>


        <nav class="header-menu hidden text-[16px] leading-4.75 md:block md:mr-17.5 lg:mr-25">
            @if (has_nav_menu('primary_navigation'))
                {!! wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'container' => false,
                    'menu_class' => 'flex gap-m lg:gap-l',
                    'echo' => false,
                    'fallback_cb' => false,
                    'depth' => 2,
                ]) !!}
            @endif
        </nav>


        <div class="header-lang text-grey hidden md:flex text-[16px]  leading-4.75  gap-s">
            <a href="#">简</a>
            <a href="#">繁</a>
            <a href="#" class="active">EN</a>
        </div>


        <button type="button" class="menu-toggle block cursor-pointer md:hidden" aria-label="Toggle menu"
            aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>


    <div class="menu-mobile px-m">

        <div class="header-lang py-l flex justify-center text-primary text-[20px]  leading-6  gap-6">
            <a href="#">简</a>
            <a href="#">繁</a>
        </div>


        <nav class="flex flex-1 items-center justify-center text-center text-[30px] leading-9">
            @if (has_nav_menu('primary_navigation'))
                {!! wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'container' => false,
                    'menu_class' => 'flex flex-col gap-l',
                    'echo' => false,
                    'fallback_cb' => false,
                    'depth' => 2,
                ]) !!}
            @endif
        </nav>


        @if (!empty($socials))
            <div class="header-socials flex justify-center gap-6 py-l">

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
                                <img class="h-6 w-6 object-contain" src="{{ $icon['url'] }}"
                                    alt="{{ $icon['alt'] ?? ($link['title'] ?? '') }}">
                            @endif
                        </a>
                    @elseif ($type === 'qr' && !empty($qr['url']))
                        <div class="relative group js-wechat cursor-pointer">
                            <button type="button" class="cursor-pointer js-wechat-trigger">
                                @if (!empty($icon['url']))
                                    <img class="h-6 w-6 object-contain" src="{{ $icon['url'] }}"
                                        alt="{{ $icon['alt'] ?? ($link['title'] ?? '') }}">
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
</header>
