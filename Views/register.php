<?php
    require_once('nav.php');
?>

<?php

                              //session_start();
                              $fb = new Facebook\Facebook([
                              'app_id' => '2460451207325213', // Replace {app-id} with your app id
                              'app_secret' => '9af682d41351182a21de000a6efc1f48',
                              'default_graph_version' => 'v3.2',
                              ]);

                              $helper = $fb->getRedirectLoginHelper();

                              $permissions = ['email']; // Optional permissions
                              $loginUrl = $helper->getLoginUrl('http://localhost/TrabajoFinalTUP/User/FBCallback', $permissions);

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Register</h2>
               <form action="<?php echo FRONT_ROOT ?>User/RegisterValidation" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <input type="hidden" name="role" value="User">
                                   <label for="">Email</label>
                                   <input type="email" name="email" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Password</label>
                                   <input type="password" name="password" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Confirm Password</label>
                                   <input type="password" name="password2" value="" class="form-control" required>
                              </div>
                         </div>
                         </div>
                         <div>
                              <div class="form-group">
                              <button type="submit" name="button" class="btn btn-dark ml-auto d-block ">Register</button>
                              <?php echo '<a class="btn btn-primary ml-auto float-right" href="' . htmlspecialchars($loginUrl) . '">Or Continue with Facebook!</a>'; ?>
                              </div>
                         </div>
                    </div>
               </form>
          </div>
     </section>
</main>