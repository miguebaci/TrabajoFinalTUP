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
                         <th>Tickets (Remaining/ Sold)</th>
                         <th></th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Function/ShowSelectView" method="POST">
                    <input type="hidden" name="idRoom" value="<?php echo $idRoom?>">
                    <button type="submit" class ="btn btn-primary"> Add Function/s </button>
                    </form>
                    <form action="<?php echo FRONT_ROOT ?>Function/DeleteOld" method="POST">
                    <button type="submit" class ="btn btn-danger" onclick="return confirm('Are you sure yo want to delete all past functions?')"> Delete all old functions </button>
                    </form>
                         <form action="<?php echo FRONT_ROOT ?>Function/Delete" method="POST">
                         <?php 
                              foreach($functionList as $functionInfo)
                              {    
                                   $function=$functionInfo["function"];
                                   $remaining=$functionInfo["remaining"];
                                   $movie=$function->getMovie();
                                   ?>
                                        <tr>
                                             <td><?php echo $movie->getMovieName() ?></td>
                                             <td><?php echo $movie->getLanguage() ?></td>
                                             <td><?php echo $movie->getDuration() ?> min</td>
                                             <td><?php $genreArray= $movie->getGenre();
                                                  foreach($genreArray as $genres) {
                                                  echo $genres->getDescription();
                                                  if(next($genreArray)){
                                                       echo "/ ";
                                                  } } ?></td>
                                             <td><?php echo "<".POSTER_ROOT . $movie->getImage()." width='180' height='240'>" ?></td>
                                             <td><?php echo $function->getDate() ?></td>
                                             <td><?php echo $function->getTime() ?></td>
                                             <td><?php echo $remaining.'/'.($room->getTotalCap()-$remaining); ?></td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-danger" name ='idFunction' value='<?php echo $function->getIdFunction(); ?>' onclick="return confirm('Are you sure yo want to delete the function of <?php echo $movie->getMovieName() ?> on <?php echo $function->getDate() ?> at <?php echo $function->getTime() ?>?')"> Delete </button>
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