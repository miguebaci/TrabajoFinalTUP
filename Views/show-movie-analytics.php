<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h3>Sales for the movie <?php echo $movie->getMovieName(); echo $_POST["date_start"]==$_POST["date_end"] ? "<br>For the date of ".$_POST["date_start"] : "<br>For the dates between ".$_POST["date_start"]." and ".$_POST["date_end"]; ?> </h3>
               <h5>Total recollected: <?php echo $analytics["Total"]; ?></h5>
               <h5>Tickets sold: <?php echo $analytics["Tickets"]; ?></h5>
          </div>
     </section>
</main>