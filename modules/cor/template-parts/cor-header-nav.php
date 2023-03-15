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
            <?php
            if (is_user_logged_in()) {
               wp_nav_menu(
                  array(
                     'theme_location' => 'Principal',
                     'container'       => '',
                     'items_wrap'    => '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">%3$s</ul>',
                     'depth'          => 5,
                  )
               );
            }
            ?>
            <div id="btn_menu" class="navbar nav-item me-n3">
               <button type="button" class="btn btn-warning">
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