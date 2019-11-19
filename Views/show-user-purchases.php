<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Purchases List</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>ID Purchase</th>
                         <th>Date of Purchase</th>
                         <th>Movie Name</th>
                         <th>Function Date</th>
                         <th>Ticket Number</th>
                         <th>Ticket Quantity</th>
                         <th>Total</th>
                         <th>QR</th>
                    </thead>
                    <tbody>
                        <?php 
                              foreach($purchaseList as $purchase)
                              {   
                                  $ticket=$purchase->getTicket();
                                  $function=$ticket->getMovieFunction();
                                  $movie=$function->getMovie();
                        ?>
                                        <tr>
                                             <td><?php echo $purchase->getIdPurchase() ?></td>
                                             <td><?php echo $purchase->getPurchase_date() ?></td>
                                             <td><?php echo $movie->getMovieName() ?></td>
                                             <td><?php echo $function->getDate()." ".$function->getTime() ?></td>
                                             <td><?php echo $ticket->getTicketNumber() ?></td>
                                             <td><?php echo $purchase->getTicketQuantity() ?></td>
                                             <td><?php echo "$".($purchase->getTotal() - ($purchase->getTotal()*$purchase->getDiscount()/100)) ?></td>
                                             <td><?php echo "<img src=".$ticket->getQR()."title='Your Ticket' />" ?></td>
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