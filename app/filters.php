<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});


add_action('wp_head', function () {
?>
    <script>
        const jclParams = {
            ajaxURL: `<?php echo esc_url(admin_url('admin-ajax.php')); ?>`,
            filterProjectsNonce: `<?php echo esc_attr(wp_create_nonce('jcl_filter_project')); ?>`
        };
    </script>
<?php
});
