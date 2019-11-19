<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Ventas Cine</h2>
               <form action="<?php echo FRONT_ROOT ?>Purchase/AnalyticsSelect" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Cine</label>
                                   <select class="nav-item dropdown" name="genre_select" onchange="this.form.submit()" class="nav-link dropdown-toggle">
                                        <?php
                                            foreach($cinemas as $cinema){
                                        ?>
                                            <option class="dropdown-item" value=<?php echo $cinema->getIdCinema(); ?>><?php echo $cinema->getCinemaName(); ?></option>
                                        <?php
                                            }
                                        ?>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha de inicio</label>
                                   <input type="date" name="purchase_date_start" value="" class="form-control">
                                   <label for="">Fecha de finalización</label>
                                   <input type="date" name="purchase_date_end" value="" class="form-control">
                              </div>
                         </div>
                         <div>
                              <div class="form-group">
                              <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Mostrar ventas</button>
                              </div>
                         </div>
                </form>
                <form action="<?php echo FRONT_ROOT ?>Purchase/AnalyticsSelect" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Cine</label>
                                   <select class="nav-item dropdown" name="genre_select" onchange="this.form.submit()" class="nav-link dropdown-toggle">
                                        <?php
                                            foreach($movies as $movie){
                                        ?>
                                            <option class="dropdown-item" value=<?php echo $movie->getIdMovie(); ?>><?php echo $cinema->getMovieName(); ?></option>
                                        <?php
                                            }
                                        ?>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha de inicio</label>
                                   <input type="date" name="purchase_date_start" value="" class="form-control">
                                   <label for="">Fecha de finalización</label>
                                   <input type="date" name="purchase_date_end" value="" class="form-control">
                              </div>
                         </div>
                         <div>
                              <div class="form-group">
                              <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Mostrar ventas</button>
                              </div>
                         </div>     
                    </div>
               </form>
          </div>
     </section>
</main>