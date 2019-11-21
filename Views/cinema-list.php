<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Cinemas List</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Cinema Name</th>
                         <th>Adress</th>
                         <th>Unitary Ticket Price</th>
                         <th></th>
                         <th></th>
                         <th></th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Cinema/Select" method="POST">
                    <button type="submit" class ="btn btn-primary" name ='button' value="add"> Add Cinema </button>
                         <?php
                              foreach($cinemaList as $cinema)
                              {              var_dump($cinema);           
                                   ?>
                                        <tr>
                                             <td><?php echo $cinema->getCinemaName() ?></td>
                                             <td><?php echo $cinema->getAdress() ?></td>
                                             <td><?php echo $cinema->getTicketPrice() ?></td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-primary" name ='button' value='room'> Rooms </button>
                                             </td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-warning" name ='button' value='edit'> Edit </button>
                                             </td>
                                             <td> 
                                                  <button type="submit" class ="btn btn-danger" name ='button' value='delete' onclick="return confirm('Are you sure yo want to delete <?php echo $cinema->getCinemaName() ?>? This will delete all cinema rooms and functions data associated with it')"> Delete </button>
                                             </td>
                                        </tr>
                                        <input type="hidden" name="idCinema" value="<?php echo $cinema->getIdCinema()?>">
                                   <?php
                              }
                         ?>
                         </form>
                    </tbody>
               </table>
          </div>
     </section>
</main>