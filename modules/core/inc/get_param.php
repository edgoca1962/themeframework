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
   function themeframework_get_page_att($postType = '', $fullpage = false)
   {
      $atributos = [];
      $usuario = wp_get_current_user();
      $usuarioRoles = $usuario->roles;

      $userAdmin = '';
      $pag = '';
      $pag_ant = '';
      $imagen = '';
      $height = '';
      $div1 = '';
      $div2 = '';
      $fontweight = '';
      $display = '';
      $displaysub = '';
      $displaysub2 = '';
      $titulo = '';
      $subtitulo = '';
      $subtitulo2 = '';
      $div3 = '';
      $div4 = '';
      $div5 = '';
      $agregarpost = '';
      $barra = '';
      $regresar = '';
      $templateParts = '';
      $templatePartsSingle = '';
      $prefijo = '';
      $consecutivo = '';
      $num_actas = '';
      $num_acuerdos = '';

      if (in_array('administrator', $usuarioRoles) || in_array('author', $usuarioRoles)) {
         $userAdmin = true;
      } else {
         $userAdmin = false;
      }
      if (isset($_GET['cpt'])) {
         $postType = sanitize_text_field($_GET['cpt']);
      }
      if (isset(explode("/", $_SERVER['REQUEST_URI'])[3])) {
         if (explode("/", $_SERVER['REQUEST_URI'])[3] != '') {
            if (explode("/", $_SERVER['REQUEST_URI'])[3] == 'page') {
               $pag = 0; //explode("/", $_SERVER['REQUEST_URI'])[4];
            } else {
               $pag = explode("/", $_SERVER['REQUEST_URI'])[3];
            }
         } else {
            $pag = 0;
         }
      } else {
         $pag = '1';
      }
      if (isset($_GET['pag'])) {
         $pag_ant = sanitize_text_field($_GET['pag']);
      } else {
         $pag_ant = '1';
      }
      /* 
       * =============================
       *    pages & posts
       * =============================
      */

      if (get_the_post_thumbnail_url()) {
         $imagen = get_the_post_thumbnail_url();
      } else {
         $imagen = get_template_directory_uri() . '/assets/img/bg.jpg';
      }
      if ($fullpage) {
         $height = "100vh";
         $fullpage = true;
      } else {
         $height = '60vh';
         $fullpage = false;
         $div1 = 'container py-5';
      }
      if (is_front_page()) {
         $templateParts = 'modules/core/template-parts/cor/';
      } else {
         if (get_the_ID()) {
            $templateParts = 'modules/' . substr(get_post(get_the_ID())->post_name, 0, 3) . '/template-parts/';
         } else {
            $templateParts = 'modules/core/template-parts/';
         }
      }

      $fontweight = 'fw-lighter';
      $titulo = get_the_title();

      switch ($postType) {
         case 'post':
            if (is_single()) {
               $titulo = get_the_title();
            } else {
               $titulo = 'Blog';
               $div3 = 'row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4';
            }
            if (get_the_archive_title() != 'Archives') {
               $subtitulo = str_replace('Tag', 'Clasificación', get_the_archive_title(), $count);
            }
            $templateParts = 'modules/pst/template-parts/' . $postType;
            $templatePartsSingle = 'modules/pst/template-parts/' . $postType . '-single';
            $fontweight = 'fw-lighter';
            $display = 'display-4';
            $height = '60vh';
            $regresar = 'post';
            break;
         case 'comite':
            if (is_single()) {
               $titulo = get_the_title();
            } else {
               $titulo = 'Comités';
            }
            if (get_the_archive_title() == 'Archives') {
               $subtitulo = '';
            } else {
               $subtitulo = str_replace('Tag', 'Clasificación', get_the_archive_title(), $count);
            }
            $fontweight = 'fw-lighter';
            $display = 'display-4';
            $height = '60vh';
            $div1 = "row";
            $div2 = "col-xl-8";
            $div3 = "row row-cols-1 row-cols-lg-2 g-2 g-lg-5";
            $div5 = 'col-xl-4';
            $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
            $barra = 'modules/sca/template-parts/busquedas';
            break;
         case 'acta':
            if (isset($_GET['comite_id']) != null) {
               $comite_id = sanitize_text_field($_GET['comite_id']);
               $comite = get_post($comite_id)->post_title;
               if (preg_match("/Junta/i", $comite)) {
                  $titulo = "Actas de " . $comite;
                  $prefijo = 'Acta';
               } else {
                  $titulo = "Minutas del " . $comite;
                  $prefijo = 'Minuta';
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
            } else {
               $titulo = 'Minutas y Actas';
               $prefijo = 'Minutas o Actas';
            }

            $fontweight = 'fw-lighter';
            $display = 'display-4';
            $height = '60vh';
            $div1 = "row";
            $div2 = "col-xl-8";
            $div3 = "row row-cols-1 row-cols-md-2 g-4 mb-5";
            $div5 = 'col-xl-4';
            $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
            $barra = 'modules/sca/template-parts/busquedas';
            $consecutivo = $qryconsecutivo;
            $num_actas = $num_actas;
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
            }

            if (isset($_GET['comite_id']) != null) {
               $comite_id = sanitize_text_field($_GET['comite_id']);
               $comite = get_post($comite_id)->post_title;
               if (preg_match("/Junta/i", $comite)) {
                  $titulo = "Actas de " . $comite;
               } else {
                  $titulo = "Minutas del " . $comite;
               }
            } else {
               $titulo = 'Acuerdos';
            }
            if (isset($_GET['acta_id']) != null) {
               $acta_id = sanitize_text_field($_GET['acta_id']);
               $subtitulo = get_post($acta_id)->post_title;
            }
            $display = 'display-4';
            $height = '60vh';
            $div1 = "row";
            $div2 = "col-xl-8";
            $div5 = 'col-xl-4';
            $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
            $barra = 'modules/sca/template-parts/busquedas';
            break;
         case 'miembro':
            $titulo = 'Miembros';
            $display = 'display-4';
            $height = '60vh';
            $div1 = "row";
            $div2 = "col-xl-8";
            $div3 = "row row-cols-1 row-cols-lg-3 g-2 g-lg-5";
            $div5 = 'col-xl-4';
            $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
            $barra = 'modules/sca/template-parts/busquedas';
            break;
         case 'puesto':
            $titulo = 'Puestos';
            $display = 'display-4';
            $height = '60vh';
            $div1 = "row";
            $div1 = "row";
            $div2 = "col-xl-8";
            $div3 = "row row-cols-1 row-cols-lg-3 g-2 g-lg-5";
            $div5 = 'col-xl-4';
            $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
            $barra = 'modules/sca/template-parts/busquedas';
            break;
         case 'movie':
            $atributos['titulo'] = 'Consulta de Películas y Series';
            $atributos['div1'] = 'row';
            $atributos['div2'] = 'col-xl-9';
            $atributos['div3'] = 'row row-cols-1 row-cols-lg-4 g-2 g-lg-5';
            $atributos['div5'] = 'col-xl-3';
            $atributos['agregarpost'] = ''; //template
            break;
         default:
            $atributos['titulo'] = 'Indefinido';
            $atributos['div1'] = 'row';
            $atributos['div2'] = 'col';
            break;
      }
      $atributos['userAdmin'] = $userAdmin;
      $atributos['pag'] = $pag;
      $atributos['pag_ant'] = $pag_ant;
      $atributos['imagen'] = $imagen;
      $atributos['height'] = $height;
      $atributos['fontweight'] = $fontweight;
      $atributos['display'] = $display;
      $atributos['displaysub'] = $displaysub;
      $atributos['displaysub2'] = $displaysub2;
      $atributos['titulo'] = $titulo;
      $atributos['subtitulo'] = $subtitulo;
      $atributos['subtitulo2'] = $subtitulo2;
      $atributos['div1'] = $div1;
      $atributos['div2'] = $div2;
      $atributos['div3'] = $div3;
      $atributos['div4'] = $div4;
      $atributos['div5'] = $div5;
      $atributos['agregarpost'] = $agregarpost;
      $atributos['barra'] = $barra;
      $atributos['template-parts'] = $templateParts;
      $atributos['template-parts-single'] = $templatePartsSingle;
      $atributos['regresar'] = $regresar;
      $atributos['prefijo'] =  $prefijo;
      $atributos['consecutivo'] = $consecutivo;
      $atributos['num_actas'] = $num_actas;
      $atributos['num_acuerdos'] = $num_acuerdos;

      return $atributos;
   }
}
