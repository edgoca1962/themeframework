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
        <?php get_template_part('template-parts/content', 'header', ['post_type' => $postType, 'fullpage' => false]) ?>
    </header>
    <section class="container py-5">
        <pre>
            <?php print_r(mcssca_get_page_att($postType)) ?>
        </pre>
        <?php if (have_posts()) : ?>
            <?php if (isset($description)) : ?>
                <div class="archive-description"><?php echo wp_kses_post(wpautop($description)); ?></div>
            <?php endif; ?>
            <?php if (mcssca_get_page_att($postType)['userAdmin']) : ?>
                <?php echo get_template_part(mcssca_get_page_att($postType)['agregarpost']) ?>
            <?php endif; ?>
            <div class="<?php echo mcssca_get_page_att($postType)['div1'] ?>">
                <div class="<?php echo mcssca_get_page_att($postType)['div2'] ?>">
                    <div class="<?php echo mcssca_get_page_att($postType)['div3'] ?>">
                        <?php while (have_posts()) : ?>
                            <?php
                            the_post();
                            get_template_part('template-parts/' . get_post_type());
                            ?>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php if ($postType == 'post') : ?>
                    <div class="<?php echo mcssca_get_page_att($postType)['div4'] ?>">
                        <?php echo get_template_part(mcssca_get_page_att($postType)['barra']) ?>
                    </div>
                <?php else : ?>
                    <div class="<?php echo mcssca_get_page_att($postType)['div5'] ?>">
                        <?php echo get_template_part(mcssca_get_page_att($postType)['barra']) ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mt-3">
                <?php twenty_twenty_one_the_posts_navigation() ?>
            </div>
        <?php else : ?>
            <?php get_template_part('template-parts/content', 'none') ?>
        <?php endif; ?>
    </section>
<?php else : ?>
    <?php get_template_part('template-parts/gen-noingresado') ?>
<?php endif; ?>
<?php
get_footer('footer', ['fullpage' => false]);
