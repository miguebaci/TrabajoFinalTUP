<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Sala</h2>
               <form action="<?php echo FRONT_ROOT ?>CinemaRoom/Add" method="post" class="bg-light-alpha p-5">
               <input type="hidden" name="idCinema" value="<?php echo $idCinema;?>">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="roomName" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Capacidad de la Sala</label>
                                   <input type="number" name="totalCap" value="" class="form-control">
                              </div>
                         </div>
                         </div>
                         <div>
                              <div class="form-group">
                              <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
                              </div>
                         </div>
                    </div>
               </form>
          </div>
     </section>
</main>