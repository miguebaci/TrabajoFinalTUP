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
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Function/Select" method="POST">
                         <?php 
                              foreach($functionList as $function)
                              {   
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