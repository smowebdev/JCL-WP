<?php

namespace App\View\Composers;

use App\Enums\PostType;
use App\Enums\ProjectTaxonomy;
use Roots\Acorn\View\Composer;
use WP_Query;

class Projects extends Composer
{

    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.projects',
    ];

    /**
     * @param string $taxonomy
     * @return array $terms Array of terms
     */
    public function get_terms($taxonomy)
    {
        $terms = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => false]);

        if (is_wp_error($terms)) {
            return [];
        }

        $in_term_id = is_archive() ? get_queried_object_id() : '';

        array_map(function ($term) use ($taxonomy, $in_term_id) {
            $term->url = esc_url(get_term_link($term->term_id, $taxonomy));
            $term->is_active = false;
            if ($in_term_id && (int)$in_term_id === $term->term_id) {
                $term->is_active = true;
            }
            return $term;
        }, $terms);

        return $terms;
    }

    /**
     * @param array $args WP_Query args array
     * @return WP_Query $projects
     */
    public function get_projects($args)
    {
        $projects = new WP_Query($args);
        return $projects;
    }

    /**
     * Data to be passed to view.
     *
     * @return array
     */
    public function with()
    {
        $projects_args = [
            'post_type' => PostType::PROJECT->value,
            'post_status' => 'publish',
            'post_per_page' => -1
        ];

        if (is_archive()) {
            $term = get_queried_object();
            $projects_args['tax_query'][] = [
                'taxonomy' => $term->taxonomy,
                'field' => 'term_id',
                'terms' => [$term->term_id]
            ];
        }

        return [
            'projects' => new WP_Query($projects_args),
            'genres' => $this->get_terms(ProjectTaxonomy::GENRE->value),
            'services' => $this->get_terms(ProjectTaxonomy::SERVICE->value),
            'sectors' => $this->get_terms(ProjectTaxonomy::SECTOR->value),
        ];
    }
}
