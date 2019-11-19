<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h3>Buying Tickets for <?php echo $function->getMovie()->getMovieName(); ?></h3>
               <form action="<?php echo FRONT_ROOT ?>Purchase/Buy" method="POST">
                    <input type="text" name="discount" placeholder="Discount Code" id="">
                    <input type="number" name="quantity" placeholder="Quantity" min = "1" max=<?php echo $remainingTickets ?> id="" required> 
                    <button type="submit" class ="btn btn-danger" name ='buy_button' value='<?php echo $function->getIdFunction();?>'> Buy </button>
                    <h6><?php echo " Remaining Tickets for this Function: ".$remainingTickets; ?></h6>
               </form>
          </div>
     </section>
</main>