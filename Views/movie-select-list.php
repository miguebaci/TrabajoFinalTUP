<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Movie List</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th></th>
                         <th>Movie Name</th>
                         <th>Movie Language</th>
                         <th>Runtime</th>
                         <th>Genre</th>
                         <th>Poster</th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Function/MovieAdd" method="post" class="bg-light-alpha p-5">
                    <!-- session?-->
                         <?php
                              foreach($movieList as $movie)
                              { 
                                   ?>
                                        <tr> <input type="hidden" name="idRoom" value="<?php echo $idRoom?>">
                                             <td><button type="submit" name="idMovie" value="<?php echo $movie->getIdMovie()?>" class="btn btn-dark ml-auto d-block">Choose</button></td>
                                             <td><?php echo $movie->getMovieName()  ?></td>
                                             <td><?php echo $movie->getLanguage() ?></td>
                                             <td><?php echo $movie->getDuration() ?></td>
                                             <td><?php $genreArray= $movie->getGenre();
                                                  foreach($genreArray as $genres) {
                                                       echo $genres->getDescription();
                                                  if(next($genreArray)){
                                                       echo "/";
                                                  } } ?></td>
                                             <td><?php echo "<".POSTER_ROOT . $movie->getImage()." width='180' height='240'>" ?></td>
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