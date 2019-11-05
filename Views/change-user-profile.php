<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Change Info</h2>
               <form action="<?php echo FRONT_ROOT ?>User/ChangeUserProfileConfirm" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">First Name:</label>
                                   <input type="text" name="firstName" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Last Name:</label>
                                   <input type="text" name="lastName" value="" class="form-control" required>
                              </div>
                         </div>
                    
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">DNI</label>
                                   <input type="number" name="dni" value="" class="form-control" required>
                              </div>
                         </div>
                         </div>
                         <div>
                              <div class="form-group">
                              <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Submit</button>
                              </div>
                         </div>
                    </div>
               </form>
          </div>
     </section>
</main>