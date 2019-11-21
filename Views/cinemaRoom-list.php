<?php
    require_once('nav.php');
    var_dump($cinema);
    $_SESSION['idCinema']=$cinema->getIdCinema();
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Room List</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Room Name</th>
                         <th>Room Capacity</th>
                         <th></th>
                         <th></th>
                         <th></th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>CinemaRoom/Select" method="POST">
                    <button type="submit" class ="btn btn-primary" name ='button' value='add'> Add Room </button>
                         <?php 
                              foreach($cinemaRoomList as $room)
                              {   
                                   ?>        <input type="hidden" name="idCinema" value="<?php echo $idCinema?>">
                                             <input type="hidden" name="idRoom" value="<?php echo $room->getIdCinemaRoom();?>">
                                        <tr> 
                                             <td><?php echo $room->getRoomName() ?></td>
                                             <td><?php echo $room->getTotalCap() ?></td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-primary" name ='button' value='function'> Functions </button>
                                             </td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-warning" name ='button' value='edit'> Edit </button>
                                             </td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-danger" name ='button' value='delete' onclick="return confirm('Are you sure yo want to delete <?php echo $room->getRoomName() ?>? This will delete all functions data associated with it')"> Delete </button>
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