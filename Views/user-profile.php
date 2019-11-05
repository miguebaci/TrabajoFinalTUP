<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container bg-light-alpha">
                <h2 class="mb-4">User Profile</h2>
                <h3 class="mb-4">Mail: <?php echo $_SESSION["loggedUser"]->getEmail(); ?><h3>
                <h3 class="mb-4">Last Name: <?php if($_SESSION["loggedUser"]->getUserProfile()->getFirstName()!="-1" && $_SESSION["loggedUser"]->getUserProfile()->getFirstName()!=NULL) echo $_SESSION["loggedUser"]->getUserProfile()->getFirstName(); else echo "Not Set"; ?><h3>
                <h3 class="mb-4">First Name: <?php if($_SESSION["loggedUser"]->getUserProfile()->getLastName()!="-1" && $_SESSION["loggedUser"]->getUserProfile()->getLastName()!=NULL) echo $_SESSION["loggedUser"]->getUserProfile()->getLastName(); else echo "Not Set"; ?><h3>
                <h3 class="mb-4">DNI: <?php if($_SESSION["loggedUser"]->getUserProfile()->getDni()!="-1" && $_SESSION["loggedUser"]->getUserProfile()->getDni()!=NULL) echo $_SESSION["loggedUser"]->getUserProfile()->getDni(); else echo "Not Set"; ?><h3>
          </div>
     </section>
</main>