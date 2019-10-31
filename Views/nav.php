<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>TP BACIGALUPPI || DUCAMP</strong>
     </span>
     <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowAddView">Agregar Cine</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowListView">Listar Cines</a>
               </li>     
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/UpdateMovies">Actualizar peliculas</a>
               </li>  
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/ShowListView">Listar peliculas</a>
               </li> 
               <li class="nav-item dropdown">
                    <select name="AdminOptions"  onchange="location = this.value;" class="nav-link dropdown-toggle" >
                         <option class="dropdown-item" value="">Admin Options</option> 
                         <option class="dropdown-item" value="<?php echo FRONT_ROOT ?>Cinema/ShowAddView">Add Cinema</option>
                         <option class="dropdown-item" value="<?php echo FRONT_ROOT ?>Cinema/ShowListView">List Cinemas</option>
                         <option class="dropdown-item" value="<?php echo FRONT_ROOT ?>Movie/UpdateMovies">Update Movies</option>
                         <option class="dropdown-item" value="<?php echo FRONT_ROOT ?>Movie/ShowListView">List Movies</option>
                         <option class="dropdown-item" value="<?php echo FRONT_ROOT ?>Genre/UpdateGenres">Update Genres</option>
                    </select>
               </li>                    
          </ul>
     </div>
</nav>


