<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="row py-3">
                    <h3>Buying Tickets for <?php echo $function->getMovie()->getMovieName(); ?></h3>
               </div>
               <div class="row py-3">
                    <b>Selected function date: <?php echo $function->getDate()." at ".$function->getTime(); ?></b>
               </div>
               <div class="row py-3">
                    <h6><?php echo "Price by ticket: $".$ticketPrice; ?></h6>
               </div>
               <form action="<?php echo FRONT_ROOT ?>Purchase/Buy" method="POST">
                    <div class="row py-3">
                         <div class="col-2">
                              <input class="form-control" type="number" name="quantity" placeholder="Quantity" min = "1" max=<?php echo $remainingTickets ?> id="" required> 
                         </div>
                         
                         <button type="submit" class ="btn btn-danger" name ='buy_button' value='<?php echo $function->getIdFunction();?>'> Buy </button>
                    </div>
               </form>
               <div class="row py-3">
                    <h6><?php echo "Remaining Tickets for this Function: ".$remainingTickets; ?></h6>
               </div>
          </div>
     </section>
</main>