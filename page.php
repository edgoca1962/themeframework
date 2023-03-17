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
                $ocultarFooter = false;
                get_template_part('modules/cor/template-parts/cor', 'page', ['fullpage' => $ocultarFooter]);
            } else {
                get_template_part('modules/cor/template-parts/cor', 'page', ['fullpage' => false]);
                $ocultarFooter = false;
            }
        }
    } else {
        get_template_part('modules/cor/template-parts/cor', 'none', ['fullpage' => true]);
    }
} else {
    if (is_page('cor-login')) {
        get_template_part('modules/cor/template-parts/cor-login');
    } elseif (is_front_page()) {
        get_template_part('modules/cor/template-parts/cor', 'page', ['fullpage' => true, 'noingresado' => false, '404' => false]);
    } else {
        get_template_part('modules/cor/template-parts/cor', 'page', ['fullpage' => true, 'noingresado' => true]);
    }
    $ocultarFooter = true;
}
get_footer('footer', ['fullpage' => $ocultarFooter]);
?>
</div> <!-- backgroun-blend  -->