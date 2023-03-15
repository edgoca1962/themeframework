<?php

/******************************************************************************
 * 
 * 
 * Crea las etiquetas del post
 * 
 * 
 *****************************************************************************/
function mcssca_crea_etiquetas_comite($singular = 'Post', $plural = 'Posts')
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
function mcssca_capacidades_comite($singular = 'post', $plural = 'posts')
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
function mcssca_comite_post_type()
{
   $type = 'comite';
   $labels = mcssca_crea_etiquetas_comite('comite', 'comites');
   $capabilities = mcssca_capacidades_comite('comite', 'comites');

   $args = array(
      'capability_type'          => ['comite', 'comites'],
      'map_meta_cap'             => true,
      'labels'                   => $labels,
      'public'                   => true,
      'has_archive'              => true,
      'rewrite'                  => ['slug' => 'comites'],
      'show_in_rest'             => true,
      'rest_base'                => 'comites',
      'menu_icon'                => 'dashicons-book',
      'supports'                 => array('title'),
      // 'taxonomies'               => ['category', 'post_tag'],
   );

   register_post_type($type, $args);
}
add_action('init', 'mcssca_comite_post_type');
/******************************************************************************
 * 
 * 
 * Agrega a comites para consultar por
 * Categorías y etiquetas.
 * 
 * 
 *****************************************************************************/
/*
function comite_taxonomia_filter($query)
{
   if (!is_admin() && $query->is_main_query()) {
      if ($query->is_category() || $query->is_tag()) {
         $query->set('post_type', array('post', 'comite'));
      }
   }
}
add_action('pre_get_posts', 'comite_taxonomia_filter');
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
   $capabilities = mcssca_capacidades_comite('comite', 'comites');
   foreach ($capabilities as $capability) {
      if (!$admin->has_cap($capability)) {
         $admin->add_cap($capability);
      }
   }
});
/******************************************************************************
 * 
 * 
 * Cambia el ordenamiento de los posts tipo comité
 * 
 * 
 *****************************************************************************/
function mcssca_orden_comites($query)
{
   if (!is_admin() && is_post_type_archive() && $query->is_main_query()) {
      $query->set('orderby', ['ID']);
      $query->set('order', 'ASC');
   }
}
add_action('pre_get_posts', 'mcssca_orden_comites');
