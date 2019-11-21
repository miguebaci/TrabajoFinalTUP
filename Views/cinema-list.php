<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container"> 
      <div class="scrollable">
      <h2 class="mb-4">Cinemas List</h2>

      <form method = "POST" action = <?php echo FRONT_ROOT."Cinema/ShowAddView" ?>>
        <button id="buttons" class="btn btn-primary" type="submit">Add Cine</button>
      </form>
      <br>
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
            <?php
              if($cinemaList!=false)foreach($cinemaList as $cinema)
              {
                ?>
                  <tr>
                    <td><?php echo $cinema->getCinemaName() ?></td>
                    <td><?php echo $cinema->getAddress() ?></td>
                    <td><?php echo $cinema->getTicketPrice() ?></td>
                    
                    <td>
                      <form action=<?php echo FRONT_ROOT.'CinemaRoom/ShowListView'?> method = "POST">
                        <input type="hidden"  name = "idCinema" value=<?php echo $cinema->getIdCinema() ?>>
                        <button type=submit class ="btn btn-primary"> Rooms </button>
                      </form>
                    </td>
                    <td>
                      <form action=<?php echo FRONT_ROOT.'Cinema/ShowUpdateView'?> method = "POST">
                        <input type="hidden"  name = "idCinema" value=<?php echo $cinema->getIdCinema() ?>>
                        <button type=submit class ="btn btn-warning"> Edit </button>
                      </form>
                    </td>
                    <td class="border">
                      <form action=<?php echo FRONT_ROOT.'Cinema/Delete'?> method = "POST">
                        <input type="hidden"  name = "idCinema" value=<?php echo $cinema->getIdCinema() ?>>
                        <button type=submit class ="btn btn-danger"> Delete </button>
                      </form>
                    </td>
                  </tr>
                <?php
              }
            ?>                          
          </tbody>
        </table> 
      </div>
    </div>
     </section>
</main>