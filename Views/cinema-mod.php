<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Modificar Cine</h2>
               <form action="<?php echo FRONT_ROOT ?>Cinema/Update" method="POST" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                              <input type="hidden" name="idCinema" value="<?php echo $cinema->getIdCinema();?>">
                                   <label for="">Nombre</label>
                                   <input type="text" name="cinemaName" value="<?php echo $cinema->getCinemaName();?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Direccion</label>
                                   <input type="text" name="adress" value="<?php echo $cinema->getAdress();?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Capacidad Total</label>
                                   <input type="number" name="totalCap" value="<?php echo $cinema->getTotalCap();?>" class="form-control">
                              </div>
                         </div>
                    
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Precio de Ticket</label>
                                   <input type="number" min = "1" step ="any" name="ticketPrice" value="<?php echo $cinema->getTicketPrice();?>" class="form-control">
                              </div>
                         </div>
                         </div>
                         <div>
                              <div class="form-group">
                              <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Editar</button>
                              </div>
                         </div>
                    </div>
               </form>
          </div>
     </section>
</main>