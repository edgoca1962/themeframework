<?php $usuario = wp_get_current_user() ?>
<div class="row">
   <div class="col-xl-8">
      <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
         <div class="col">
            <div class="card h-100" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=1&comite_id=' . themeframework_get_page_att('acuerdo')['comite_id'] ?>">Acuerdos Vencidos</a>
                        <span class="ms-1">(
                           <?php
                           if (verAcuerdos()[themeframework_get_page_att('acuerdo')['comite_id']] == 'asignados') {
                              echo totalAcuerdosComiteUsr(themeframework_get_page_att('acuerdo')['comite_id'], $usuario->ID)['vencidos'];
                           } else {
                              echo totalAcuerdosComite(themeframework_get_page_att('acuerdo')['comite_id'])['vencidos'];
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
                     <h5><a class="text-white" href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=2&comite_id=' . themeframework_get_page_att('acuerdo')['comite_id'] ?>">Acuerdos por vencer este mes</a>
                        <span class="ms-1">(
                           <?php
                           if (verAcuerdos()[themeframework_get_page_att('acuerdo')['comite_id']] == 'asignados') {
                              echo totalAcuerdosComiteUsr(themeframework_get_page_att('acuerdo')['comite_id'], $usuario->ID)['porvencer'];
                           } else {
                              echo totalAcuerdosComite(themeframework_get_page_att('acuerdo')['comite_id'])['porvencer'];
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
                     <h5><a class="text-white" href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=3&comite_id=' . themeframework_get_page_att('acuerdo')['comite_id'] ?>">Acuerdos en proceso</a>
                        <span class="ms-1">(
                           <?php
                           if (verAcuerdos()[themeframework_get_page_att('acuerdo')['comite_id']] == 'asignados') {
                              echo totalAcuerdosComiteUsr(themeframework_get_page_att('acuerdo')['comite_id'], $usuario->ID)['proceso'];
                           } else {
                              echo totalAcuerdosComite(themeframework_get_page_att('acuerdo')['comite_id'])['proceso'];
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
                     <h5><a class="text-white" href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=4&comite_id=' . themeframework_get_page_att('acuerdo')['comite_id'] ?>">Acuerdos Ejecutados</a>
                        <span class="ms-1">(
                           <?php
                           if (verAcuerdos()[themeframework_get_page_att('acuerdo')['comite_id']] == 'asignados') {
                              echo totalAcuerdosComiteUsr(themeframework_get_page_att('acuerdo')['comite_id'], $usuario->ID)['ejecutados'];
                           } else {
                              echo totalAcuerdosComite(themeframework_get_page_att('acuerdo')['comite_id'])['ejecutados'];
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
      <?php get_template_part(themeframework_get_page_att('acuerdo')['barra']) ?>
   </div>
</div>