<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Funciones</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Lenguaje</th>
                         <th>Duracion total</th>
                         <th>Genero/s</th>
                         <th>Poster</th>
                         <th>Dia de la Funcion</th>
                         <th>Horario de la Funcion</th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Function/Select" method="POST">
                         <?php 
                              foreach($functionList as $function)
                              {   
                                   $movie = $functionDAO->GetMovieByFunctionId($function->getIdFunction());
                                   ?>
                                        <tr>
                                             <td><?php echo $movie->getMovieName() ?></td>
                                             <td><?php echo $movie->getLanguage() ?></td>
                                             <td><?php echo $movie->getDuration() ?></td>
                                             <td><?php $genreArray= $movieDAO->GetIdGenreById($movie->getIdMovie());
                                                  foreach($genreArray as $genres) {
                                                  echo $genreRepo->GetById($genres)->getDescription();
                                                  if(next($genreArray)){
                                                       echo "/";
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