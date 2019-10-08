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
                         <th>Direccion</th>
                         <th>Capacidad total</th>
                         <th>Precio unitario de entrada</th>
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
                                             <td><?php echo $movie->getImage() ?></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>