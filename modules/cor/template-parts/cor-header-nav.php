<header>
   <nav id="main_navbar" class="navbar navbar-expand-lg navbar-dark fixed-top shadow text-white" data-menubg="no">
      <div class="container">
         <div id="logo" class="logo">
            <?php
            if (has_custom_logo()) { ?>
               <div class="d-flex justify-content-center">
                  <a href="<?= esc_url(site_url('/')) ?>">
                     <img class="img-thumbnail rounded-circle" style="width: 100px; height:auto;" src="<?= wp_get_attachment_image_src(get_theme_mod('custom_logo'))[0] ?>" alt="Logo" class="shadowcss">
                  </a>
               </div>
            <?php
            }
            ?>
         </div>
         <button id="btnmenu" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="justify-content-end collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link <?php if (is_page('front-page')) echo 'active' ?>" aria-current="page" href="<?php echo esc_url(site_url('/')) ?>">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle 
                  <?php if (isset($_GET['menu'])) {
                     $menu_id = intval(sanitize_text_field($_GET['menu']));
                     if ($menu_id > 30000 & $menu_id < 40000) {
                        echo 'active';
                     }
                  } ?>" href="#" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
                     Dropdown
                  </a>
                  <ul class="dropdown-menu">
                     <li class="dropstart">
                        <a href="#" class="dropdown-item dropdown-toggle
                        <?php if (isset($_GET['menu'])) {
                           $menu_id = intval(sanitize_text_field($_GET['menu']));
                           if ($menu_id > 31000 & $menu_id < 32000) {
                              echo 'active';
                           }
                        } ?>" data-bs-auto-close="outside" data-bs-toggle="dropdown">Submenu</a>
                        <ul class="dropdown-menu">
                           <li><a href="<?php echo esc_url(site_url('/sample-page')) . '?menu=31100' ?>" class="dropdown-item 
                           <?php if (isset($_GET['menu'])) {
                              $menu_id = intval(sanitize_text_field($_GET['menu']));
                              if ($menu_id == 31100) {
                                 echo 'active';
                              }
                           } ?>">Item 1</a></li>
                           <li><a href="<?php echo esc_url(site_url('/about')) . '?menu=31200' ?>" class="dropdown-item 
                           <?php if (isset($_GET['menu'])) {
                              $menu_id = intval(sanitize_text_field($_GET['menu']));
                              if ($menu_id == 31200) {
                                 echo 'active';
                              }
                           } ?>">Item 2</a></li>
                           <li class="dropstart">
                              <a href="" class="dropdown-item dropdown-toggle 
                              <?php if (isset($_GET['menu'])) {
                                 $menu_id = intval(sanitize_text_field($_GET['menu']));
                                 if ($menu_id > 31300 & $menu_id < 31400) {
                                    echo 'active';
                                 }
                              } ?>" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">Submenu 2</a>
                              <ul class="dropdown-menu">
                                 <li><a href="<?php echo esc_url(site_url('/sample-page')) . '?menu=31310' ?>" class="dropdown-item <?php if (is_page('sample-page')) echo 'active' ?>">Sample Page</a></li>
                                 <li><a href="" class="dropdown-item">Item 2</a></li>
                                 <li><a href="" class="dropdown-item">Item 3</a></li>
                                 <li class="dropstart">
                                    <a href="" class="dropdown-item dropdown-toggle
                              <?php if (isset($_GET['menu'])) {
                                 $menu_id = intval(sanitize_text_field($_GET['menu']));
                                 if ($menu_id > 31340 & $menu_id < 31450) {
                                    echo 'active';
                                 }
                              } ?>" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">Submenu 3</a>
                                    <ul class="dropdown-menu">
                                       <li><a href="<?php echo esc_url(site_url('/sca-cambio-clave')) . '?menu=31341' ?>" class="dropdown-item <?php if (is_page('sca-cambio-clave')) echo 'active' ?>">Item 1</a></li>
                                       <li><a href="<?php echo esc_url(site_url('/level-1')) . '?menu=31342' ?>" class="dropdown-item <?php if (is_page('level-1')) echo 'active' ?>">Item 2</a></li>
                                       <li><a href="" class="dropdown-item">Item 3</a></li>
                                       <li><a href="" class="dropdown-item">Item 4</a></li>
                                    </ul>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <li><a class="dropdown-item" href="#">Another action</a></li>
                     <li>
                        <hr class="dropdown-divider">
                     </li>
                     <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
               </li>
               <li class="nav-item">
                  <a class="nav-link disabled">Disabled</a>
               </li>
            </ul>

            <div id="btn_menu" class="navbar nav-item me-n3">
               <button type="button" class="btn btn-warning btn-sm">
                  <?php if (is_user_logged_in()) : ?>
                     <a class="nav-link text-dark" aria-current="page" href="<?= wp_logout_url('/') ?>"></span><i class="fas fa-sign-out-alt"></i> Salir</a>
                  <?php else : ?>
                     <a class="nav-link text-dark" aria-current="page" href="<?= esc_url(site_url('/cor-login')) ?>"><i class="fas fa-sign-in-alt"></i> Ingresar</a>
                  <?php endif ?>
               </button>
            </div>
         </div>
      </div>
   </nav>
</header>
<div class="background-blend">