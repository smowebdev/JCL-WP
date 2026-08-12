<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Term;

class About extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'templates.about',
        'sections.about-hero',
        'sections.about-services',
        'sections.about-award',
        'sections.about-vision',
    ];

    /**
     * Data to be passed to view.
     *
     * @return array
     */
    public function with()
    {
        return [
            'hero' => [
                'heading' => get_field('hero_heading'),
                'desc' => get_field('hero_description'),
                'background' => get_field('hero_background'),
            ],

            'services' => [
                'heading' => get_field('services_heading'),
                'list' => get_field('services_list'),
            ],

            'awards' => [
                'heading' => get_field('awards_heading'),
                'list' => get_field('awards_list'),
            ],

            'vision' => [
                'heading' => get_field('vision_heading'),
                'desc' => get_field('vision_description'),
                'button' => get_field('vision_button'),
                'background' => get_field('vision_background'),
            ],

            'contact' => [
                'heading' => get_field('contact_heading'),
                'address' => get_field('contact_address'),
                'telephone' => get_field('contact_telephone'),
                'fax' => get_field('contact_fax'),
                'inquiry_email' => get_field('contact_inquiry_email'),
                'button' => get_field('contact_button'),
                'map' => get_field('contact_map'),
            ],


        ];
    }
}
