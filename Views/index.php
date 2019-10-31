<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Elegir genero</h2>
               <form action="<?php echo FRONT_ROOT ?>Function/Select" method="post" class="bg-light-alpha p-5">
                    
                    <button type="submit" name="genre_select" value ="28" class="btn btn-dark mr-auto d-block">Action</button>
                    <button type="submit" name="genre_select" value ="12" class="btn btn-dark mr-auto d-block">Aventure</button>
                    <button type="submit" name="genre_select" value ="16" class="btn btn-dark mr-auto d-block">Animation</button>
                    <button type="submit" name="genre_select" value ="35" class="btn btn-dark mr-auto d-block">Comedy</button>
                    <button type="submit" name="genre_select" value ="80" class="btn btn-dark mr-auto d-block">Crime</button>
                    <button type="submit" name="genre_select" value ="99" class="btn btn-dark mr-auto d-block">Documentary</button>
                    <button type="submit" name="genre_select" value ="18" class="btn btn-dark mr-auto d-block">Drama</button>
                    <button type="submit" name="genre_select" value ="10751" class="btn btn-dark mr-auto d-block">Family</button>
                    <button type="submit" name="genre_select" value ="14" class="btn btn-dark mr-auto d-block">Fantasy</button>
                    <button type="submit" name="genre_select" value ="36" class="btn btn-dark mr-auto d-block">History</button>
                    <button type="submit" name="genre_select" value ="27" class="btn btn-dark mr-auto d-block">Horror</button>
                    <button type="submit" name="genre_select" value ="10402" class="btn btn-dark mr-auto d-block">Music</button>
                    <button type="submit" name="genre_select" value ="9648" class="btn btn-dark mr-auto d-block">Mystery</button>
                    <button type="submit" name="genre_select" value ="10749" class="btn btn-dark mr-auto d-block">Romance</button>
                    <button type="submit" name="genre_select" value ="878" class="btn btn-dark mr-auto d-block">Science Fiction</button>
                    <button type="submit" name="genre_select" value ="53" class="btn btn-dark mr-auto d-block">Thriller</button>
                    <button type="submit" name="genre_select" value ="10770" class="btn btn-dark mr-auto d-block">TV Movie</button>
                    <button type="submit" name="genre_select" value ="10752" class="btn btn-dark mr-auto d-block">War</button>
                    <button type="submit" name="genre_select" value ="37" class="btn btn-dark mr-auto d-block">Western</button>
               
               </form>
          </div>
     </section>
</main>