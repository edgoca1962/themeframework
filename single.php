<?php

/**
 * The main template file
 *
 * @package Aplicación_Web
 */

get_header();
$postType = get_post_type();
?>
<header>
    <?php
    get_template_part('modules/cor/template-parts/cor', 'header-banner', ['postType' => get_post_type(), 'fullpage' => false]);
    get_template_part('modules/cor/template-parts/cor', 'header-nav', ['postType' => get_post_type(), 'fullpage' => false]);
    ?>
</header>
<section class="container py-5">
    <div class="<?php echo themeframework_get_page_att($postType)['div1'] ?>">
        <div class="<?php echo themeframework_get_page_att($postType)['div1'] ?>">
            <div class="<?php echo themeframework_get_page_att($postType)['div1'] ?>">
                <?php if (have_posts()) : ?>
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part(themeframework_get_page_att($postType)['template-parts-single']);
                    endwhile;
                    ?>
                <?php else : ?>
                    <?php get_template_part('modules/cor/template-parts/cor', 'none', ['fullpage' => true]); ?>
                <?php endif ?>
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
        <!-- <div>
            <button class="btn btn-warning btn-sm"><a class="text-black" href="<?php echo get_post_type_archive_link(themeframework_get_page_att($postType)['regresar']) . 'page/' . themeframework_get_page_att($postType)['pag_ant']  ?>">Regresar</a></button>
        </div> -->
    </div>
</section>
<?php
get_footer('footer', ['fullpage' => false]);
