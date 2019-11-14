<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h3>Compra</h3>
               <form action="<?php echo FRONT_ROOT ?>Purchase/Buy" method="POST">
                    <input type="text" name="discount" placeholder="Discount Code" id="">
                    <input type="number" name="quantity" placeholder="Quantity" min = "1" id="" required>
                    <button type="submit" class ="btn btn-danger" name ='buy_button' value='<?php echo $idFunction ?>'> Comprar </button>
               </form>
          </div>
     </section>
</main>