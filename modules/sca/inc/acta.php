<?php

/******************************************************************************
 * 
 * 
 * Crea las etiquetas del post
 * 
 * 
 *****************************************************************************/
function mcssca_crea_etiquetas_acta($singular = 'Post', $plural = 'Posts')
{
   $p_lower = strtolower($plural);
   $s_lower = strtolower($singular);

   return [
      'name'                     => _x($plural, 'post type general name', 'mcssca'),
      'singular_name'            => _x($singular, 'post type singular name', 'mcssca'),
      'menu_name'                => _x($plural, 'admin menu', 'mcssca'),
      'name_admin_bar'           => _x($singular, 'add new on admin bar', 'mcssca'),
      'add_new'                  => _x("Nuevo $singular", 'prayer', 'mcssca'),
      'add_new_item'             => __("Agregar $singular", 'mcssca'),
      'new_item'                 => __("Nuevo $singular", 'mcssca'),
      'edit_item'                => __("Editar $singular", 'mcssca'),
      'view_item'                => __("Ver $singular", 'mcssca'),
      'view_items'               => __("Ver $plural", 'mcssca'),
      'all_items'                => __("Todos $plural", 'mcssca'),
      'search_items'             => __("Buscar $plural", 'mcssca'),
      'parent_item_colon'        => __("Parent $singular", 'mcssca'),
      'not_found'                => __("No $p_lower found", 'mcssca'),
      'not_found_in_trash'       => __("No $p_lower found in trash", 'mcssca'),
      'archives'                 => __("$singular Archives", 'mcssca'),
      'attributes'               => __("$singular Attributes", 'mcssca'),
      'insert_into_item'         => __("Insertar $s_lower", 'mcssca'),
      'uploaded_to_this_item'    => __("Adjuntar a un $s_lower", 'mcssca'),
   ];
}
/******************************************************************************
 * 
 * 
 * Aplica capacidades al post
 * 
 * 
 *****************************************************************************/
function mcssca_capacidades_acta($singular = 'post', $plural = 'posts')
{
   return [
      'edit_post'                => "edit_$singular",
      'read_post'                => "read_$singular",
      'delete_post'              => "delete_$singular",
      'edit_posts'               => "edit_$plural",
      'edit_others_posts'        => "edit_others_$plural",
      'publish_posts'            => "publish_$plural",
      'read_private_posts'       => "read_private_$plural",
      'read'                     => "read",
      'delete_posts'             => "delete_$plural",
      'delete_private_posts'     => "delete_private_$plural",
      'delete_published_posts'   => "delete_published_$plural",
      'delete_others_posts'      => "delete_others_$plural",
      'edit_private_posts'       => "edit_private_$plural",
      'edit_published_posts'     => "edit_published_$plural",
      'create_posts'             => "edit_$plural",
   ];
}
/******************************************************************************
 * 
 * 
 * Crea el post personalizado
 * 
 * 
 *****************************************************************************/
function mcssca_acta_post_type()
{
   $type = 'acta';
   $labels = mcssca_crea_etiquetas_acta('Acta', 'Actas');
   $capabilities = mcssca_capacidades_acta('acta', 'actas');

   $args = array(
      'capability_type'          => ['acta', 'actas'],
      'map_meta_cap'             => true,
      'labels'                   => $labels,
      'public'                   => true,
      'has_archive'              => true,
      'rewrite'                  => ['slug' => 'actas'],
      'show_in_rest'             => true,
      'rest_base'                => 'actas',
      'menu_icon'                => 'dashicons-book',
      'supports'                 => array('title', 'custom-fields'),
      // 'taxonomies'               => ['category', 'post_tag'],
   );

   register_post_type($type, $args);
}
add_action('init', 'mcssca_acta_post_type');
/******************************************************************************
 * 
 * 
 * Agrega a actas para consultar por
 * Categorías y etiquetas.
 * 
 * 
 *****************************************************************************/
/*
 function acta_taxonomia_filter($query)
{
   if (!is_admin() && $query->is_main_query()) {
      if ($query->is_category() || $query->is_tag()) {
         $query->set('post_type', array('post', 'acta'));
      }
   }
}
add_action('pre_get_posts', 'acta_taxonomia_filter');
*/

/******************************************************************************
 * 
 * 
 * Creación de campos personalizados 
 * 
 * 
 *****************************************************************************/
function mcssca_crear_campos_acta()
{

   add_meta_box(
      'n_acta',
      'Número de acta',
      'mcssca_crear_n_acta_cbk',
      'acta',
      'normal',
      'default'
   );

   function mcssca_crear_n_acta_cbk($post)
   {
      wp_nonce_field('n_acta_nonce', 'n_acta_nonce');
      $n_acta = get_post_meta($post->ID, '_n_acta', true);
      echo '<input type="number" style="width:20%" id="n_acta" name="n_acta" value="' . esc_attr($n_acta) . '" </input>';
   }

   add_meta_box(
      'f_acta',
      'Fecha de acta',
      'mcssca_crear_f_acta_cbk',
      'acta',
      'normal',
      'default'
   );
   function mcssca_crear_f_acta_cbk($post)
   {
      wp_nonce_field('f_acta_nonce', 'f_acta_nonce');
      $f_acta = get_post_meta($post->ID, '_f_acta', true);
      echo '<input type="date" style="width:20%" id="f_acta" name="f_acta" value="' . esc_attr($f_acta) . '" >';
   }

   add_meta_box(
      'comite_id',
      'ID Comité',
      'mcssca_crear_comite_id_acta_cbk',
      'acta',
      'normal',
      'default'
   );

   function mcssca_crear_comite_id_acta_cbk($post)
   {
      wp_nonce_field('comite_id_nonce', 'comite_id_nonce');
      $comite_id = get_post_meta($post->ID, '_comite_id', true);
?>
      <select name="comite_id" id="comite_id" class="form-select" aria-label="Selecionar miembro">
         <option <?= (get_post_meta($post->ID, '_comite_id', true) == '') ? 'value="0" selected' : 'value="0"' ?>>Sin asignar</option>
         <?php
         $comites = get_posts(['post_type' => 'comite', 'posts_per_page' => -1, 'post_status' => 'publish',]);
         foreach ($comites as $comite) {
         ?>
            <option <?php echo (get_post_meta($post->ID, '_comite_id', true) == $comite->ID) ? 'value="' . esc_attr($comite->ID) . '" Selected' : 'value="' . $comite->ID . '"' ?>><?php echo $comite->post_title ?></option>
         <?php
         }
         ?>
      </select>
<?php
   }
}
add_action('add_meta_boxes', 'mcssca_crear_campos_acta');
/******************************************************************************
 * 
 * 
 * Rutinas para editar y guardar la 
 * información de los campos personalizados
 * en el editor de WP.
 * 
 * 
 *****************************************************************************/
function mcssca_guardar_n_acta($post_id)
{
   if (!isset($_POST['n_acta_nonce'])) {
      return;
   }
   if (!wp_verify_nonce($_POST['n_acta_nonce'], 'n_acta_nonce')) {
      return;
   }
   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
   }
   if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
      if (!current_user_can('edit_page', $post_id)) {
         return;
      }
   } else {
      if (!current_user_can('edit_post', $post_id)) {
         return;
      }
   }
   if (!isset($_POST['n_acta'])) {
      return;
   }
   $n_acta = sanitize_text_field($_POST['n_acta']);
   update_post_meta($post_id, '_n_acta', $n_acta);
}
add_action('save_post', 'mcssca_guardar_n_acta');

function mcssca_guardar_f_acta($post_id)
{
   if (!isset($_POST['f_acta_nonce'])) {
      return;
   }
   if (!wp_verify_nonce($_POST['f_acta_nonce'], 'f_acta_nonce')) {
      return;
   }
   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
   }
   if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
      if (!current_user_can('edit_page', $post_id)) {
         return;
      }
   } else {
      if (!current_user_can('edit_post', $post_id)) {
         return;
      }
   }
   if (!isset($_POST['f_acta'])) {
      return;
   }
   $f_acta = sanitize_text_field($_POST['f_acta']);
   update_post_meta($post_id, '_f_acta', $f_acta);
}
add_action('save_post', 'mcssca_guardar_f_acta');

function mcssca_guardar_comite_id_acta($post_id)
{
   if (!isset($_POST['comite_id_nonce'])) {
      return;
   }
   if (!wp_verify_nonce($_POST['comite_id_nonce'], 'comite_id_nonce')) {
      return;
   }
   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
   }
   if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
      if (!current_user_can('edit_page', $post_id)) {
         return;
      }
   } else {
      if (!current_user_can('edit_post', $post_id)) {
         return;
      }
   }
   if (!isset($_POST['comite_id'])) {
      return;
   }
   $comite_id = sanitize_text_field($_POST['comite_id']);
   update_post_meta($post_id, '_comite_id', $comite_id);
}
add_action('save_post', 'mcssca_guardar_comite_id_acta');
/******************************************************************************
 * 
 * 
 * Muestra los campos personalizados
 * en la REST API.
 * 
 * 
 *****************************************************************************/
function mcssca_agregar_acta_meta_fields()
{

   register_meta('post', '_comite_id', array(
      'type' => 'string',
      'description' => 'comite',
      'single' => true,
      'show_in_rest' => true
   ));
}
add_action('rest_api_init', 'mcssca_agregar_acta_meta_fields');

if (!function_exists('mcssca_acta_meta_request_params')) {
   function mcssca_acta_meta_request_params($args, $request)
   {
      $args += array(
         'meta_key'   => $request['meta_key'],
         'meta_value' => $request['meta_value'],
         'meta_query' => $request['meta_query'],
      );
      return $args;
   }
   add_filter('rest_acta_query', 'mcssca_acta_meta_request_params', 99, 2);
}
/******************************************************************************
 * 
 * 
 * Crea roles para usuarios
 * 
 * 
 *****************************************************************************/
/*
 add_action('init', function () {
   if (!get_role('actas')) {
      add_role('actas', 'actas');
   }
});
*/
/******************************************************************************
 * 
 * 
 * Otorga facultados a los roles para los custom posts type
 * 
 * 
 *****************************************************************************/
add_action('init', function () {
   $admin = get_role('administrator');
   $capabilities = mcssca_capacidades_acta('acta', 'actas');
   foreach ($capabilities as $capability) {
      if (!$admin->has_cap($capability)) {
         $admin->add_cap($capability);
      }
   }
});
