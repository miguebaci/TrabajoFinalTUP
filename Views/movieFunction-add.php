<?php
    require_once('nav.php');
    $_SESSION["idRoom"]=$idRoom;
    $_SESSION["idMovie"]=$idMovie;
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Add Function</h2>
               <form action="<?php echo FRONT_ROOT ?>Function/Add" method="post" class="bg-light-alpha p-5">
               <input type="hidden" name="idRoom" value="<?php echo $idRoom?>">
               <input type="hidden" name="idMovie" value="<?php echo $idMovie?>">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Time</label>
                                   <select name="function_time" class="form-control">
                                   <option value="11:00">11:00</option>
                                   <option value="14:00">14:00</option>
                                   <option value="17:00">17:00</option>
                                   <option value="20:00">20:00</option>
                                   <option value="23:00">23:00</option>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Start Date</label>
                                   <input type="date" name="function_date_start" value="" class="form-control">
                                   <label for="">Finish Date</label>
                                   <input type="date" name="function_date_end" value="" class="form-control">
                              </div>
                         </div>
                         </div>
                         <div>
                              <div class="form-group">
                              <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Add</button>
                              </div>
                         </div>
                    </div>
               </form>
          </div>
     </section>
</main>