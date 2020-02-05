<?php
    require_once('nav.php');
    require_once(VIEWS_PATH."fbload.php");
?>


<main class="d-flex align-items-center justify-content-center height-100 py-5">
          <div class="content">
               <header class="text-center">
                    <h2>Register</h2>
               </header>

               <form action="<?php echo FRONT_ROOT ?>User/RegisterValidation" method="post" class="login-form bg-dark-alpha p-5">
               <input type="hidden" name="role" value="User">
                    <div class="form-group">
                         <label for="">Email</label>
                         <input type="email" name="email" value="" class="form-control form-control-lg" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                         <label for="">Password</label>
                         <input type="password" name="password" value="" class="form-control form-control-lg" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                         <label for="">Confirm Password</label>
                         <input type="password" name="password2" value="" class="form-control" placeholder="Repeat Password" required>
                    </div>
                    <button class="btn btn-dark btn-block btn-lg" type="submit">Register</button>
                    <?php echo '<a class="btn btn-primary btn-block btn-lg"" href="' . htmlspecialchars($loginUrl) . '">Or Continue with Facebook!</a>'; ?>
               </form>
          </div>
</main>