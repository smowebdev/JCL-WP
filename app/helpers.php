<?php

namespace App;

function jcl_languages()
{
    $languages = function_exists('pll_the_languages') ? pll_the_languages(['raw' => 1]) : [];

    if (empty($languages)) {
        return [];
    }

    $labels = [
        'zh_tw'   => __('繁', 'sage'),
        'zh_hant' => __('繁', 'sage'),
        'zh-hant' => __('繁', 'sage'),
        'zh-tw'   => __('繁', 'sage'),
        'tw'      => __('繁', 'sage'),
        'zh'      => __('繁', 'sage'),
        'zh_cn'   => __('简', 'sage'),
        'zh_hans' => __('简', 'sage'),
        'zh-hans' => __('简', 'sage'),
        'zh-cn'   => __('简', 'sage'),
        'cn'      => __('简', 'sage'),
        'en'      => __('EN', 'sage'),
    ];

    array_walk($languages, function (&$language, $code) use ($labels) {
        $key = strtolower($code);
        $language['label'] = $labels[$key] ?? strtoupper($language['slug'] ?? $code);
    });

    return $languages;
}

/**
 * @param int $project_id
 * @return array $project_data Data of project to use in project card
 */
function project_card_data($project_id)
{
    $project_data = [
        'permalink' => esc_url(get_the_permalink($project_id)),
        'title' => wp_kses_post(get_the_title($project_id)),
        'thumbnail_url' => esc_url(get_the_post_thumbnail_url($project_id, 'full'))
    ];
    return $project_data;
}


/**
 * @param string $ids_tring 
 * @param boolean $as_number
 * @return array Ids array
 */
function parse_id_string($ids_tring, $as_number = true)
{
    if (empty($ids_tring) || !is_string($ids_tring)) {
        return [];
    }

    $array = array_map('trim', explode(',', $ids_tring));

    $array = array_filter($array, function ($item) {
        return $item !== '';
    });

    if ($as_number) {
        $array = array_map('intval', $array);
    }

    return array_values($array);
}
