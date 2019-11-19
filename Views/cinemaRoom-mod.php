<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Modify Room</h2>
               <form action="<?php echo FRONT_ROOT ?>CinemaRoom/Update" method="POST" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                              <input type="hidden" name="idRoom" value="<?php echo $room->getIdCinemaRoom();?>">
                                   <label for="">Room Name</label>
                                   <input type="text" name="roomName" value="<?php echo $room->getRoomName();?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Room Capacity</label>
                                   <input type="number" min = "1" step ="any" name="totalCap" value="<?php echo $room->getTotalCap();?>" class="form-control">
                              </div>
                         </div>
                         </div>
                         <div>
                              <div class="form-group">
                              <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Edit</button>
                              </div>
                         </div>
                    </div>
               </form>
          </div>
     </section>
</main>