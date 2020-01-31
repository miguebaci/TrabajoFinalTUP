<?php
    require_once("nav.php")
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="row py-3">    
                <div class="col-12">
                    <h3 align="center"><?php echo $message; ?></h3>   
                </div>
            </div>
            <div class="row justify-content-center py-3">
                <div class="col-3">
                    <a class="btn btn-dark d-block" href=<?php echo $location; ?>>Continue</a>
                </div>
            </div>
        </div>
    </section>
</main>



