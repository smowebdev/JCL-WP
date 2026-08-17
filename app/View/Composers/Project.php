<?php

namespace App\View\Composers;

use App\Enums\PostType;
use App\Enums\ProjectTaxonomy;
use Illuminate\Support\Facades\Validator;
use Roots\Acorn\View\Composer;
use WP_Query;

class Project extends Composer
{

    protected int $project_id;
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-single-project',
    ];

    public function sections_data()
    {
        // Project Details
        $project_details = [
            'introduce' => wp_kses_post(get_field('introduce')),
            'location' => get_field('location'),
            'status' => get_field('status'),
            'year' => get_field('year'),
            'client' => get_field('client'),
            'surface_area' => get_field('surface_area'),
            'theme' => get_field('theme'),
            'service' => get_field('service'),
            'programmes' => get_field('programmes'),
            'in_partnership_with' => get_field('in_partnership_with'),
        ];

        $project_details['is_show'] = !empty(array_filter($project_details));

        // Banner Image
        $hero = [
            'banner_type' => get_field('banner_type') ?? 'image' ?: 'image',
            'video' => get_field('banner_video', $this->project_id) ?? '',
            'background' => get_field('banner_image', $this->project_id) ?? [],
            'thumbnail' => esc_url(get_the_post_thumbnail_url($this->project_id, 'full')),
            'award_image' => get_field('award_image', $this->project_id) ?? [],
            'heading' => wp_kses_post(get_the_title()),
            'layout_type' => 'center'
        ];

        $hero['is_show'] = (is_array($hero['background']) && !empty($hero['background'])) ||
            !empty($hero['thumbnail']) ||
            (is_array($hero['background']) && !empty($hero['background'])) ||
            !empty($hero['heading']);


        return [
            'project_details' => $project_details,
            'hero' => $hero,
            'sections' => get_field('sections') ?? [],
            'sections_templates' => [
                'image_and_text' => 'sections.project-image-text',
                'image' => '.sections.project-image',
                'gallery' => 'sections.project-gallery',
                'related_article' => 'sections.project-related-article',
            ],
        ];
    }

    /**
     * Data to be passed to view.
     *
     * @return array
     */
    public function with()
    {
        $this->project_id = get_the_ID();

        return [
            ...$this->sections_data(),
        ];
    }
}
