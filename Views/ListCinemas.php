<?php
    namespace Views;

    
    require_once("../Config/Config.php");
    require_once("../Config/Autoload.php");

    include_once("../Views/nav.php");

    use Repositories\ICinemaRepository as ICinemaRepository;
    use Repositories\CinemaRepository as CinemaRepository;
    use Models\Cinema as Cinema;
    use Config\Autoload as Autoload;

    Autoload::Start();

    $repo = new CinemaRepository();
    $arrayCinema= $repo->getAll();
?>
<main class="py-5">
    <section id="listado" class="mb-5">
         <div class="container">
              <h2 class="mb-4">Listado de cines</h2>

              <table class="table bg-light">
                   <thead class="bg-dark text-white">
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Capacidad Total</th>
                        <th>Precio de Entrada</th>
                   </thead>
                   <tbody>
                   <?php
                             if(isset($arrayCinema)){
                                  foreach($arrayCinema as $cinema){
                                  
                                       ?>
                                            <tr>
                                                 <td><?php echo $cinema->getCinemaName(); ?></td>
                                                 <td><?php echo $cinema->getAdress(); ?></td>
                                                 <td><?php echo $cinema->getTotalCap(); ?></td>
                                                 <td><?php echo $cinema->getTicketPrice(); ?></td>
                                            </tr>
                                       <?php
                                  }
                             }
                        ?>
                   </tbody>
              </table>
         </div>
    </section>
</main>
