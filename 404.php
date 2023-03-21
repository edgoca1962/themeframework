<?php

/**
 * The main template file
 *
 * @package Aplicación_Web
 */
get_header();
if (is_user_logged_in()) {
   get_template_part('modules/core/template-parts/cor-header-banner', '', ['postType' => get_post_type(), 'fullpage' => true, '404' => true]);
   get_template_part('modules/core/template-parts/cor', 'header-nav', ['postType' => get_post_type(), 'fullpage' => true]);
} else {
   get_template_part('modules/core/template-parts/cor-header-banner', '', ['postType' => get_post_type(), 'fullpage' => true, 'noingresado' => true]);
   get_template_part('modules/core/template-parts/cor', 'header-nav', ['postType' => get_post_type(), 'fullpage' => true]);
}
get_footer('footer', ['fullpage' => true]);
