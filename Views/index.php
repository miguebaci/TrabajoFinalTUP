<?php
require_once('nav.php');
require_once('get-active.php');
?>

<main class="py-5">
     <div class="slideshow-container">
          <form action="<?php echo FRONT_ROOT ?>Function/Select" method="post" class="bg-light-alpha p-5">
               <?php

               foreach ($movieList as $movie) {
                    ?>
                    <article>

                         <div class="container">
                              <div class="mySlides">
                                   <div class="row" style="margin-bottom:50px">
                                        <h2>Now Screening</h2>
                                   </div>
                                   <div class="row">
                                        <div class="column">
                                             <button type="sumbit" class="btn" name="idMovie_Selected" value="<?php echo $movie->getIdMovie(); ?>"><?php echo "<" . POSTER_ROOT . $movie->getImage() . " width='180' height='240'>" ?></button>
                                        </div>
                                        <div class="column"></div>
                                        <div class="column" style="margin-left:50px">
                                             <h5><?php echo $movie->getMovieName() ?></h5>
                                             <br><br>
                                             <h5>Duration: <?php echo $movie->getDuration() ?> min </h5>
                                             <br><br>
                                             <h5>Genres: <?php $genreArray = $movie->getGenre();
                                                                 foreach ($genreArray as $genres) {
                                                                      echo $genres->getDescription();
                                                                      if (next($genreArray)) {
                                                                           echo "/";
                                                                      }
                                                                 } ?></h5>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </article>
               <?php } ?>
          </form>


          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>

     </div>
     <br>

     <script>
          var slideIndex = 1;
          showSlides(slideIndex);

          function plusSlides(n) {
               showSlides(slideIndex += n);
          }

          function currentSlide(n) {
               showSlides(slideIndex = n);
          }

          function showSlides(n) {
               var i;
               var slides = document.getElementsByClassName("mySlides");
               var dots = document.getElementsByClassName("dot");
               if (n > slides.length) {
                    slideIndex = 1
               }
               if (n < 1) {
                    slideIndex = slides.length
               }
               for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
               }
               for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
               }
               slides[slideIndex - 1].style.display = "block";
               dots[slideIndex - 1].className += " active";
          }
     </script>
</main>