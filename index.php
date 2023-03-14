<?php

get_header();
if (is_user_logged_in()) {
   if (have_posts()) {
      while (have_posts()) {
         echo '<h3>Theme Framework Index.php page</h3>';
         the_post();
         get_template_part('');
      }
   } else {
      get_template_part('');
   }
} else {
   if (is_page('login')) {
      get_template_part('');
   } elseif (is_front_page()) {
      get_template_part('');
   } else {
      get_template_part('');
   }
}
