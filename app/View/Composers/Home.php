<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Term;

class Home extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.home-hero',
        'sections.home-categories',
        'sections.home-services',
        'sections.home-teams',
        'sections.home-project-logo',
        'sections.home-about',
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
                'timeline_prefix' => get_field('timeline_prefix'),
                'items' => get_field('hero_items'),
            ],
            'categories' => [
                'items' => $this->getProjectGenres(),
                'button_view_all' => get_field('project_button_view_all'),
            ],
            'services' => [
                'heading' => get_field('services_heading'),
                'button' => get_field('services_button'),
            ],
            'teams' => [
                'image' => get_field('team_image'),
                'years' => get_field('team_years'),
                'year_label' => get_field('team_years_label'),
                'description' => get_field('team_description'),
                'button' => get_field('team_button'),
            ],
            'project_logo' => [
                'items' => $this->getClientProjects(),
                'count' => get_field('project_count'),
                'heading' => get_field('project_heading'),
            ],
        ];
    }
    protected function getClientProjects()
    {
        $displayMode = get_field('logo_display_mode') ?: 'all';

        if ($displayMode === 'selected') {
            $projects = get_field('selected_projects') ?: [];
        } else {
            $projects = get_posts([
                'post_type'      => 'project',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ]);
        }

        return collect($projects)
            ->map(function ($project) {
                $projectId = is_object($project)
                    ? $project->ID
                    : $project;

                $logo = get_field('logo', $projectId);

                if (empty($logo)) {
                    return null;
                }

                return [
                    'title' => get_the_title($projectId),
                    'link'  => get_permalink($projectId),
                    'logo'  => $logo,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }
    /**
     * Get project genres.
     *
     * @return array
     */
    protected function getProjectGenres()
    {
        $displayMode = get_field('ge_display_mode') ?: 'all';
        $selectedGenres = get_field('project-genre') ?: [];

        $args = [
            'taxonomy'   => 'project-genre',
            'hide_empty' => false,
        ];

        if ($displayMode === 'selected' && !empty($selectedGenres)) {
            $args['include'] = $selectedGenres;
        }

        $terms = get_terms($args);

        if (is_wp_error($terms)) {
            return [];
        }

        return collect($terms)
            ->map(function ($term) {
                $image = get_field(
                    'image',
                    'project-genre_' . $term->term_id
                );

                return [
                    'id'    => $term->term_id,
                    'title' => $term->name,
                    'link'  => get_term_link($term),
                    'image' => $image ?: [],
                ];
            })
            ->values()
            ->all();
    }
}
