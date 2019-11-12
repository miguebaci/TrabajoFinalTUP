<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h1>Present this at the cinema</h1>
               <img src=<?php echo $purchase->getTicket()->getQR(); ?> title="Your Ticket" />
               
          </div>
     </section>
</main>