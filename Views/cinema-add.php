<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Cine</h2>
               <form action="Controllers/AddCinemaAction.php" method="post" class="bg-light-alpha p-5"> <!-- <?php echo FRONT_ROOT ?>Cinema/Add -->
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="cinemaName" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Direccion</label>
                                   <input type="text" name="adress" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Capacidad Total</label>
                                   <input type="number" name="totalCap" value="" class="form-control">
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Precio de Ticket</label>
                                   <input type="number" min = "1" step ="any" name="ticketPrice" value="" class="form-control">
                              </div>
                         </div>
                    </div>
                    <div>
                         <div class="form-group">
                         <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
                         </div>
                    </div>
                    
               </form>
          </div>
     </section>
</main>