<?php

/******************************************************************************
 * 
 * 
 * Creación de páginas generales.
 * 
 * 
 *****************************************************************************/
$login = get_posts([
   'post_type' => 'page',
   'name' => 'cor-login',
   'post_status' => 'publish',
]);
if (count($login) > 0) {
} else {
   $post_data = array(
      'post_type' => 'page',
      'post_title' => 'Login',
      'post_name' => 'cor-login',
      'post_status' => 'publish',
   );
   wp_insert_post($post_data);
}
$noingresado = get_posts([
   'post_type' => 'page',
   'post_status' => 'publish',
   'name' => 'noingresado',
]);
if (count($noingresado) > 0) {
} else {
   $post_data = array(
      'post_type' => 'page',
      'post_title' => 'Favor Ingresar a la aplicación',
      'post_name' => 'noingresado',
      'post_status' => 'publish',
   );
   wp_insert_post($post_data);
}
$principal = get_posts([
   'post_type' => 'page',
   'post_status' => 'publish',
   'name' => 'principal',
]);
if (count($principal) > 0) {
} else {
   $post_data = array(
      'post_type' => 'page',
      'post_title' => 'Página Principal',
      'post_name' => 'principal',
      'post_status' => 'publish',
   );
   wp_insert_post($post_data);
}

/******************************************************************************
 * 
 * 
 * Obtener Atributos de las páginas y los posts.
 * 
 * 
 *****************************************************************************/
if (!function_exists('themeframework_get_page_att')) {
   function themeframework_get_page_att($postType = '', $fullpage = true)
   {
      $atributos = [];
      $usuario = wp_get_current_user();
      $usuarioRoles = $usuario->roles;
      if (in_array('administrator', $usuarioRoles) || in_array('author', $usuarioRoles)) {
         $userAdmin = true;
      } else {
         $userAdmin = false;
      }
      if (isset($_GET['cpt'])) {
         $postType = sanitize_text_field($_GET['cpt']);
      }
      if (get_the_post_thumbnail_url()) {
         $imagen = get_the_post_thumbnail_url();
      } else {
         $imagen = get_template_directory_uri() . '/assets/img/bg.jpg';
      }
      if ($fullpage) {
         $height = "100vh";
         $fullpage = true;
         $div1 = '';
         $div2 = '';
      } else {
         $height = '60vh';
         $fullpage = false;
         $div1 = 'background-blend';
         $div2 = 'container py-5';
      }
      if (is_front_page()) {
         $templateParts = 'modules/cor/template-parts/cor/';
         $frontPage = true;
      } else {
         if (get_the_ID()) {
            $templateParts = 'modules/' . substr(get_post(get_the_ID())->post_name, 0, 3) . '/template-parts/';
         } else {
            $templateParts = 'modules/cor/template-parts/';
         }
         $frontPage = false;
      }
      $atributos['frontPage'] = $frontPage;
      $atributos['template-parts'] = $templateParts;
      $atributos['userAdmin'] = $userAdmin;
      $atributos['height'] = $height;
      $atributos['imagen'] = $imagen;
      $atributos['fullpage'] = $fullpage;
      $atributos['titulo'] = get_the_title();
      $atributos['subtitulo'] = '';
      $atributos['subtitulo2'] = '';
      $atributos['template'] = '';
      $atributos['div1'] = $div1;
      $atributos['div2'] = $div2;

      return $atributos;
   }
}

if (!function_exists('themeframework_get_page_att')) {
   function themeframework_get_page_att($post_type)
   {
      $atributos = [];
      $usuario = wp_get_current_user();
      $usuarioRoles = $usuario->roles;
      if (isset(explode("/", $_SERVER['REQUEST_URI'])[3])) {
         $atributos['pag'] = explode("/", $_SERVER['REQUEST_URI'])[3];
      } else {
         $atributos['pag'] = '1';
      }
      if (isset($_GET['pag'])) {
         $atributos['pag_ant'] = sanitize_text_field($_GET['pag']);
      } else {
         $atributos['pag_ant'] = '1';
      }
      if (in_array('administrator', $usuarioRoles) || in_array('author', $usuarioRoles)) {
         $atributos['userAdmin'] = true;
      } else {
         $atributos['userAdmin'] = false;
      }
      switch ($post_type) {
         case 'post':
            if (get_the_post_thumbnail_url()) {
               $atributos['imagen'] = get_the_post_thumbnail_url();
            } else {
               $atributos['imagen'] = get_template_directory_uri() . '/assets/img/bg.jpg';
            }
            $atributos['titulo'] = 'Blog';
            if (get_the_archive_title() == 'Archives') {
               $atributos['subtitulo'] = '';
            } else {
               $atributos['subtitulo'] = str_replace('Tag', 'Clasificación', get_the_archive_title(), $count);
            }
            $atributos['height'] = '60vh';
            $atributos['subtitulo2'] = '';
            $atributos['div1'] = '';
            $atributos['div2'] = '';
            $atributos['div3'] = 'row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4';
            $atributos['div4'] = '';
            $atributos['div5'] = '';
            $atributos['agregarpost'] = '';
            $atributos['barra'] = '';
            $atributos['regresar'] = 'post';
            break;
         case 'comite':
            $atributos['titulo'] = 'Comités';
            $atributos['subtitulo'] = '';
            $atributos['subtitulo2'] = '';
            $atributos['display'] = 'display-4';
            $atributos['displaysub'] = '';
            $atributos['height'] = '60vh';
            $atributos['div1'] = "row";
            $atributos['div2'] = "col-xl-8";
            $atributos['div3'] = "row row-cols-1 row-cols-lg-2 g-2 g-lg-5";
            $atributos['div4'] = "";
            $atributos['div5'] = 'col-xl-4';
            $atributos['agregarpost'] = 'template-parts/comite-mantenimiento';
            $atributos['barra'] = 'template-parts/sca-busquedas';
            break;
         case 'acta':
            if (isset($_GET['comite_id']) != null) {
               $comite_id = sanitize_text_field($_GET['comite_id']);
               $comite = get_post($comite_id)->post_title;
               if (preg_match("/Junta/i", $comite)) {
                  $atributos['titulo'] = "Actas de " . $comite;
                  $atributos['prefijo'] = 'Acta';
               } else {
                  $atributos['titulo'] = "Minutas del " . $comite;
                  $atributos['prefijo'] = 'Minuta';
               }
               global $wpdb;
               $qryconsecutivo = $wpdb->get_var(
                  "
                        SELECT MAX(cast(t01.meta_value as unsigned))+1 consecutivo
                        FROM wp_posts
                        INNER JOIN wp_postmeta t01 ON (ID = t01.post_id)
                        INNER JOIN wp_postmeta t02 ON (ID = t02.post_id)
                        WHERE 1=1
                        AND (
                        (t01.meta_key = '_n_acta')
                        AND (t02.meta_key = '_comite_id' and t02.meta_value = " . $comite_id . ")
                        )
                        AND post_type = 'acta' AND post_status = 'publish'
                        "
               );

               $qry_n_actas = $wpdb->get_results(
                  "
                        SELECT t01.meta_value
                        FROM wp_posts
                        INNER JOIN wp_postmeta t01 ON (ID = t01.post_id)
                        INNER JOIN wp_postmeta t02 ON (ID = t02.post_id)
                        WHERE 1 = 1
                        AND (
                        (t01.meta_key = '_n_acta' AND t01.meta_value != '')
                        AND (t02.meta_key = '_comite_id' and t02.meta_value = " . $comite_id . ")
                        )
                        AND post_type = 'acta' and post_status = 'publish'
                        ",
                  ARRAY_A
               );
               $num_actas = '';
               foreach ($qry_n_actas as $acta) {
                  $num_actas .= $acta['meta_value'] . ',';
               }
               $atributos['consecutivo'] = $qryconsecutivo;
               $atributos['n_actas'] = $qry_n_actas;
               $atributos['num_actas'] = $num_actas;
               $atributos['btn_agregar'] = true;
            } else {
               $atributos['titulo'] = 'Minutas y Actas';
               $atributos['prefijo'] = 'Minutas o Actas';
               $atributos['btn_agregar'] = false;
            }
            $atributos['subtitulo'] = '';
            $atributos['subtitulo2'] = '';
            $atributos['display'] = 'display-6';
            $atributos['displaysub'] = 'display-6';
            $atributos['height'] = '60vh';
            $atributos['div1'] = "row";
            $atributos['div2'] = "col-xl-8";
            $atributos['div3'] = "row row-cols-1 row-cols-md-2 g-4 mb-5";
            $atributos['div4'] = "";
            $atributos['div5'] = 'col-xl-4';
            $atributos['agregarpost'] = 'template-parts/acta-mantenimiento';
            $atributos['barra'] = 'template-parts/sca-busquedas';
            break;
         case 'acuerdo':
            if (isset($_GET['comite_id']) != null && isset($_GET['acta_id']) != null) {
               $comite_id = sanitize_text_field($_GET['comite_id']);
               $acta_id = sanitize_text_field($_GET['acta_id']);
               global $wpdb;
               $qryconsecutivo = $wpdb->get_var(
                  "
                    SELECT
                    MAX(cast(t01.meta_value as unsigned)) + 1 consecutivo
                    FROM
                        wp_posts
                        INNER JOIN wp_postmeta t01 ON (ID = t01.post_id)
                        INNER JOIN wp_postmeta t02 ON (ID = t02.post_id)
                        INNER JOIN wp_postmeta t03 ON (ID = t03.post_id)
                    WHERE 1 = 1 
                        AND (
                            (t01.meta_key = '_n_acuerdo' AND t01.meta_value != '')
                            AND (t02.meta_key = '_comite_id' AND t02.meta_value ='" . $comite_id . "')
                            AND (t03.meta_key = '_acta_id' AND t03.meta_value = '" . $acta_id . "')
                        )
                        AND post_type = 'acuerdo'
                        AND post_status = 'publish';
                    "
               );

               $qry_n_acuerdos = $wpdb->get_results(
                  "
                        SELECT
                        t01.meta_value
                        FROM
                            wp_posts
                            INNER JOIN wp_postmeta t01 ON (ID = t01.post_id)
                            INNER JOIN wp_postmeta t02 ON (ID = t02.post_id)
                            INNER JOIN wp_postmeta t03 ON (ID = t03.post_id)
                        WHERE 1 = 1
                            AND(
                                (t01.meta_key = '_n_acuerdo' AND t01.meta_value != '')
                                AND (t02.meta_key = '_comite_id' AND t02.meta_value = '" . $comite_id . "')
                                AND (t03.meta_key = '_acta_id' AND t03.meta_value = '" . $acta_id . "')
                                )
                            AND post_type = 'acuerdo'
                            AND post_status = 'publish'
                        ",
                  ARRAY_A
               );

               $num_acuerdos = '';
               foreach ($qry_n_acuerdos as $acuerdo) {
                  $num_acuerdos .= $acuerdo['meta_value'] . ',';
               }
               $atributos['consecutivo'] = $qryconsecutivo;
               $atributos['n_acuerdos'] = $num_acuerdos;
            } else {
               $atributos['consecutivo'] = '';
               $atributos['f_acta'] = '';
               $atributos['n_acuerdos'] = '';
            }

            if (isset($_GET['comite_id']) != null) {
               $comite_id = sanitize_text_field($_GET['comite_id']);
               $comite = get_post($comite_id)->post_title;
               $atributos['comite_id'] = $comite_id;
               $atributos['titulo_comite'] = $comite;
               if (preg_match("/Junta/i", $comite)) {
                  $atributos['titulo'] = "Actas de " . $comite;
               } else {
                  $atributos['titulo'] = "Minutas del " . $comite;
               }
            } else {
               $comite_id = '';
               $atributos['titulo'] = 'Acuerdos';
               $atributos['comite_id'] = '';
               $atributos['titulo_comite'] = '';
            }
            if (isset($_GET['acta_id']) != null) {
               $acta_id = sanitize_text_field($_GET['acta_id']);
               $atributos['subtitulo'] = get_post($acta_id)->post_title;
               $atributos['acta_id'] = $acta_id;
            } else {
               $acta_id = '';
               $atributos['subtitulo'] = '';
               $atributos['acta_id'] = '';
            }
            if (isset($_GET['comite_id']) != null && isset($_GET['acta_id']) != null) {
               $atributos['btn_agregar'] = true;
            } else {
               $atributos['btn_agregar'] = false;
            }
            $atributos['subtitulo2'] = '';
            $atributos['display'] = 'display-6';
            $atributos['displaysub'] = 'display-6';
            $atributos['height'] = '60vh';
            $atributos['div1'] = "row";
            $atributos['div2'] = "col-xl-8";
            $atributos['div3'] = "";
            $atributos['div4'] = "";
            $atributos['div5'] = 'col-xl-4';
            $atributos['agregarpost'] = 'template-parts/acuerdo-mantenimiento';
            $atributos['barra'] = 'template-parts/sca-busquedas';
            break;
         case 'miembro':
            $atributos['titulo'] = 'Miembros';
            $atributos['subtitulo'] = '';
            $atributos['subtitulo2'] = '';
            $atributos['display'] = 'display-4';
            $atributos['displaysub'] = '';
            $atributos['height'] = '60vh';
            $atributos['div1'] = "row";
            $atributos['div2'] = "col-xl-8";
            $atributos['div3'] = "row row-cols-1 row-cols-lg-3 g-2 g-lg-5";
            $atributos['div4'] = "";
            $atributos['div5'] = 'col-xl-4';
            $atributos['agregarpost'] = 'template-parts/miembro-mantenimiento';
            $atributos['barra'] = 'template-parts/sca-busquedas';
            break;
         case 'puesto':
            $atributos['titulo'] = 'Puestos';
            $atributos['subtitulo'] = '';
            $atributos['subtitulo2'] = '';
            $atributos['display'] = 'display-4';
            $atributos['displaysub'] = '';
            $atributos['height'] = '60vh';
            $atributos['div1'] = "row";
            $atributos['div1'] = "row";
            $atributos['div2'] = "col-xl-8";
            $atributos['div3'] = "row row-cols-1 row-cols-lg-3 g-2 g-lg-5";
            $atributos['div4'] = "";
            $atributos['div5'] = 'col-xl-4';
            $atributos['agregarpost'] = 'template-parts/puesto-mantenimiento';
            $atributos['barra'] = 'template-parts/sca-busquedas';
            break;
         case 'movie':
            $atributos['titulo'] = 'Consulta de Películas y Series';
            $atributos['subtitulo'] = '';
            $atributos['subtitulo2'] = '';
            $atributos['div1'] = 'row';
            $atributos['div2'] = 'col-xl-9';
            $atributos['div3'] = 'row row-cols-1 row-cols-lg-4 g-2 g-lg-5';
            $atributos['div4'] = '';
            $atributos['div5'] = 'col-xl-3';
            $atributos['agregarpost'] = ''; //template
            $atributos['barra'] = 'template-parts/movie-barra';
            break;
         default:
            $atributos['titulo'] = 'Indefinido';
            $atributos['subtitulo'] = '';
            $atributos['subtitulo2'] = '';
            $atributos['div1'] = 'row';
            $atributos['div2'] = 'col';
            $atributos['div3'] = '';
            $atributos['div4'] = '';
            $atributos['div5'] = '';
            $atributos['agregarpost'] = '';
            $atributos['barra'] = '';
            break;
      }
      return $atributos;
   }
}
