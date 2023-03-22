<?php

$usuario = wp_get_current_user();
$roles = $usuario->roles;

$comites = get_posts([
   'post_type' => 'comite',
   'numberposts' => -1,
   'post_status' => 'publish',
   'orderby' => 'ID',
   'order' => 'ASC'
]);

$datosComite = [];
array_push($datosComite, ['ID' => 'todos', 'nombre' => 'Resumen General']);
foreach ($comites as $comite) {
   array_push($datosComite, ['ID' => $comite->ID, 'nombre' => get_post($comite)->post_title]);
}

?>
<div class="row">
   <div class="col-xl-8">
      <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
         <input id="pagina" type="hidden" value="<?php echo esc_url(site_url('/vigencia-acuerdos-comite')) ?>">
         <input id="comites" type="hidden" value="<?php echo count($comites) + 1 ?>">
         <?php $i = 0 ?>
         <?php foreach ($datosComite as $comite) { ?>
            <?php
            $nombreComite = $comite['nombre'];
            $totalAcuerdos = totalAcuerdos($comite['ID']);
            ?>
            <div class="col">
               <div class="card text-black">
                  <div class="card-body">
                     <h5 class="card-title"><?php echo $nombreComite ?></h5>
                     <input id="comite_grafico_<?php echo $i ?>" type="hidden" value="<?php echo $comite['ID'] ?>">
                     <input id="valgra_<?php echo $i ?>" type="hidden" value='<?php echo json_encode($totalAcuerdos) ?>'>
                     <canvas id="grafico_<?php echo $i ?>" class="rounded-2" width="400" height="400"></canvas>
                  </div>
               </div>
            </div>
            <?php $i = $i + 1 ?>
         <?php } ?>
      </div>
   </div>
   <div class="col-xl-4">
      <?php get_template_part('template-parts/sca-busquedas') ?>
   </div>
</div>