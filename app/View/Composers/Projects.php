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

        array_map(function ($term) use ($taxonomy) {
            $term->url = esc_url(get_term_link($term->term_id, $taxonomy));
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
        return [
            'projects' => new WP_Query([
                'post_type' => PostType::PROJECT->value,
                'post_status' => 'publish',
                'post_per_page' => -1
            ]),
            'genres' => $this->get_terms(ProjectTaxonomy::GENRE->value),
            'services' => $this->get_terms(ProjectTaxonomy::SERVICE->value),
            'sectors' => $this->get_terms(ProjectTaxonomy::SECTOR->value),
        ];
    }
}
