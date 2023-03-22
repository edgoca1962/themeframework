<?php

$comite = sanitize_text_field($_GET['id']);
$usuario = wp_get_current_user();
$roles = $usuario->roles;

$miembros = get_posts([
   'post_type' => 'miembro',
   'numberposts' => -1,
   'post_status' => 'publish',
   'meta_key' => '_usr_id',
   'meta_value' => $usuario->ID,
]);

$verAcuerdosComite = [];
if (in_array('administrator', $roles) || in_array('author', $roles)) {
   // $usrAdmin = true;
   $comiteUsr = false;
} else {
   if (count($miembros)) {
      foreach ($miembros as $miembro) {
         if ($usuario->ID == get_post_meta($miembro->ID, '_usr_id', true)) {
            if (preg_match("/Junta/i", $miembro->post_title)) {
               $comiteUsr = false;
            } else {
               if (preg_match("/Coordina/i", $miembro->post_title)) {
                  if (get_post_meta($miembro->ID, '_comite_id', true) == $comite) {
                     $comiteUsr = false;
                  } else {
                     $comiteUsr = true;
                  }
               } else {
                  $comiteUsr = true;
               }
            }
         }
      }
   } else {
      $comiteUsr = true;
   }
}
?>
<h2 class="mb-5 animate__animated animate__fadeInLeft">Consulta de Acuerdos: <?php echo get_post($comite)->post_title ?></h2>
<div class="row">
   <div class="col-xl-8">
      <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <!-- . '&id2=' . ($comiteUsr) ? $usuario->ID : '99' -->
                     <h5><a class="text-white" href="<?php echo esc_url(site_url('/sca-vigencia-acuerdos')) . '?id=1&id1=' . $comite . '&id2=' . (($comiteUsr) ? $usuario->ID : '99') ?>">Acuerdos Vencidos</a>
                        <span class="ms-1">(
                           <?php
                           if ($comiteUsr) {
                              echo totalAcuerdosComiteUsr($comite, $usuario->ID)['vencidos'];
                           } else {
                              echo totalAcuerdosComite($comite)['vencidos'];
                           }
                           ?>)
                        </span>
                     </h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo esc_url(site_url('/sca-vigencia-acuerdos')) . '?id=2&id1=' . $comite . '&id2=' . (($comiteUsr) ? $usuario->ID : '99') ?>">Acuerdos por vencer este mes</a>
                        <span class="ms-1">(
                           <?php
                           if ($comiteUsr) {
                              echo totalAcuerdosComiteUsr($comite, $usuario->ID)['porvencer'];
                           } else {
                              echo totalAcuerdosComite($comite)['porvencer'];
                           }
                           ?>)
                        </span>
                     </h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo esc_url(site_url('/sca-vigencia-acuerdos')) . '?id=3&id1=' . $comite . '&id2=' . (($comiteUsr) ? $usuario->ID : '99') ?>">Acuerdos en proceso</a>
                        <span class="ms-1">(
                           <?php
                           if ($comiteUsr) {
                              echo totalAcuerdosComiteUsr($comite, $usuario->ID)['proceso'];
                           } else {
                              echo totalAcuerdosComite($comite)['proceso'];
                           }
                           ?>)
                        </span>
                     </h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo esc_url(site_url('/sca-vigencia-acuerdos')) . '?id=4&id1=' . $comite . '&id2=' . (($comiteUsr) ? $usuario->ID : '99') ?>">Acuerdos Ejecutados</a>
                        <span class="ms-1">(
                           <?php
                           if ($comiteUsr) {
                              echo totalAcuerdosComiteUsr($comite, $usuario->ID)['ejecutados'];
                           } else {
                              echo totalAcuerdosComite($comite)['ejecutados'];
                           }
                           ?>)
                        </span>
                     </h5>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-4">
      <?php get_template_part('template-parts/sca-busquedas') ?>
   </div>
</div>