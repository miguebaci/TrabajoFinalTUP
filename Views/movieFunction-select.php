<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Funciones</h2>
            <?php foreach ($cinemaList as $cinema) {
                $roomList = $cinema->getCinemaRoomList();
                ?>
                <td>
                    <h4><?php echo $cinema->getCinemaName()?></h4>
                </td>
                <table class="table bg-light-alpha">

                    <form action="<?php echo FRONT_ROOT ?>Purchase/ShowBuyView" method="POST">
                        <thead>
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
                            <?php
                                foreach ($roomList as $room) {
                                    $functionList = $room->getFunctionList();

                                    foreach ($functionList as $function) {
                                        $movie = $function->getMovie();
                                        ?>
                                    <tr>
                                        <td><?php echo $movie->getMovieName() ?></td>
                                        <td><?php echo $movie->getLanguage() ?></td>
                                        <td><?php echo $movie->getDuration() ?></td>
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
                                        <td>
                                            <button type="submit" class="btn btn-primary" name='buy_button' value='<?php echo $function->getIdFunction(); ?>'> Comprar </button>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        }

                        ?>
                        </tbody>
                    </form>

                </table>
        </div>
    </section>
</main>