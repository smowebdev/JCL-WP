<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Footer extends Composer
{
    /**
     * Views that this composer applies to.
     */
    protected static $views = [
        'sections.footer',
    ];

    /**
     * Data to be passed to the view.
     */
    public function with(): array
    {
        return [
            'copyright' => get_field('copyright', 'option'),
            'socials' => get_field('socials', 'option') ?: [],
        ];
    }
}
