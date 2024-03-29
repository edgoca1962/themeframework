<?php $usuario = wp_get_current_user() ?>
<div class="row mb-5">
   <div class="position-relative">
      <form id="frmbuscar" class="d-flex">
         <input id="impbuscar" class="form-control w-100 me-2" type="text" style="width: 0;" placeholder="Buscar Acuerdo" aria-label="Search">
      </form>
      <div id="resultados" class="container invisible position-absolute search-overlay rounded-3 w-100" style="background-color: rgba(17, 153, 142, 1); height:300px;">
         <div class="d-flex justify-content-between">
            <h5>Resultados</h5><span id="btn_cerrar"><i class="far fa-times-circle"></i></span>
         </div>
         <div id="resultados_busqueda" data-url="<?= get_site_url() . '/wp-json/wp/v2/acuerdos?search=' ?>" data-msg="No se encontraron acuerdos"></div>
      </div>

   </div>
</div>
<div class="row ms-3 mb-5">
   <h5>Acuerdos por Estatus</h5>
   <div class="row">
      <div class="col">
         <a href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=1&asignar_id=' . $usuario->ID ?>">Acuerdos vencidos</a>
         <span class="ms-1">(<?php echo totalAcuerdosUsr($usuario->ID)['vencidos']; ?>)
         </span>
      </div>
   </div>
   <div class="row">
      <div class="col">
         <a href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=2&asignar_id=' . $usuario->ID ?>">Acuerdos por vencer este mes</a><span class="ms-1">(<?php echo totalAcuerdosUsr($usuario->ID)['porvencer']; ?>)</span>
      </div>
   </div>
   <div class="row">
      <div class="col">
         <a href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=3&asignar_id=' . $usuario->ID ?>">Acuerdos en proceso</a><span class="ms-1">(<?php echo totalAcuerdosUsr($usuario->ID)['proceso']; ?>)</span>
      </div>
   </div>
   <div class="row">
      <div class="col">
         <a href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=4&asignar_id=' . $usuario->ID ?>">Acuerdos Ejecutados</a><span class="ms-1">(<?php echo totalAcuerdosUsr($usuario->ID)['ejecutados']; ?>)</span>
      </div>
   </div>
</div>
<div class="row ms-3 mb-5">
   <div class="col">
      <h5>Acuerdos por Comité</h5>
      <div class="row row-cols-1">
         <?php $verAcuerdos = verAcuerdos(); ?>
         <?php foreach ($verAcuerdos as $comiteid => $facultad) { ?>
            <?php $totalAcuerdos = ($facultad == 'todos') ? totalAcuerdosComiteFiltrados($comiteid, $usuario->ID, false) : totalAcuerdosComiteFiltrados($comiteid, $usuario->ID, true); ?>
            <div class="col">
               <a href="<?php echo esc_url(site_url('/sca-vigencia-acuerdos-comite')) . '?comite_id=' . $comiteid ?>">
                  <?php echo get_post($comiteid)->post_title ?>
               </a>
               <span class="ms-1">(
                  <?php echo $totalAcuerdos ?>)</span>
            </div>
         <?php } ?>
      </div>
   </div>
</div>
<?php if (themeframework_get_page_att()['userAdmin'] || themeframework_miembroJunta()) : ?>

   <div class="row ms-3 mb-5">
      <div class="col">
         <h5>Acuerdos asignados a:</h5>
         <div class="row row-cols-1">
            <?php
            $usuarios = get_users(['orderby' => 'display_name']);
            foreach ($usuarios as $usr) {
               $qryacuerdos = get_posts(
                  [
                     'post_type'  => 'acuerdo',
                     'numberposts' => -1,
                     'post_status' => 'publish',
                     'meta_key' => '_asignar_id',
                     'meta_value' => $usr->ID,
                  ]
               );
            ?>
               <?php if (count($qryacuerdos)) : ?>
                  <div class="col">
                     <a href="<?php echo esc_url(site_url('/sca-vigencia-acuerdos-usrs')) . '?asignar_id=' . $usr->ID ?>">
                        <?php echo $usr->display_name ?>
                     </a>
                     <span class="ms-1">(<?php echo count($qryacuerdos) ?>)</span>
                  </div>
               <?php endif; ?>
            <?php
            }
            ?>
         </div>
      </div>
   <?php endif; ?>