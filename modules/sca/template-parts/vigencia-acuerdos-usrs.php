<?php $usuario = sanitize_text_field($_GET['id']) ?>
<h2 class="mb-5 animate__animated animate__fadeInLeft">Consulta de Acuerdos para <?php echo get_user_by('ID', $usuario)->display_name ?></h2>
<div class="row">
   <div class="col-xl-8">
      <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo esc_url(site_url('/sca-vigencia-acuerdos')) . '?id=1&id1=99&id2=' . $usuario ?>">Acuerdos Vencidos</a><span class="ms-1">(<?php echo totalAcuerdosUsr($usuario)['vencidos']; ?>)</span></h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo esc_url(site_url('/sca-vigencia-acuerdos')) . '?id=2&id1=99&id2=' . $usuario ?>">Acuerdos por vencer este mes</a><span class="ms-1">(<?php echo totalAcuerdosUsr($usuario)['porvencer']; ?>)</span></h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo esc_url(site_url('/sca-vigencia-acuerdos')) . '?id=3&id1=99&id2=' . $usuario ?>">Acuerdos en proceso</a><span class="ms-1">(<?php echo totalAcuerdosUsr($usuario)['proceso']; ?>)</span></h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo esc_url(site_url('/sca-vigencia-acuerdos')) . '?id=4&id1=99&id2=' . $usuario ?>">Acuerdos Ejecutados</a><span class="ms-1">(<?php echo totalAcuerdosUsr($usuario)['ejecutados']; ?>)</span></h5>
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