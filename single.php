<?php

/**
 * The main template file
 *
 * @package Aplicación_Web
 */

get_header();
?>
<header>
    <?php
    get_template_part('modules/core/template-parts/cor', 'header-banner', ['postType' => get_post_type(), 'fullpage' => false]);
    get_template_part('modules/core/template-parts/cor', 'header-nav', ['postType' => get_post_type(), 'fullpage' => false]);
    ?>
</header>
<section class="background-blend">
    <div class="<?php echo themeframework_get_page_att(get_post_type())['div0'] ?>">
        <div class="<?php echo themeframework_get_page_att(get_post_type())['div1'] ?>">
            <div class="<?php echo themeframework_get_page_att(get_post_type())['div2'] ?>">
                <?php if (have_posts()) : ?>
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part(themeframework_get_page_att(get_post_type())['template-parts-single']);
                    endwhile;
                    ?>
                <?php else : ?>
                    <?php get_template_part('modules/core/template-parts/cor', 'none', ['fullpage' => true]); ?>
                <?php endif ?>
                <?php if (themeframework_get_page_att(get_post_type())['pag_ant'] != 0) : ?>
                    <?php get_template_part(themeframework_get_page_att(get_post_type())['btn_regresar']) ?>
                <?php endif; ?>
            </div>
            <?php if (get_post_type() == 'post') : ?>
                <div class="<?php echo themeframework_get_page_att(get_post_type())['div4'] ?>">
                    <?php get_template_part(themeframework_get_page_att(get_post_type())['barra']) ?>
                </div>
            <?php else : ?>
                <div class="<?php echo themeframework_get_page_att(get_post_type())['div5'] ?>">
                    <?php get_template_part(themeframework_get_page_att(get_post_type())['barra']) ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php
get_footer('footer', ['fullpage' => false]);
