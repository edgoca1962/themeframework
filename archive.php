<?php

/**
 * The main template file for posts.
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
        <div class="<?php echo themeframework_get_page_att($postType)['div0'] ?>">
            <?php if (have_posts()) : ?>
                <?php if (themeframework_get_page_att($postType)['userAdmin']) : ?>
                    <?php echo get_template_part(themeframework_get_page_att($postType)['agregarpost']) ?>
                <?php endif; ?>
                <?php if (isset($description)) : ?>
                    <div class="archive-description"><?php echo wp_kses_post(wpautop($description)); ?></div>
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
                        <div class="my-3">
                            <?php twenty_twenty_one_the_posts_navigation() ?>
                        </div>
                    </div>
                    <?php if ($postType == 'post') : ?>
                        <div class="<?php echo themeframework_get_page_att($postType)['div4'] ?>">
                            <?php get_template_part(themeframework_get_page_att($postType)['barra']) ?>
                        </div>
                    <?php else : ?>
                        <div class="<?php echo themeframework_get_page_att($postType)['div5'] ?>">
                            <?php get_template_part(themeframework_get_page_att($postType)['barra']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <?php get_template_part('modules/core/template-parts/cor', 'none', ['fullpage' => false]); ?>
            <?php endif; ?>
        </div>
        <?php get_footer('footer', ['fullpage' => false]) ?>
    </section>
<?php else : ?>
    <?php
    get_template_part('modules/core/template-parts/cor', 'header-banner', ['postType' => get_post_type(), 'fullpage' => true]);
    get_template_part('modules/core/template-parts/cor', 'header-nav', ['postType' => get_post_type(), 'fullpage' => true]);
    ?>
<?php endif; ?>