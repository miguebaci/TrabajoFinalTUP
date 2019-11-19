<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h1>Show this at the cinema</h1>
               <img src=<?php echo $purchase->getTicket()->getQR(); ?> title="Your Ticket" />
               <h6>Quantity of Tickets: <?php echo $purchase->getTicketQuantity(); ?></h6>  
               <h6>Total: $ <?php echo $purchase->getTotal(); echo $purchase->getDiscount()>0 ? "<br>With a discount of ".$purchase->getDiscount()."% the Total is: $".($purchase->getTotal() - ($purchase->getTotal()*$purchase->getDiscount()/100)) :  "<br>No discount"; ?></h6>             
          </div>
     </section>
</main>