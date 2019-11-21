<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Function List</h2>
            <?php foreach ($list as $cinema) {
                    $functionList=$cinema["functions"];
                ?>
                <form action="<?php echo FRONT_ROOT ?>Function/ShowDateRange" method="POST">
                <table>
                <tr>
                    <td>Start Date</td>
                    <td>Finish Date</td>
                    <td></td>
                </tr>
                <tr>
                    <td><input type="date" name="startDate" value="" class="form-control"></td>
                    <td><input type="date" name="endDate" value="" class="form-control"></td>
                    <td><button type="submit" class="btn btn-primary" name='list' value='<?php echo $idMovie_Selected ?>'> Search </button></td>
                </tr>
                </table>
                </form>
                <td>
                    <h4><?php if($cinema["functions"]!= NULL)echo $cinema["cinema"]->getCinemaName()?></h4>
                </td>
                <table class="table bg-light-alpha">

                    <form action="<?php echo FRONT_ROOT ?>Purchase/ShowBuyView" method="POST">
                        <thead>
                            <th>Movie Name</th>
                            <th>Movie Language</th>
                            <th>Runtime</th>
                            <th>Genre</th>
                            <th>Poster</th>
                            <th>Function Date</th>
                            <th>Function Time</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                                    foreach ($functionList as $function) {
                                        $movie = $function->getMovie();
                                        ?>
                                    <tr>
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
                                        <td>
                                            <button type="submit" class="btn btn-primary" name='buy_button' value='<?php echo $function->getIdFunction(); ?>'> Buy Tickets </button>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }

                        ?>
                        </tbody>
                    </form>

                </table>
        </div>
    </section>
</main>