<div id="elemento_<?php echo get_the_ID() ?>" class="col">
   <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important; color: #fff;">
      <div class="d-flex p-4">
         <div class=""><i class="fas fa-users" style="font-size:55px;"></i></div>
         <div class="d-flex ms-3 mb-4">
            <a id="enlace_elemento_<?php echo get_the_ID() ?>" class="text-white" href="<?php echo get_post_type_archive_link('acta') . '?cpt=acta&comite_id=' . get_the_ID() ?>">
               <h4 class="mb-0">
                  <?php the_title() ?>
               </h4>
            </a>
         </div>
      </div>
      <div class="d-flex px-3">
         <?php
         $miembros = get_posts(
            [
               'numberposts' => -1,
               'post_type' => 'miembro',
               'post_status' => 'publish',
               'meta_key' => '_comite_id',
               'meta_value' => get_the_ID()
            ]
         );
         $actas = get_posts(
            [
               'numberposts' => -1,
               'post_type' => 'acta',
               'post_status' => 'publish',
               'meta_key' => '_comite_id',
               'meta_value' => get_the_ID()
            ]
         );
         $acuerdos = get_posts([
            'numberposts' => -1,
            'post_type' => 'acuerdo',
            'post_status' => 'publish',
            'meta_key' => '_comite_id',
            'meta_value' => get_the_ID()
         ]);
         ?>
         <p class="me-3"><i class="fas fa-users"></i> Miembros: <?php echo count($miembros) ?></p>
         <p class="me-3"><i class="fa-solid fa-book-open"></i> <?php echo (substr(get_the_title(), 0, 5) == 'Junta') ? 'Actas' : 'Minutas' ?> <?php echo count($actas) ?></p>
         <p class="me-3"><i class="fa-solid fa-handshake"></i> Acuerdos: <?php echo count($acuerdos) ?></p>
      </div>
      <?php if (themeframework_get_page_att($post->post_type)['userAdmin']) { ?>
         <div class="d-flex card-footer">
            <!-- Button trigger modal editar -->
            <button type="button" class="btn btn-outline-warning btn-sm me-3" data-bs-toggle="modal" data-bs-target="#editar" data-editar="<?php echo get_the_ID() ?>" data-url="<?php echo get_site_url() . '/wp-json/wp/v2/comites/' . get_the_ID() ?>">
               <i class="fa-solid fa-pencil" style="font-size: 12px;"></i> Editar
            </button>

            <button type="button" class="btn btn-outline-danger btn-sm" data-post_id="<?php echo get_the_ID() ?>" data-eliminar="elemento_<?php echo get_the_ID() ?>"><i class="fa-solid fa-trash-can" style="font-size: 12px;"></i> Eliminar</button>
            <form id="<?php echo get_the_ID() ?>">
               <input type="hidden" name="action" value="eliminar_comite">
               <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('eliminar_comite') ?>">
               <input type="hidden" name="endpoint" value="<?php echo admin_url('admin-ajax.php') ?>">
               <input type="hidden" name="post_id" value="<?php echo get_the_ID() ?>">
            </form>

            <input id="titulo_elemento_<?php echo get_the_ID() ?>" class="invisible" type="hidden" value="<?php the_title() ?>">
            <input id="msg_elemento_<?php echo get_the_ID() ?>" class="invisible" type="hidden" value="Si elimina este COMITÉ se eliminarán también todas sus ACTAS y ACUERDOS.">
            <input id="msg2_elemento_<?php echo get_the_ID() ?>" class="invisible" type="hidden" value="El comité, los miembros, sus actas y acuerdos han sido eliminados.">
         </div>
      <?php } ?>
   </div>
</div>