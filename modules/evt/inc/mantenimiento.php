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
   'name' => 'evt-evento-mantenimiento',
]);
if (count($evento_mes) > 0) {
} else {
   $post_data = array(
      'post_type' => 'page',
      'post_title' => 'Manenimiento de Eventos',
      'post_name' => 'evt-evento-mantenimiento',
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

function themeframework_registrar_evento()
{
   //Validación de seguridad
   if (!wp_verify_nonce($_POST['nonce'], 'evento')) {
      wp_send_json_error('Error de seguridad', 401);
      wp_die();
   } else {
      $tdy = new DateTime('now', new DateTimeZone('America/Costa_Rica'));
      $today = $tdy->format('Y-m-d');

      //Creación aleatoria del nombre del permalink del post
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < 15; $i++) {
         $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      $post_name = 'eve_' . $randomString;

      //Registro del post en la base de datos.
      $title = sanitize_text_field($_POST['title']);
      $content = sanitize_textarea_field($_POST['content']);
      $f_inicio = sanitize_text_field($_POST['f_inicio']);
      $h_inicio = sanitize_text_field($_POST['h_inicio']);
      $f_final = sanitize_text_field($_POST['f_final']);
      $h_final = sanitize_text_field($_POST['h_final']);
      $dia_completo = sanitize_text_field($_POST['dia_completo']);
      $periodicidadevento = sanitize_text_field($_POST['periodicidadevento']);
      $inscripcion = sanitize_text_field($_POST['inscripcion']);
      $donativo = sanitize_text_field($_POST['donativo']);
      $montodonativo = sanitize_text_field($_POST['montodonativo']);

      if (isset($_POST['opcion_mensual'])) {
         $opcionesquema = sanitize_text_field($_POST['opcion_mensual']);
      }
      if (isset($_POST['opcion_anual'])) {
         $opcionesquema = sanitize_text_field($_POST['opcion_anual']);
      }

      if (isset($_POST['npereventosdiario'])) {
         $npereventos = sanitize_text_field($_POST['npereventosdiario']);
      }
      if (isset($_POST['npereventossemana'])) {
         $npereventos = sanitize_text_field($_POST['npereventossemana']);
      }
      if (isset($_POST['npereventosmes1'])) {
         $npereventos = sanitize_text_field($_POST['npereventosmes1']);
      }
      if (isset($_POST['npereventosmes2'])) {
         $npereventos = sanitize_text_field($_POST['npereventosmes2']);
      }

      $diasemanaevento = sanitize_text_field($_POST['diasemanaevento']);
      $numerodiaevento = sanitize_text_field($_POST['numerodiaevento']);
      $diaordinal = sanitize_text_field($_POST['numerodiaordinalevento']);

      if (isset($_POST['mesop1'])) {
         $mesevento = sanitize_text_field($_POST['mesop1']);
      } else {
         $mesevento = sanitize_text_field($_POST['mesop2']);
      }

      require_once(ABSPATH . "wp-admin" . '/includes/image.php');
      require_once(ABSPATH . "wp-admin" . '/includes/file.php');
      require_once(ABSPATH . "wp-admin" . '/includes/media.php');


      $attach_id = media_handle_upload('thumbnail', $_POST['post_id']);

      if (is_wp_error($attach_id)) {
         $attach_id = '';
      }

      /*multiple files loader
        if ($_FILES) {
            foreach ($_FILES as $file => $array) {
                if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                    echo "upload error : " . $_FILES[$file]['error'];
                }
                $attach_id = media_handle_upload($file, $_POST['post_id']);
            }
        }
        */

      $post_data = array(
         'post_type' => 'evento',
         'post_title' => $title,
         'post_content' => $content,
         'post_name' => $post_name,
         'post_status' => 'publish',
         'meta_input' => array(
            '_f_inicio' => $f_inicio,
            '_h_inicio' => $h_inicio,
            '_f_final' => $f_final,
            '_h_final' => $h_final,
            '_dia_completo' => $dia_completo,
            '_thumbnail_id' => $attach_id,
            '_periodicidadevento' => $periodicidadevento,
            '_inscripcion' => $inscripcion,
            '_donativo' => $donativo,
            '_montodonativo' => $montodonativo,
            '_opcionesquema' => $opcionesquema,
            '_npereventos' => $npereventos,
            '_diasemanaevento' => $diasemanaevento,
            '_numerodiaevento' => $numerodiaevento,
            '_numerodiaordinalevento' => $diaordinal,
            '_mesevento' => $mesevento
         )

      );
      wp_insert_post($post_data);
      wp_send_json_success('registrado');
      wp_die();
   }
}
add_action('wp_ajax_registrarevento', 'themeframework_registrar_evento');
