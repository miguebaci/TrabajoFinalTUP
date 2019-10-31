<?php
    namespace Controllers;

    use DAO\IGenreDAO as IGenreDAO;
    use DAO\GenreDAO as GenreDAO;
    use Models\Genre as Genre;

    class GenreController
    {
        private $genreDAO;

        public function __construct()
        {
            $this->genreDAO = new GenreDAO();
        }

        public function UpdateGenres(){
            if(isset($_SESSION["loggedUser"])){
                if($_SESSION["loggedUser"]->getRole()=="Admin"){
                    $this->genreDAO->UpdateAll();
                    echo "<script> alert('Genres Updated');";  
                    echo "window.location = '../index.php'; </script>";
                }else{
                    echo "<script> alert('You need to be admin to access this page');";  
                    echo "window.location = '../index.php'; </script>";
            }
            }else{
                echo "<script> alert('You need to be admin to access this page');";  
                echo "window.location = '../index.php'; </script>";
            }
        }
    }
?>