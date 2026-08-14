<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Retrieve the site name.
     */
    public function siteName(): string
    {
        return get_bloginfo('name', 'display');
    }
    public function with()
    {
        return [
            'is_frontpage' => is_front_page(),
            'forms' => [
                [
                    'type' => 'booking',
                    'shortcode' => get_field(
                        'booking_form_shortcode',
                        'option'
                    ),
                ],
                [
                    'type' => 'inquiry',
                    'shortcode' => get_field(
                        'inquiry_form_shortcode',
                        'option'
                    ),
                ],
            ],
        ];
    }
}
