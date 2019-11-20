<?php
    require_once('nav.php');
    require_once(VIEWS_PATH."fbload.php");
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Login</h2>
               <form action="<?php echo FRONT_ROOT ?>User/LoginValidation" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Contraseña</label>
                                   <input type="password" name="password" value="" class="form-control" required>
                              </div>
                         </div>
                         </div>
                         <div>
                              <div class="form-group">
                                   <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Log in</button>
                                   <?php echo '<a class="btn btn-primary ml-auto float-right" href="' . htmlspecialchars($loginUrl) . '">Or log in with Facebook!</a>'; ?>
                              </form>
                              </div>
                         </div>
                                                      

                         
                    </div>
          </div>
     </section>
</main>