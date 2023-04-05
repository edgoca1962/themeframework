<?php

/**
 * The main template file
 *
 * @package Aplicación_Web
 */
get_header();
if (is_user_logged_in()) {
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            if (is_front_page()) {
                $fullPage = false;
                get_template_part('modules/core/template-parts/cor', 'page', ['fullpage' => $fullPage]);
            } else {
                get_template_part('modules/core/template-parts/cor', 'page', ['fullpage' => false]);
                $fullPage = false;
            }
        }
    } else {
        get_template_part('modules/core/template-parts/cor', 'none', ['fullpage' => true]);
    }
} else {
    if (is_page('cor-login')) {
        get_template_part('modules/core/template-parts/cor-login');
    } elseif (is_front_page()) {
        get_template_part('modules/core/template-parts/cor', 'page', ['fullpage' => true, 'noingresado' => false, '404' => false]);
    } else {
        get_template_part('modules/core/template-parts/cor', 'page', ['fullpage' => true, 'noingresado' => true]);
    }
    $fullPage = true;
}
get_footer('footer', ['fullpage' => $fullPage]);
?>
</div> <!-- backgroun-blend  -->