<?php

/******************************************************************************
 * 
 * 
 * Filtra los posts eventos por fecha del próximo evento y los ordena
 * por la fecha del próximo evento.
 * 
 * 
 *****************************************************************************/

function themeframework_pre_get_posts_eventos($query)
{
   if ($query->is_main_query() && !is_admin()) {
      if (is_post_type_archive('evento')) {
         $f_final =
            [
               'key' => '_f_final',
               'value' => date('Y-m-d'),
               'compare' => '>'
            ];
         $f_proxevento =
            [
               'key' => '_f_proxevento',
               'value' => date('Y-m-d'),
               'compare' => '>'
            ];
         $query->set(
            'meta_query',
            [
               'relation' => 'OR',
               $f_final,
               $f_proxevento,
            ]
         );
         $query->set('meta_key', '_f_proxevento');
         $query->set('orderby', 'meta_value_num');
         $query->set('order', 'DESC');
      }
   }
}
add_action('pre_get_posts', 'themeframework_pre_get_posts_eventos');
