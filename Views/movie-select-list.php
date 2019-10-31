<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Peliculas</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th></th>
                         <th>Nombre</th>
                         <th>Lenguaje</th>
                         <th>Duracion total</th>
                         <th>Genre</th>
                         <th>Poster</th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Function/Select" method="post" class="bg-light-alpha p-5">
                    <input type="hidden" name="idRoom" value="<?php echo $idRoom;?>">
                         <?php
                              foreach($movieList as $movie)
                              {
                                   ?>
                                        <tr>
                                             <td><button type="submit" name="select_movie" value="<?php echo $movie->getIdMovie()  ?>" class="btn btn-dark ml-auto d-block">Elegir</button></td>
                                             <td><?php echo $movie->getMovieName()  ?></td>
                                             <td><?php echo $movie->getLanguage() ?></td>
                                             <td><?php echo $movie->getDuration() ?></td>
                                             <td><?php $genreArray= $movieDAO->GetIdGenreById($movie->getIdMovie());
                                                  foreach($genreArray as $genres) {
                                                  echo $genreRepo->GetById($genres)->getDescription();
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