<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Salas</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Capacidad de la sala</th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>CinemaRoom/Select" method="POST">
                    <button type="submit" class ="btn btn-primary" name ='add_button' value='<?php echo $cinema->getIdCinema(); ?>'> Agregar Sala </button>
                         <?php
                              foreach($cinemaRoomList as $room)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $room->getRoomName() ?></td>
                                             <td><?php echo $room->getTotalCap() ?></td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-primary" name ='function_button' value='<?php echo $room->getIdCinemaRoom(); ?>'> Añadir Funcion </button>
                                             </td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-primary" name ='list_button' value='<?php echo $room->getIdCinemaRoom(); ?>'> Listado de Funciones </button>
                                             </td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-warning" name ='edit_button' value='<?php echo $room->getIdCinemaRoom(); ?>'> Editar </button>
                                             </td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-danger" name ='delete_button' value='<?php echo $room->getIdCinemaRoom(); ?>'> Eliminar </button>
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