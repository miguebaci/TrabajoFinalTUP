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

                    <li class="nav-link dropdown">
                         <form action="<?php echo FRONT_ROOT ?>Function/Select" method="POST">
                              <select class="nav-item dropdown" name="genre_select" onchange="this.form.submit()" class="nav-link dropdown-toggle">
                                   <option class="dropdown-item" readonly>Funciones por Genero</option>
                                   <option class="dropdown-item" value="28">Action</option>
                                   <option class="dropdown-item" value="12">Aventure</option>
                                   <option class="dropdown-item" value="16">Animation</option>
                                   <option class="dropdown-item" value="35">Comedy</option>
                                   <option class="dropdown-item" value="80">Crime</option>
                                   <option class="dropdown-item" value="99">Documentary</option>
                                   <option class="dropdown-item" value="18">Drama</option>
                                   <option class="dropdown-item" value="10751">Family</option>
                                   <option class="dropdown-item" value="14">Fantasy</option>
                                   <option class="dropdown-item" value="36">History</option>
                                   <option class="dropdown-item" value="27">Horror</option>
                                   <option class="dropdown-item" value="10402">Music</option>
                                   <option class="dropdown-item" value="9648">Mystery</option>
                                   <option class="dropdown-item" value="10749">Romance</option>
                                   <option class="dropdown-item" value="878">Science Fiction</option>
                                   <option class="dropdown-item" value="53">Thriller</option>
                                   <option class="dropdown-item" value="10770">TV Movie</option>
                                   <option class="dropdown-item" value="10752">War</option>
                                   <option class="dropdown-item" value="37">Western</option>
                              </select>
                         </form>
                    </li>

                    <?php
                         if ($_SESSION["loggedUser"]->getRole() == "Admin") {
                              ?>
                         <li class="nav-link dropdown">
                              <select class="nav-item dropdown" name="AdminOptions" onchange="location = this.value;" class="nav-link dropdown-toggle">
                                   <option class="dropdown-item" value="" selected>Admin Options</option>
                                   <option class="dropdown-item" value="<?php echo FRONT_ROOT ?>Cinema/ShowListView">List Cinemas</option>
                                   <option class="dropdown-item" value="<?php echo FRONT_ROOT ?>Movie/UpdateMovies">Update Movies</option>
                                   <option class="dropdown-item" value="<?php echo FRONT_ROOT ?>Movie/ShowListView">List Movies</option>
                                   <option class="dropdown-item" value="<?php echo FRONT_ROOT ?>Genre/UpdateGenres">Update Genres</option>
                              </select>
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