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
                         <th>Precio unitario de entrada</th>
                         <th></th>
                         <th></th>
                         <th></th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Cinema/Select" method="POST">
                    <button type="submit" class ="btn btn-primary" name ='add_button'> Agregar Cine </button>
                         <?php
                              foreach($cinemaList as $cinema)
                              {    /*$arrayToEncode=array();
                                   $valuesArray["idCinema"]=$cinema->getIdCinema();
                                   $valuesArray["cinemaName"]=$cinema->getCinemaName();
                                   $valuesArray["adress"]=$cinema->getAdress();
                                   $valuesArray["ticketPrice"]=$cinema->getTicketPrice();
                                   array_push($arrayToEncode,$valuesArray);
                                   $myJSON = json_encode($arrayToEncode);*/
                                   
                                   ?>
                                        <tr>
                                             <td><?php echo $cinema->getCinemaName() ?></td>
                                             <td><?php echo $cinema->getAdress() ?></td>
                                             <td><?php echo $cinema->getTicketPrice() ?></td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-primary" name ='room_button' value='<?php echo $cinema->getIdCinema(); ?>'> Salas </button>
                                             </td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-warning" name ='edit_button' value='<?php echo  $cinema->getIdCinema(); ?>'> Editar </button>
                                             </td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-danger" name ='delete_button' value='<?php echo $cinema->getIdCinema(); ?>'> Eliminar </button>
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