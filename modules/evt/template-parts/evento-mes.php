<?php

/**
 * The main template file
 *
 * @package Aplicación_Web
 */

$eventos = [
   'posts_per_page' => -1,
   'post_type' => 'evento',
];
$query = new WP_Query($eventos);

$diasemanapost = ['Monday' => 'LUN', 'Tuesday' => 'MAR', 'Wednesday' => 'MIE', 'Thursday' => 'JUE', 'Friday' => 'VIE', 'Saturday' => 'SAB', 'Sunday' => 'DOM'];
$numerodiasemana = ['1', '2', '3', '4', '5', '6', '7'];
$meses = ['1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo', '4' => 'Abril', '5' => 'Mayor', '6' => 'Junio', '7' => 'Julio', '8' => 'Agosto', '9' => 'Septiembre', '10' => 'Octurbre', '11' => 'Noviembre', '12' => 'Diciembre'];

get_header();
$textcolor = (get_post_meta($post->ID, '_f_final', true) == '') ? 'text-info' : 'text-warning';
?>
<section class="container py-5">
   <div class="mb-5 text-center">
      <h2 class="animate__animated animate__fadeInLeftBig"><small><span class="text-info"><i class="fa-solid fa-circle"></i></span></small> Reuniones y <small><span class="text-warning"><i class="fa-solid fa-circle"></i></span></small> Eventos del mes de <?php echo $meses[date('n')] ?></h2>
   </div>
   <?php
   if ($query->have_posts()) {
   ?>
      <div class="row">
         <table class="table table-sm table-bordered table-dark">
            <thead>
               <tr>
                  <th scope="col">Lunes</th>
                  <th scope="col">Martes</th>
                  <th scope="col">Miércoles</th>
                  <th scope="col">Jueves</th>
                  <th scope="col">Viernes</th>
                  <th scope="col">Sábado</th>
                  <th scope="col">Domingo</th>
               </tr>
            </thead>
            <tbody>

               <?php
               $clase = 'rounded-circle bg-danger text-center mb-2" style="width:23px; height:23px;';
               $dia = 0;
               for ($i = 1; $i <= 6; $i++) {
                  echo '<tr>';
                  for ($j = 1; $j <= 7; $j++) {
                     if ($dia == 0) {
                        if ($j == date('N', strtotime('first day of ' . date('F')))) {
                           $dia = $dia + 1;
                           echo '<td style="width:150px;">';
                           echo '<div class="' . ($dia == date('d') ? $clase : '') . '">' . $dia . '</div>';
                           $query = new WP_Query($eventos);
                           echo '<ul class="list-unstyled">';
                           while ($query->have_posts()) {
                              $query->the_post();
                              $fechasevento = themeframework_fechasevento(
                                 get_post_meta($post->ID, '_f_inicio', true),
                                 get_post_meta($post->ID, '_f_final', true),
                                 get_post_meta($post->ID, '_periodicidadevento', true),
                                 get_post_meta($post->ID, '_opcionesquema', true),
                                 get_post_meta($post->ID, '_numerodiaevento', true),
                                 get_post_meta($post->ID, '_numerodiaordinalevento', true),
                                 explode(',', get_post_meta($post->ID, '_diasemanaevento', true)),
                                 get_post_meta($post->ID, '_mesevento', true)
                              );
                              foreach ($fechasevento as $fechadia) {
                                 if (date('Y-m-d', strtotime('first day of ' . date('F'))) == $fechadia) {
                                    $textcolor = (get_post_meta($post->ID, '_f_final', true) == '') ? 'text-info' : 'text-warning';
                                    echo '<li><span class="' . $textcolor . '"><i class="fa-solid fa-circle"></i></span> <smal><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></smal></li>';
                                 }
                              }
                           }
                           echo '</ul>';
                           echo '</td>';
                        } else {
                           echo '<td></td>';
                        }
                     } else {
                        $dia = $dia + 1;
                        if ($dia  <= date('j', strtotime('last day of ' . date('F')))) {
                           echo '<td style="width:150px;">';
                           echo '<div class="' . ($dia == date('d') ? $clase : '') . '">' . $dia . '</div>';
                           $query = new WP_Query($eventos);
                           echo '<ul class="list-unstyled">';
                           while ($query->have_posts()) {
                              $query->the_post();
                              $fechasevento = themeframework_fechasevento(
                                 get_post_meta($post->ID, '_f_inicio', true),
                                 get_post_meta($post->ID, '_f_final', true),
                                 get_post_meta($post->ID, '_periodicidadevento', true),
                                 get_post_meta($post->ID, '_opcionesquema', true),
                                 get_post_meta($post->ID, '_numerodiaevento', true),
                                 get_post_meta($post->ID, '_numerodiaordinalevento', true),
                                 explode(',', get_post_meta($post->ID, '_diasemanaevento', true)),
                                 get_post_meta($post->ID, '_mesevento', true)
                              );
                              foreach ($fechasevento as $fechadia) {
                                 if (date('Y-m-d', mktime(0, 0, 0, date('m'), $dia, date('Y'))) == $fechadia) {
                                    $textcolor = (get_post_meta($post->ID, '_f_final', true) == '') ? 'text-info' : 'text-warning';
                                    echo '<li><span class="' . $textcolor . '"><i class="fa-solid fa-circle"></i></span> <smal><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></smal></li>';
                                 }
                              }
                           }
                           echo '</ul>';
                           echo '</td>';
                        } else {
                           echo '<td></td>';
                        }
                     }
                  }
                  echo '</tr>';
               }
               wp_reset_postdata();
               ?>
            </tbody>
         </table>
      </div>
   <?php
   } else {
      get_template_part('template-parts/content', 'none');
   }
   ?>
</section>
<?php
get_footer();
