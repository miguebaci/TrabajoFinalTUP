<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container bg-light-alpha">
               <h2 class="mb-4">User Profile</h2>
               <h6 class="mb-1">Mail: <?php echo $_SESSION["loggedUser"]->getEmail(); ?><h3>

               <?php
                    if($_SESSION["loggedUser"]->getUserProfile()!=NULL){
               ?>
               <h6 class="mb-1">First Name: <?php if($_SESSION["loggedUser"]->getUserProfile()->getFirstName()!="-1" && $_SESSION["loggedUser"]->getUserProfile()->getFirstName()!=NULL) echo $_SESSION["loggedUser"]->getUserProfile()->getFirstName(); else echo "Not Set"; ?><h6>
               <h6 class="mb-1">Last Name: <?php if($_SESSION["loggedUser"]->getUserProfile()->getLastName()!="-1" && $_SESSION["loggedUser"]->getUserProfile()->getLastName()!=NULL) echo $_SESSION["loggedUser"]->getUserProfile()->getLastName(); else echo "Not Set"; ?><h6>
               <h6 class="mb-1">DNI: <?php if($_SESSION["loggedUser"]->getUserProfile()->getDni()!="-1" && $_SESSION["loggedUser"]->getUserProfile()->getDni()!=NULL) echo $_SESSION["loggedUser"]->getUserProfile()->getDni(); else echo "Not Set"; ?><h6>
               <?php
                    }else{
               ?>

               <h6 class="mb-1">First Name: Not Set</h6>
               <h6 class="mb-1">Last Name: Not Set</h6>
               <h6 class="mb-1">DNI: Not Set</h6>

               <?php
                    }
               ?>


               <?php
                    if(!isset($_SESSION['fb_access_token'])){
               ?>
                    <form>
                         <input type="button" class="btn btn-dark mr-auto d-block" value="Change Password" onclick="window.location.href='<?php echo FRONT_ROOT."User/ChangePassword" ?> '" />
                    </form>
               <?php     
                    }
               ?>

               <form>
                    <input type="button" class="btn btn-dark mr-auto d-block" value="Change Info" onclick="window.location.href='<?php echo FRONT_ROOT."User/ChangeUserProfile" ?> '" />
               </form> 
          </div>
     </section>
</main>