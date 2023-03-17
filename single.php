<?php

/**
 * The main template file
 *
 * @package Aplicación_Web
 */

get_header();
$postType = get_post_type();
?>
<?php get_template_part('template-parts/content', 'header', ['post_type' => $postType, 'fullpage' => false]) ?>
<section class="container py-5">
    <div class="<?php echo mcssca_get_page_att($postType)['div1'] ?>">
        <div class="<?php echo mcssca_get_page_att($postType)['div2'] ?>">
            <div class="<?php echo mcssca_get_page_att($postType)['div3'] ?>">
                <?php if (have_posts()) : ?>
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/' . get_post_type(), 'single');
                    endwhile;
                    ?>
                <?php else : ?>
                    <?php get_template_part('template-parts/content', 'none') ?>
                <?php endif ?>
            </div>
        </div>
        <?php if ($postType == 'post') : ?>
            <div class="<?php echo mcssca_get_page_att($postType)['div4'] ?>">
                <?php get_template_part(mcssca_get_page_att($postType)['barra']) ?>
            </div>
        <?php else : ?>
            <div class="<?php echo mcssca_get_page_att($postType)['div5'] ?>">
                <?php get_template_part(mcssca_get_page_att($postType)['barra']) ?>
            </div>
        <?php endif; ?>
        <!-- <div>
            <button class="btn btn-warning btn-sm"><a class="text-black" href="<?php echo get_post_type_archive_link(mcssca_get_page_att($postType)['regresar']) . 'page/' . mcssca_get_page_att($postType)['pag_ant']  ?>">Regresar</a></button>
        </div> -->
    </div>
</section>
<?php
get_footer('footer', ['fullpage' => false]);
