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
               'value' => date('Ymd'),
               'compare' => '>',
               'type' => 'DATE'
            ];
         $f_proxevento =
            [
               'key' => '_f_proxevento',
               'value' => date('Ymd'),
               'compare' => '>',
               'type' => 'DATE'
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
         $query->set('orderby', 'meta_value');
         $query->set('order', 'ASC');
      }
   }
}
add_action('pre_get_posts', 'themeframework_pre_get_posts_eventos');
/******************************************************************************
 * 
 * 
 * Crea las páginas para los eventos.
 * 
 * 
 *****************************************************************************/
$evento_mes = get_posts([
   'post_type' => 'page',
   'post_status' => 'publish',
   'name' => 'evt-evento-mes',
]);
if (count($evento_mes) > 0) {
} else {
   $post_data = array(
      'post_type' => 'page',
      'post_title' => 'Eventos del mes',
      'post_name' => 'evt-evento-mes',
      'post_status' => 'publish',
   );
   wp_insert_post($post_data);
}
