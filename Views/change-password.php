<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Change Password</h2>
               <form action="<?php echo FRONT_ROOT ?>User/ChangePasswordConfirm" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Old Password</label>
                                   <input type="password" name="oldPassword" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">New Password</label>
                                   <input type="password" name="newPassword" value="" class="form-control" required>
                              </div>
                         </div>
                    
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Confirm New Password</label>
                                   <input type="password" name="newPassword2" value="" class="form-control" required>
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