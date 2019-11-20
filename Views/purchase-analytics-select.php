<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-6">
          <div class="container">
               <h2 class="mb-4">Cinema Sales</h2> 
               <form action="<?php echo FRONT_ROOT ?>User/AnalyticsSelect" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-5">
                              <div class="form-group">
                                   <label for="">Cine</label>
                                   <select class="nav-item dropdown" name="cinemaId" class="nav-link dropdown-toggle">
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
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Fecha de inicio</label>
                                   <input type="date" name="date_start" value="" class="form-control" required>
                                   <label for="">Fecha de finalización</label>
                                   <input type="date" name="date_end" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                         <div>
                              <div class="form-group">
                                   <button type="submit" name="button_name" value="cinema" value="1" class="btn btn-dark ml-auto d-block">Show Cinema Sales</button>
                              </div>
                         </div> 
                </form>
                <form action="<?php echo FRONT_ROOT ?>User/AnalyticsSelect" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-5">
                              <div class="form-group">
                                   <label for="">Movies</label>
                                   <select class="nav-item dropdown" name="movieId" class="nav-link dropdown-toggle">
                                        <?php
                                            foreach($movies as $movie){
                                        ?>
                                            <option class="dropdown-item" value=<?php echo $movie->getIdMovie(); ?>><?php echo $movie->getMovieName(); ?></option>
                                        <?php
                                            }
                                        ?>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-3">
                              <div class="form-group">
                                   <label for="">Fecha de inicio</label>
                                   <input type="date" name="date_start" value="" class="form-control" required>
                                   <label for="">Fecha de finalización</label>
                                   <input type="date" name="date_end" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                         <div>
                              <div class="form-group">
                                   <button type="submit" value="movie" name="button_name" class="btn btn-dark ml-auto d-block">Show Movie Sales</button>
                              </div>
                         </div>     
               </form>
          </div>
     </section>
</main>