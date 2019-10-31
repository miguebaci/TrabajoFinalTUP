<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>TP BACIGALUPPI || DUCAMP</strong>
     </span>
     <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto">
               <?php
                    if(!isset($_SESSION["loggedUser"])){
               ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Login">Login</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Register">Register</a>
               </li>
               <?php
                    }else{
                         if($_SESSION["loggedUser"]->getRole()=="Admin"){
               ?>
               <li class="nav-item dropdown">
                    <select name="AdminOptions"  onchange="location = this.value;" class="nav-link dropdown-toggle" >
                         <option class="dropdown-item" value="" selected>Admin Options</option> 
                         <option class="dropdown-item" value="<?php echo FRONT_ROOT ?>Cinema/ShowAddView">Add Cinema</option>
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


