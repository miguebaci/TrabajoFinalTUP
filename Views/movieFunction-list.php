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
                         <th></th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Function/Select" method="POST">
                    <button type="submit" class ="btn btn-primary" name ='add_button' value='<?php echo $idRoom; ?>'> Agregar Funcion </button>
                         <?php 
                              foreach($functionList as $function)
                              {   $movie=$function->getMovie();
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
                                                  <button type="submit" class ="btn btn-danger" name ='delete_button' value='<?php echo $function->getIdFunction(); ?>'> Eliminar </button>
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