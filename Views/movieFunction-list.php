<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Function List</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Movie Name</th>
                         <th>Movie Language</th>
                         <th>Runtime</th>
                         <th>Genre</th>
                         <th>Poster</th>
                         <th>Function Date</th>
                         <th>Function Time</th>
                         <th></th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Function/Select" method="POST">
                    <button type="submit" class ="btn btn-primary" name ='button' value='add_button'> Add Function/s </button>
                    <button type="submit" class ="btn btn-danger" name ='button' value='delete_old' onclick="return confirm('Are you sure yo want to delete all past functions?')"> Delete all old functions </button>
                         <?php 
                              foreach($functionList as $function)
                              {     $_SESSION['idFunction']=$function->getIdFunction();
                                   var_dump($_SESSION['idFunction']);
                                   $movie=$function->getMovie();
                                   ?>
                                        <tr>
                                             <td><?php echo $movie->getMovieName() ?></td>
                                             <td><?php echo $movie->getLanguage() ?></td>
                                             <td><?php echo $movie->getDuration() ?></td>
                                             <td><?php $genreArray= $movie->getGenre();
                                                  foreach($genreArray as $genres) {
                                                  echo $genres->getDescription();
                                                  if(next($genreArray)){
                                                       echo "/ ";
                                                  } } ?></td>
                                             <td><?php echo "<".POSTER_ROOT . $movie->getImage()." width='180' height='240'>" ?></td>
                                             <td><?php echo $function->getDate() ?></td>
                                             <td><?php echo $function->getTime() ?></td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-danger" name ='button' value='delete_button' onclick="return confirm('Are you sure yo want to delete the function of <?php echo $movie->getMovieName() ?> on <?php echo $function->getDate() ?> at <?php echo $function->getTime() ?>?')"> Delete </button>
                                             </td>
                                        </tr>
                                   <?php
                              }
                              
                         ?>
                         </form>
                    </tbody>
               </table>
          </div>
     </section>
</main>