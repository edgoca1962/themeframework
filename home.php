<?php

/**
 * The main template file
 *
 * @package Aplicación_Web
 */

get_header();
?>
<?php if (is_user_logged_in()) : ?>
    <?php $postType = get_post_type() ?>
    <header>
        <?php
        get_template_part('modules/core/template-parts/cor', 'header-banner', ['postType' => get_post_type(), 'fullpage' => false]);
        get_template_part('modules/core/template-parts/cor', 'header-nav', ['postType' => get_post_type(), 'fullpage' => false]);
        ?>
    </header>
    <section class="background-blend">
        <?php if (have_posts()) : ?>
            <?php if (isset($description)) : ?>
                <div class="archive-description"><?php echo wp_kses_post(wpautop($description)); ?></div>
            <?php endif; ?>
            <?php if (themeframework_get_page_att($postType)['userAdmin']) : ?>
                <?php echo get_template_part(themeframework_get_page_att($postType)['agregarpost']) ?>
            <?php endif; ?>
            <div class="<?php echo themeframework_get_page_att($postType)['div1'] ?>">
                <div class="<?php echo themeframework_get_page_att($postType)['div2'] ?>">
                    <div class="<?php echo themeframework_get_page_att($postType)['div3'] ?>">
                        <?php while (have_posts()) : ?>
                            <?php
                            the_post();
                            get_template_part(themeframework_get_page_att($postType)['template-parts']);
                            ?>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php if ($postType == 'post') : ?>
                    <div class="<?php echo themeframework_get_page_att($postType)['div4'] ?>">
                        <?php echo get_template_part(themeframework_get_page_att($postType)['barra']) ?>
                    </div>
                <?php else : ?>
                    <div class="<?php echo themeframework_get_page_att($postType)['div5'] ?>">
                        <?php echo get_template_part(themeframework_get_page_att($postType)['barra']) ?>
                    </div>
                <?php endif; ?>
                <div class="mt-3">
                    <?php twenty_twenty_one_the_posts_navigation() ?>
                </div>
            </div>
        <?php else : ?>
            <?php get_template_part('modules/cor/template-parts/cor', 'none', ['fullpage' => true]); ?>
        <?php endif; ?>
    </section>
<?php else : ?>
    <?php get_template_part('modules/cor/template-parts/cor', 'none', ['fullpage' => true]); ?>
<?php endif; ?>
<?php
get_footer('footer', ['fullpage' => false]);
