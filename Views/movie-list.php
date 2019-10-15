<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de cines</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Lenguaje</th>
                         <th>Duracion total</th>
                         <th>Genre</th>
                         <th>Poster</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($movieList as $movie)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $movie->getMovieName() ?></td>
                                             <td><?php echo $movie->getLanguage() ?></td>
                                             <td><?php echo $movie->getDuration() ?></td>
                                             <td><?php foreach(is_string($movie->getIdGenre()) ? json_decode($movie->getIdGenre() , true) : $movie->getIdGenre() as $genres) {echo $genreRepo->GetById($genres)->getDescription()."/"; } ?></td>
                                             <td><?php echo "<".POSTER_ROOT . $movie->getImage().">" ?></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>