<?php if (themeframework_get_page_att()['userAdmin']) : ?>
   <div class="row">
      <div class="col-xl-8">
         <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
            <div class="col">
               <div class="card h-100" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
                  <div class="d-flex align-items-center justify-content-center p-4">
                     <div class=""><i class="fa-solid fa-book-open" style="font-size:110px;"></i></div>
                     <div class="ms-3 mb-4">
                        <h4><a class="text-white" href="<?php echo esc_url(get_post_type_archive_link('comite')) . '?cpt=comite' ?>">Mantenimiento de Comités, Actas o Minutas y Acuerdos</a></h4>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col">
               <div class="card h-100" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
                  <div class="d-flex align-items-center justify-content-center p-4">
                     <div class=""><i class="fa-solid fa-circle-user" style="font-size:110px;"></i></div>
                     <div class="ms-3 mb-4">
                        <h4><a class="text-white" href="<?php echo esc_url(site_url('/sca-mantener-miembro')) ?>">Mantenimiento de Membresía</a></h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-4">
         <?php get_template_part(themeframework_get_page_att('comite')['barra']) ?>
      </div>
   </div>
<?php else : ?>
   <?php get_template_part('modules/core/template-parts/cor', 'none', ['fullpage' => false]); ?>
<?php endif; ?>