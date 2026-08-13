<?php

use App\Enums\PostType;
use App\Enums\ProjectTaxonomy;

use function App\parse_id_string;
use function App\project_card_data;
use function Roots\view;

add_action('wp_ajax_filter_projects', 'filter_projects');
add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

function filter_projects()
{
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'jcl_filter_project')) {
        wp_send_json_error([
            'message' => "Something went wrong",
        ], 500);
    }

    $genres = parse_id_string($_POST['genres'] ?? '');
    $services = parse_id_string($_POST['services'] ?? '');
    $sectors = parse_id_string($_POST['sectors'] ?? '');

    $args = [
        'post_type' => PostType::PROJECT->value,
        'post_status' => 'publish',
        'post_per_page' => -1
    ];

    if (!empty($genres)) {
        $args['tax_query'][] = [
            'taxonomy' => ProjectTaxonomy::GENRE->value,
            'field' => 'term_id',
            'terms' => $genres
        ];
    }

    if (!empty($services)) {
        $args['tax_query'][] = [
            'taxonomy' => ProjectTaxonomy::SERVICE->value,
            'field' => 'term_id',
            'terms' => $services
        ];
    }

    if (!empty($sectors)) {
        $args['tax_query'][] = [
            'taxonomy' => ProjectTaxonomy::SECTOR->value,
            'field' => 'term_id',
            'terms' => $sectors
        ];
    }

    $projects = new WP_Query($args);

    ob_start();

    if ($projects->have_posts()) {
        while ($projects->have_posts()) {
            $projects->the_post();
            $project_id = get_the_ID();
            $project_data = project_card_data($project_id);
            echo view('components.card-project', ['data' => $project_data])->render();
        }
        wp_reset_postdata();
    }

    $html = ob_get_clean();

    wp_send_json_success([
        'html' => $html,
        'count' => $projects->found_posts
    ]);
}
