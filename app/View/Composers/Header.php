<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Header extends Composer
{
    /**
     * Views that this composer applies to.
     */
    protected static $views = [
        'sections.header',
    ];

    /**
     * Data to be passed to the view.
     */
    public function with(): array
    {
        return [
            'logo' => get_field('site_logo', 'option'),
            'socials' => get_field('socials', 'option') ?: [],
        ];
    }
}
