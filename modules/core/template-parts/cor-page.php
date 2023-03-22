<?php
get_template_part('modules/core/template-parts/cor', 'header-banner', ['postType' => get_post_type(), 'fullpage' => $args['fullpage']]);
get_template_part('modules/core/template-parts/cor', 'header-nav', ['postType' => get_post_type(), 'fullpage' => $args['fullpage']]);

if (!$args['fullpage']) {
    echo '<div class="' . themeframework_get_page_att(get_post_type(), false)['div1'] . '">';
    if (the_content()) {
        the_content();
    } else {
        get_template_part(themeframework_get_page_att(get_post_type(), false)['template-parts'] . get_post(get_the_ID())->post_name);
    }
    if (comments_open() || get_comments_number()) {
        comments_template();
    }
    echo '</div>';
}
