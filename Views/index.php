<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h1>Index</h1>
               <form action="Purchase/Buy" method="POST">
                    <input type="number" name="idMovieFunction" placeholder="ID MOVIE FUNCTION" id="" required>
                    <input type="number" name="discount" placeholder="Discount" id="" required>
                    <input type="number" name="quantity" placeholder="Quantity" id="" required>
                    <input type="submit" value="submit">
                    <!-- QR <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=Peliculas&choe=UTF-8" title="Link to Google.com" />  -->
               </form>
          </div>
     </section>
</main>