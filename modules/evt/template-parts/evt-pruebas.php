<?php
if (isset($_GET['mes'])) {
   $mes = sanitize_text_field($_GET['mes']);
} else {
   $mes = date('F');
}
// $mes = 'July';
$espacios = date('N', strtotime('first day of ' . $mes)) - 1;
$restante = 8 - $espacios;

?>

<h3>Pruebas</h3>
<div class="col-md-3 my-3">
   <select id="mesEvento" class="form-control" name="">
      <option value="Januray" <?php echo ($mes === "Januray") ? 'selected' : '' ?>>Enero</option>
      <option value="February" <?php echo ($mes === "February") ? 'selected' : '' ?>>Febrero</option>
      <option value="March" <?php echo ($mes === "March") ? 'selected' : '' ?>>Marzo</option>
      <option value="April" <?php echo ($mes === "April") ? 'selected' : '' ?>>Abril</option>
      <option value="May" <?php echo ($mes === "May") ? 'selected' : '' ?>>May</option>
      <option value="June" <?php echo ($mes === "June") ? 'selected' : '' ?>>Junio</option>
      <option value="July" <?php echo ($mes === "July") ? 'selected' : '' ?>>Julio</option>
      <option value="August" <?php echo ($mes === "August") ? 'selected' : '' ?>>Agosto</option>
      <option value="September" <?php echo ($mes === "September") ? 'selected' : '' ?>>Septiembre</option>
      <option value="October" <?php echo ($mes === "October") ? 'selected' : '' ?>>Octubre</option>
      <option value="November" <?php echo ($mes === "November") ? 'selected' : '' ?>>Noviembre</option>
      <option value="December" <?php echo ($mes === "December") ? 'selected' : '' ?>>Diciembre</option>
   </select>
   <input type="hidden" id="url" value=<?php echo site_url('/evt-pruebas') ?>>
</div>
<script>
   document.getElementById('mesEvento').addEventListener('change', function() {
      window.location.href = document.getElementById('url').value + '/?mes=' + document.getElementById('mesEvento').value
   })
</script>
<div class="row my-3">
   <div class="table-responsive">
      <table class="table table-dark">
         <thead>
            <tr>
               <th class="text-center" scope="col">Lunes</th>
               <th class="text-center" scope="col">Martes</th>
               <th class="text-center" scope="col">Miércoles</th>
               <th class="text-center" scope="col">Jueves</th>
               <th class="text-center" scope="col">Viernes</th>
               <th class="text-center" scope="col">Sábado</th>
               <th class="text-center" scope="col">Domingo</th>
            </tr>
         </thead>
         <tbody">
            <?php for ($semana = 1; $semana < 8; $semana++) : ?>
               <?php if ($semana == 1) : ?>
                  <tr>
                     <?php if ($espacios > 0) : ?>
                        <td colspan="<?php echo $espacios ?>"></td>
                     <?php endif; ?>
                     <?php for ($dia = 1; $dia < $restante; $dia++) : ?>
                        <td>
                           <a href="<?php echo get_post_type_archive_link('evento') . '?fpe=' . date('Ymd', strtotime($dia . $mes . date('Y'))) ?>">
                              <span class="<?php echo (date('Ymd') == date('Ymd', strtotime($dia . $mes . date('Y')))) ? 'd-flex badge rounded-pill text-bg-danger justify-content-center' : 'd-flex justify-content-center' ?>"><?php echo $dia ?></span>
                           </a>
                        </td>
                     <?php endfor; ?>
                  </tr>
               <?php else : ?>
                  <tr>
                     <?php for ($diasemana = 1; $diasemana < 8; $diasemana++) : ?>
                        <?php if ($dia < date('j', strtotime('last day of ' . $mes))) : ?>
                           <td>
                              <a href="<?php echo get_post_type_archive_link('evento') . '?fpe=' . date('Ymd', strtotime($dia . $mes . date('Y'))) ?>">
                                 <span class="<?php echo (date('Ymd') == date('Ymd', strtotime($dia . $mes . date('Y')))) ? 'd-flex badge rounded-pill text-bg-danger justify-content-center' : 'd-flex justify-content-center' ?>"><?php echo $dia++ ?></span>
                              </a>
                           </td>
                        <?php else : ?>
                           <?php if ($dia == date('j', strtotime('last day of ' . $mes))) : ?>
                              <td>
                                 <a href="<?php echo get_post_type_archive_link('evento') . '?fpe=' . date('Ymd', strtotime($dia . $mes . date('Y'))) ?>">
                                    <span class="<?php echo (date('Ymd') == date('Ymd', strtotime($dia . $mes . date('Y')))) ? 'd-flex badge rounded-pill text-bg-danger justify-content-center' : 'd-flex justify-content-center' ?>"><?php echo $dia++ ?></span>
                                 </a>
                              </td>
                              <?php if (7 - $diasemana > 0) :  ?>
                                 <td colspan="<?php echo 7 - $diasemana ?>"></td>
                              <?php endif; ?>
                           <?php endif; ?>
                        <?php endif; ?>
                     <?php endfor; ?>
                  </tr>
               <?php endif; ?>
            <?php endfor; ?>
            </tbody>
      </table>
   </div>
</div>