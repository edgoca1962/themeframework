<h3>Pruebas</h3>
<select name="" id="">
   <option value="Januray">Enero</option>
   <option value="February">Febrero</option>
   <option value="March">Marzo</option>
   <option value="April">Abril</option>
   <option value="May">May</option>
   <option value="June">Junio</option>
   <option value="July">Julio</option>
   <option value="August">Agosto</option>
   <option value="September">Septiembre</option>
   <option value="October">Octubre</option>
   <option value="November">Noviembre</option>
   <option value="December">Diciembre</option>
</select>
<br>
<?php
function cpt_wp_get_archives($cpt)
{
   // Configure the output
   $args = array(
      'format'          => 'custom',
      'before'          => '<li class="post-list__item post-list__item--archive">',
      'after'           => '</li>',
      'echo'            => 0,
      'show_post_count' => true
   );
   // Get the post type objest
   $post_type_obj = get_post_type_object($cpt);
   // Slug might not be the cpt name, it might have custom slug, so get it
   $post_type_slug = $post_type_obj->rewrite['slug'];
   // Domain of the current site
   $host = $_SERVER['HTTP_HOST'];
   // Replace `domain.tld` with `domain.tdl/{cpt-slug}`
   $output = str_replace($host, "$host/$post_type_slug", wp_get_archives($args));

   return $output;
}
echo cpt_wp_get_archives('evento');
?>