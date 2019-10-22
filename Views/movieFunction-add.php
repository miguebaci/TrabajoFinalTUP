<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Funcion</h2>
               <form action="<?php echo FRONT_ROOT ?>Function/Add" method="post" class="bg-light-alpha p-5">
               <input type="hidden" name="idRoom" value="<?php echo $idRoom;?>">
               <input type="hidden" name="idMovie" value="<?php echo $idMovie;?>">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Horario</label>
                                   <input type="time" name="function_time" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha de inicio</label>
                                   <input type="date" name="function_date_start" value="" class="form-control">
                                   <label for="">Fecha de finalización</label>
                                   <input type="date" name="function_date_end" value="" class="form-control">
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