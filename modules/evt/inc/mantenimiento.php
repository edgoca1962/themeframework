<?php

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
      'post_title' => 'Eventos',
      'post_name' => 'evt-evento-mes',
      'post_status' => 'publish',
   );
   wp_insert_post($post_data);
}
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
         if (isset($_GET['fpe'])) {
            $fpe = date('Y-m-d', strtotime(sanitize_text_field($_GET['fpe'])));
            $mesConsulta = date('F', strtotime($fpe));
            $eventoID = [];
            $eventos = get_posts(['post_type' => 'evento', 'numberposts' => -1]);
            foreach ($eventos as $evento) {
               $fechasevento = themeframework_fechasevento(
                  get_post_meta($evento->ID, '_f_inicio', true),
                  get_post_meta($evento->ID, '_f_final', true),
                  get_post_meta($evento->ID, '_periodicidadevento', true),
                  get_post_meta($evento->ID, '_opcionesquema', true),
                  get_post_meta($evento->ID, '_numerodiaevento', true),
                  get_post_meta($evento->ID, '_numerodiaordinalevento', true),
                  explode(',', get_post_meta($evento->ID, '_diasemanaevento', true)),
                  get_post_meta($evento->ID, '_mesevento', true),
                  $mesConsulta
               );
               if (in_array($fpe, $fechasevento, true)) {
                  $eventoID[] = $evento->ID;
               }
            }
            $query->set('post__in', $eventoID);
         } else {
            if (isset($_GET['mes'])) {
               $mes = sanitize_text_field($_GET['mes']);
               $f_inicial = date('Y-m-d', strtotime('first day of' . $mes . ' ' . date('Y')));
               $f_final = date('Y-m-d', strtotime('last day of' . $mes . ' ' . date('Y')));
            } else {
               $mes = date('F');
               $f_inicial = date('Y-m-d');
               $f_final = date('Y-m-d', strtotime('last day of' . $mes . ' ' . date('Y')));
            }
            $mesConsulta = $mes;
            $eventoID = [];
            $eventos = get_posts(['post_type' => 'evento', 'numberposts' => -1]);
            foreach ($eventos as $evento) {
               $fechasevento = themeframework_fechasevento(
                  get_post_meta($evento->ID, '_f_inicio', true),
                  get_post_meta($evento->ID, '_f_final', true),
                  get_post_meta($evento->ID, '_periodicidadevento', true),
                  get_post_meta($evento->ID, '_opcionesquema', true),
                  get_post_meta($evento->ID, '_numerodiaevento', true),
                  get_post_meta($evento->ID, '_numerodiaordinalevento', true),
                  explode(',', get_post_meta($evento->ID, '_diasemanaevento', true)),
                  get_post_meta($evento->ID, '_mesevento', true),
                  $mesConsulta
               );
               if (count($fechasevento) > 0) {
                  $eventoID[] = $evento->ID;
               }
               $query->set('post__in', $eventoID);
            }
         }
         $query->set('meta_key', '_f_proxevento');
         $query->set('orderby', 'meta_value');
         $query->set('order', 'ASC');
      }
   }
}
add_action('pre_get_posts', 'themeframework_pre_get_posts_eventos');
