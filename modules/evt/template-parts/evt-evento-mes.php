<div class="d-xl-flex justify-content-xl-center">
   <div class="col-xl-6">
      <div class="row">
         <div class="col-md-3">
            <select id="mesEvento" class="form-control" name="">
               <option value="Januray" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "Januray") ? 'selected' : '' ?>>Enero</option>
               <option value="February" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "February") ? 'selected' : '' ?>>Febrero</option>
               <option value="March" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "March") ? 'selected' : '' ?>>Marzo</option>
               <option value="April" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "April") ? 'selected' : '' ?>>Abril</option>
               <option value="May" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "May") ? 'selected' : '' ?>>May</option>
               <option value="June" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "June") ? 'selected' : '' ?>>Junio</option>
               <option value="July" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "July") ? 'selected' : '' ?>>Julio</option>
               <option value="August" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "August") ? 'selected' : '' ?>>Agosto</option>
               <option value="September" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "September") ? 'selected' : '' ?>>Septiembre</option>
               <option value="October" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "October") ? 'selected' : '' ?>>Octubre</option>
               <option value="November" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "November") ? 'selected' : '' ?>>Noviembre</option>
               <option value="December" <?php echo (themeframework_get_page_att(get_post_type())['mes'] === "December") ? 'selected' : '' ?>>Diciembre</option>
            </select>
            <input type="hidden" id="url" value=<?php echo site_url('/evt-evento-mes') ?>>
            <script>
               document.getElementById('mesEvento').addEventListener('change', function() {
                  window.location.href = document.getElementById('url').value + '/?mes=' + document.getElementById('mesEvento').value
               })
            </script>
         </div>
      </div>
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
                           <?php if (themeframework_get_page_att(get_post_type())['espacios'] > 0) : ?>
                              <td colspan="<?php echo themeframework_get_page_att(get_post_type())['espacios'] ?>"></td>
                           <?php endif; ?>
                           <?php for ($dia = 1; $dia < themeframework_get_page_att(get_post_type())['restante']; $dia++) : ?>
                              <td class="text-center">
                                 <a href=" <?php echo get_post_type_archive_link('evento') . '?fpe=' . date('Ymd', strtotime($dia . themeframework_get_page_att(get_post_type())['mes'] . date('Y'))) ?>">
                                    <span class="<?php echo (date('Ymd') == date('Ymd', strtotime($dia . themeframework_get_page_att(get_post_type())['mes'] . date('Y')))) ? 'badge rounded-pill text-bg-danger' : '' ?>"><?php echo $dia ?></span>
                                 </a>
                              </td>
                           <?php endfor; ?>
                        </tr>
                     <?php else : ?>
                        <tr>
                           <?php for ($diasemana = 1; $diasemana < 8; $diasemana++) : ?>
                              <?php if ($dia < date('j', strtotime('last day of ' . themeframework_get_page_att(get_post_type())['mes']))) : ?>
                                 <td class="text-center">
                                    <a href=" <?php echo get_post_type_archive_link('evento') . '?fpe=' . date('Ymd', strtotime($dia . themeframework_get_page_att(get_post_type())['mes'] . date('Y'))) ?>">
                                       <span class="<?php echo (date('Ymd') == date('Ymd', strtotime($dia . themeframework_get_page_att(get_post_type())['mes'] . date('Y')))) ? 'badge rounded-pill text-bg-danger' : '' ?>"><?php echo $dia++ ?></span>
                                    </a>
                                 </td>
                              <?php else : ?>
                                 <?php if ($dia == date('j', strtotime('last day of ' . themeframework_get_page_att(get_post_type())['mes']))) : ?>
                                    <td class="text-center">
                                       <a href=" <?php echo get_post_type_archive_link('evento') . '?fpe=' . date('Ymd', strtotime($dia . themeframework_get_page_att(get_post_type())['mes'] . date('Y'))) ?>">
                                          <span class="<?php echo (date('Ymd') == date('Ymd', strtotime($dia . themeframework_get_page_att(get_post_type())['mes'] . date('Y')))) ? 'badge rounded-pill text-bg-danger' : '' ?>"><?php echo $dia++ ?></span>
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
   </div>
</div>