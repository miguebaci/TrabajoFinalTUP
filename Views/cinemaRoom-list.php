<?php
    require_once('nav.php');
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
                         <?php $_SESSION['idCinema']=$cinema->getIdCinema();
                              foreach($cinemaRoomList as $room)
                              {    $_SESSION['idRoom']=$room->getIdCinemaRoom();
                                   
                                   

                                   ?>
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