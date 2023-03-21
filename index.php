<?php

get_header(); ?>

<?php if (is_user_logged_in()) : ?>
   <?php $postType = get_post_type() ?>
   <header>
      <?php
      get_template_part('modules/core/template-parts/cor', 'header-banner', ['postType' => get_post_type(), 'fullpage' => false]);
      get_template_part('modules/core/template-parts/cor', 'header-nav', ['postType' => get_post_type(), 'fullpage' => false]);
      ?>
   </header>
   <section class="container py-5">
      <?php if (have_posts()) {
         while (have_posts()) {
            echo '<h3>Theme Framework Index.php page</h3>';
            the_post();
            get_template_part('');
         }
      } else {
         get_template_part('');
      }
      ?>
   <?php else : ?>
      <?php
      if (is_page('cor-login')) {
         get_template_part('');
      } elseif (is_front_page()) {
         get_template_part('');
      } else {
         get_template_part('');
      }
      ?>
   <?php endif; ?>
   </section>;