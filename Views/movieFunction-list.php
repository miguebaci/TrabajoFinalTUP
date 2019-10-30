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
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Function/Select" method="POST">
                    <button type="submit" class ="btn btn-primary" name ='add_button' value='<?php echo $idRoom; ?>'> Agregar Funcion </button>
                         <?php
                              foreach($functionList as $function)
                              {
                                   ?>
                                        <tr>
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