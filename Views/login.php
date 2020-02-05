<?php
    require_once('nav.php');
    require_once(VIEWS_PATH."fbload.php");
?>

<main class="d-flex align-items-center justify-content-center height-100 py-5">
     <section id="listado" class="mb-5">
          <div class="container">

          <div class="content">
          <header class="text-center">
               <h2>Log In</h2>
          </header>

          <form action="<?php echo FRONT_ROOT ?>User/LoginValidation" method="post" class="login-form bg-dark-alpha p-5">
               <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" value="" class="form-control form-control-lg" placeholder="Email" required>
               </div>
               <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" value="" class="form-control form-control-lg" placeholder="Password" required>
               </div>
               <button class="btn btn-dark btn-block btn-lg" type="submit">Iniciar Sesión</button>
               <?php echo '<a class="btn btn-primary btn-block btn-lg"" href="' . htmlspecialchars($loginUrl) . '">Or log in with Facebook!</a>'; ?>
          </form>
</main>