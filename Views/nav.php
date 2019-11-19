<?php
require_once(VIEWS_PATH."genre-charge.php");
?>
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <a href="<?php echo FRONT_ROOT ?>index.php"><strong>TP BACIGALUPPI || DUCAMP</strong></a>
     </span>
     <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto">
               <?php
               if (!isset($_SESSION["loggedUser"])) {
                    ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Login">Login</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Register">Register</a>
                    </li>
               <?php
               } else {
                    ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/UserProfile">Your Profile</a>
                    </li>

                    <li>

                         <form action="<?php echo FRONT_ROOT ?>Function/Select" method="POST">
                              <li>
                         <div class="dropdown">
                         
                              <select name="genre_select" onchange="this.form.submit()" class="dropbtn">
                              <option readonly>Functions by Genre</option>
                              <?php
                              foreach ($genreList as $genre) {
                              ?>
                                   <option value="<?php echo $genre->getIdGenre()?>"><?php echo $genre->getDescription()?></option>
                              <?php
                              }
                              ?>
                              </select>

                              </div>
                              </li>
                         </form>
                    </li>

                    <?php
                         if ($_SESSION["loggedUser"]->getRole() == "Admin") {
                              ?>
                         <li>
                              <div class="dropdown">
                              <select name="AdminOptions" onchange="location = this.value;" class="dropbtn">
                                   <option value="" selected>Admin Options</option>
                                   <option value="<?php echo FRONT_ROOT ?>Cinema/ShowListView">List Cinemas</option>
                                   <option value="<?php echo FRONT_ROOT ?>Movie/UpdateMovies">Update Movies</option>
                                   <option value="<?php echo FRONT_ROOT ?>Movie/ShowListView">List Movies</option>
                                   <option value="<?php echo FRONT_ROOT ?>User/ShowAnalytics">Analytics</option>
                              </select>
                              </div>
                         </li>
                    <?php
                         }
                         ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Logout">Logout</a>
                    </li>
               <?php
               }
               ?>
          </ul>
     </div>
</nav>