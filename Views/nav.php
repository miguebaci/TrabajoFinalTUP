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
                                   <option readonly>Funciones por Genero</option>
                                   <option value="28">Action</option>
                                   <option value="12">Adventure</option>
                                   <option value="16">Animation</option>
                                   <option value="35">Comedy</option>
                                   <option value="80">Crime</option>
                                   <option value="99">Documentary</option>
                                   <option value="18">Drama</option>
                                   <option value="10751">Family</option>
                                   <option value="14">Fantasy</option>
                                   <option value="36">History</option>
                                   <option value="27">Horror</option>
                                   <option value="10402">Music</option>
                                   <option value="9648">Mystery</option>
                                   <option value="10749">Romance</option>
                                   <option value="878">Science Fiction</option>
                                   <option value="53">Thriller</option>
                                   <option value="10770">TV Movie</option>
                                   <option value="10752">War</option>
                                   <option value="37">Western</option>
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
                                   <option value="<?php echo FRONT_ROOT ?>Genre/UpdateGenres">Update Genres</option>
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