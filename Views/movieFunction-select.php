<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Funciones</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Cine</th>
                    <th>Direccion</th>
                    <th>Nombre</th>
                    <th>Lenguaje</th>
                    <th>Duracion total</th>
                    <th>Genero/s</th>
                    <th>Poster</th>
                    <th>Dia de la Funcion</th>
                    <th>Horario de la Funcion</th>
                    <th></th>
                </thead>
                <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Purchase/ShowBuyView" method="POST">
                        <?php
                        foreach ($functionList as $function) {
                            $movie = $function->getMovie();
                            $cinema = $this->functionDAO->GetCinemaByFunction($function);
                            ?>
                            <tr>
                                <td><?php echo $cinema->getCinemaName() ?></td>
                                <td><?php echo $cinema->getAdress() ?></td>
                                <td><?php echo $movie->getMovieName() ?></td>
                                <td><?php echo $movie->getLanguage() ?></td>
                                <td><?php echo $movie->getDuration() ?> min</td>
                                <td><?php $genreArray = $movie->getGenre();
                                        foreach ($genreArray as $genres) {
                                            echo $genres->getDescription();
                                            if (next($genreArray)) {
                                                echo "/ ";
                                            }
                                        } ?></td>
                                <td><?php echo "<" . POSTER_ROOT . $movie->getImage() . " width='180' height='240'>" ?></td>
                                <td><?php echo $function->getDate() ?></td>
                                <td><?php echo $function->getTime() ?></td>
                                <td><button type="submit" class="btn btn-primary" name='buy_button' value='<?php echo $function->getIdFunction(); ?>'> Comprar </button><td>
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