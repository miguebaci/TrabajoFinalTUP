<?php
    require_once('nav.php');
    var_dump($idCinema);
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
                    <form method = "POST" action = <?php echo FRONT_ROOT."CinemaRoom/ShowAddView" ?>>
                    <input type="hidden" name="idCinema" value="<?php echo $idCinema?>">
                    <button id="buttons" class="btn btn-primary" type="submit">Add Room</button>
                    </form>
                         <?php 
                              foreach($cinemaRoomList as $room)
                              {   
                                   ?>        
                                             
                                        <tr> 
                                        <td><?php echo $room->getRoomName() ?></td>
                                        <td><?php echo $room->getTotalCap() ?></td>
                                             <td>
                                                  <form action=<?php echo FRONT_ROOT.'Function/ShowListView'?> method = "POST">
                                                       <input type="hidden" name="idRoom" value="<?php echo $room->getIdCinemaRoom();?>">
                                                       <button type=submit class ="btn btn-primary"> Functions </button>
                                                  </form>
                                             </td>
                                             <td>
                                                  <form action=<?php echo FRONT_ROOT.'CinemaRoom/ShowUpdateView'?> method = "POST">
                                                       <input type="hidden" name="idRoom" value="<?php echo $room->getIdCinemaRoom();?>">
                                                       <button type=submit class ="btn btn-warning"> Edit </button>
                                                  </form>
                                             </td>
                                             <td>
                                                  <form action=<?php echo FRONT_ROOT.'CinemaRoom/Delete'?> method = "POST">
                                                       <input type="hidden" name="idRoom" value="<?php echo $room->getIdCinemaRoom();?>">
                                                       <button type=submit class ="btn btn-danger"> Delete </button>
                                                  </form>
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