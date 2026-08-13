<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class People extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.people-hero',
        'sections.people-teams',
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
            'teams' => [
                'heading' => get_field('team_heading'),
                'items' => $this->getTeams(),

            ]




        ];
    }
    /**
     * Get Team posts.
     *
     * @return array
     */
    protected function getTeams()
    {
        $query = new WP_Query([
            'post_type'      => 'team',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        ]);

        $teams = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $roles = get_field('roles');

                $teams[] = [
                    'id'        => get_the_ID(),
                    'name'      => get_the_title(),
                    'image'     => get_the_post_thumbnail_url(
                        get_the_ID(),
                        'full'
                    ),
                    'roles'     => $roles ?: [],
                ];
            }
        }

        wp_reset_postdata();

        return $teams;
    }
}
