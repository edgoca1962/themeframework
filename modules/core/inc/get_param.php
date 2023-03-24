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
      $userAdmin = false;
      $pag = '';
      $pag_ant = '';
      $imagen = '';
      $height = '';
      $fontweight = '';
      $display = '';
      $displaysub = '';
      $displaysub2 = '';
      $titulo = '';
      $subtitulo = '';
      $subtitulo2 = '';
      $div0 = '';
      $div1 = '';
      $div2 = '';
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
      $comite_id = '';
      $num_acuerdos = '';
      $status = '';
      $asignar_id = '';
      $parametros = '';
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
      $display = 'display-4';
      $titulo = get_the_title();
      if (isset($_GET['comite_id'])) {
         $comite_id = sanitize_text_field($_GET['comite_id']);
         $titulo = 'Acuerdos ' . get_post($comite_id)->post_title;
      }
      if (isset($_GET['asignar_id'])) {
         $asignar_id = sanitize_text_field($_GET['asignar_id']);
         $titulo = 'Acuerdos Asignados a ' . get_user_by('ID', $asignar_id)->display_name;
      }
      if ($postType != 'page') {
         switch ($postType) {
            case 'post':
               if (is_single()) {
                  $titulo = 'Blog';
                  $subtitulo = get_the_title();
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
               if (get_the_archive_title() != 'Archives') {
                  $subtitulo = '';
               } else {
                  $subtitulo = str_replace('Tag', 'Clasificación', get_the_archive_title(), $count);
               }
               $fontweight = 'fw-lighter';
               $display = 'display-4';
               $height = '60vh';
               $div0 = 'container py-5';
               $div1 = "row";
               $div2 = "col-xl-8";
               $div3 = "row row-cols-1 row-cols-lg-2 g-2 g-lg-5";
               $div5 = 'col-xl-4';
               $templateParts = 'modules/sca/template-parts/' . $postType;
               $templatePartsSingle = 'modules/sca/template-parts/' . $postType . '-single';
               $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
               $barra = 'modules/sca/template-parts/sca-busquedas';
               $regresar = 'comite';
               break;
            case 'acta':
               if (is_single()) {
                  $titulo = get_the_title();
               }
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
                  $qryconsecutivo = 0;
               }
               $fontweight = 'fw-lighter';
               $display = 'display-4';
               $height = '60vh';
               $div0 = 'container py-5';
               $div1 = "row";
               $div2 = "col-xl-8";
               $div3 = "row row-cols-1 row-cols-md-2 g-4 mb-5";
               $div5 = 'col-xl-4';
               $templateParts = 'modules/sca/template-parts/' . $postType;
               $templatePartsSingle = 'modules/sca/template-parts/' . $postType . '-single';
               $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
               $barra = 'modules/sca/template-parts/sca-busquedas';
               $consecutivo = $qryconsecutivo;
               $num_actas = $num_actas;
               $regresar = 'acta';
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
                  $parametros = 'acta_id=' . $acta_id . '&comite_id=' . $comite_id;
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
                  $titulo = 'Consulta de Acuerdos';
               }
               if (isset($_GET['acta_id']) != null) {
                  $acta_id = sanitize_text_field($_GET['acta_id']);
                  if (get_post($acta_id)) {
                     $subtitulo = get_post($acta_id)->post_title;
                  }
               }
               if (isset($_GET['vigencia'])) {
                  $vigencia = sanitize_text_field($_GET['vigencia']);
                  if (isset($_GET['comite_id'])) {
                     $comite_id = sanitize_text_field($_GET['comite_id']);
                     $titulo = 'Acuerdos ' . get_post($comite_id)->post_title;
                     $parametros = 'vigencia=' . $vigencia . '&comite_id=' . $comite_id;
                  }
                  if (isset($_GET['asignar_id'])) {
                     $asignar_id = sanitize_text_field($_GET['asignar_id']);
                     $titulo = 'Acuerdos asignados a ' . get_user_by('ID', $asignar_id)->display_name;
                     $parametros = 'vigencia=' . $vigencia . '&asignar_id=' . $asignar_id;
                  }
                  switch ($vigencia) {
                     case '1':
                        $subtitulo = 'Acuerdos Vencidos';
                        $status = 'Vencido';
                        break;

                     case '2':
                        $subtitulo = 'Acuerdos Vigentes';
                        $status = 'Vence este mes';
                        break;

                     case '3':
                        $subtitulo = 'Acuerdos en Proceso';
                        $status = 'Proceso';
                        break;

                     case '4':
                        $subtitulo = 'Acuerdos Ejecutados';
                        break;

                     default:
                        # code...
                        break;
                  }
               }
               if (is_single()) {
                  $titulo = get_the_title();
                  $display = '';
               } else {
                  $display = 'display-4';
               }
               $displaysub = 'display-5';
               $height = '60vh';
               $div0 = 'container py-5';
               $div1 = "row";
               $div2 = "col-xl-8";
               $div5 = 'col-xl-4';
               $templateParts = 'modules/sca/template-parts/' . $postType;
               $templatePartsSingle = 'modules/sca/template-parts/' . $postType . '-single';
               $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
               $barra = 'modules/sca/template-parts/sca-busquedas';
               $regresar = 'acuerdo';
               break;
            case 'miembro':
               $titulo = 'Miembros';
               $display = 'display-4';
               $height = '60vh';
               $div0 = 'container py-5';
               $div1 = "row";
               $div2 = "col-xl-8";
               $div3 = "row row-cols-1 row-cols-lg-3 g-2 g-lg-5";
               $div5 = 'col-xl-4';
               $templateParts = 'modules/sca/template-parts/' . $postType;
               $templatePartsSingle = 'modules/sca/template-parts/' . $postType . '-single';
               $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
               $barra = 'modules/sca/template-parts/sca-busquedas';
               $regresar = 'miembro';
               break;
            case 'puesto':
               $titulo = 'Puestos';
               $display = 'display-4';
               $height = '60vh';
               $div0 = 'container py-5';
               $div1 = "row";
               $div2 = "col-xl-8";
               $div3 = "row row-cols-1 row-cols-lg-3 g-2 g-lg-5";
               $div5 = 'col-xl-4';
               $templateParts = 'modules/sca/template-parts/' . $postType;
               $templatePartsSingle = 'modules/sca/template-parts/' . $postType . '-single';
               $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
               $barra = 'modules/sca/template-parts/sca-busquedas';
               $regresar = 'puesto';
               break;
            case 'movie':
               $titulo = 'Consulta de Películas y Series';
               $display = 'display-4';
               $height = '60vh';
               $div0 = 'container py-5';
               $div1 = 'row';
               $div2 = 'col-xl-9';
               $div3 = 'row row-cols-1 row-cols-lg-4 g-2 g-lg-5';
               $div5 = 'col-xl-3';
               break;
            default:
               $titulo = 'Indefinido';
               $div0 = 'container py-5';
               $div1 = 'row';
               $div2 = 'col';
               break;
         }
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
      $atributos['div0'] = $div0;
      $atributos['div1'] = $div1;
      $atributos['div2'] = $div2;
      $atributos['div3'] = $div3;
      $atributos['div4'] = $div4;
      $atributos['div5'] = $div5;
      $atributos['template-parts'] = $templateParts;
      $atributos['agregarpost'] = $agregarpost;
      $atributos['barra'] = $barra;
      $atributos['template-parts-single'] = $templatePartsSingle;
      $atributos['regresar'] = $regresar;
      $atributos['prefijo'] =  $prefijo;
      $atributos['consecutivo'] = $consecutivo;
      $atributos['comite_id'] = $comite_id;
      $atributos['num_actas'] = $num_actas;
      $atributos['num_acuerdos'] = $num_acuerdos;
      $atributos['status'] = $status;
      $atributos['asignar_id'] = $asignar_id;
      $atributos['parametros'] = $parametros;
      return $atributos;
   }
}
