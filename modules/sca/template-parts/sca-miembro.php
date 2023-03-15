<?php
if (get_the_post_thumbnail_url()) {
   $imagen = get_the_post_thumbnail_url();
} else {
   $imagen = get_template_directory_uri() . '/assets/img/bg.jpeg';
}
?>
<div class="col">
   <div class="card shadowcss h-100 text-dark">
      <div class="card-body">
         <h4 class="card-title"><?php the_title() ?></h4>
      </div>
   </div>
</div>