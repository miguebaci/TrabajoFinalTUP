<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Add Cinema</h2>
               <form action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Cinema Name</label>
                                   <input type="text" name="cinemaName" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Address</label>
                                   <input type="text" name="address" value="" class="form-control">
                              </div>
                         </div>
                    
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Unitary Ticket Price</label>
                                   <input type="number" min = "1" step ="any" name="ticketPrice" value="" class="form-control">
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