<?php
    namespace Controllers;

    use DAO\IMovieDAO as IMovieDAO;
    use DAO\MovieDAO as MovieDAO;

    use DAO\IGenreDAO as IGenreDAO;
    use DAO\GenreDAO as GenreDAO;

    use Models\Movie as Movie;
    use Models\Genre as Genre;

    class MovieController
    {
        private $movieDAO;

        public function __construct()
        {
            $this->movieDAO = new movieDAO();
        }
        public function ShowListView()
        {
            if(isset($_SESSION["loggedUser"])){
                if($_SESSION["loggedUser"]->getRole()=="Admin"){
                    $movieList = $this->movieDAO->GetAll();
                    $genreRepo = new GenreDAO();
                    require_once(VIEWS_PATH."movie-list.php");
                }else{
                    echo "<script> alert('You need to be admin to access this page');";  
                    echo "window.location = '../index.php'; </script>";
                }
            }else{
                echo "<script> alert('You need to be admin to access this page');";  
                echo "window.location = '../index.php'; </script>";
            }
            
        }

        public function UpdateMovies(){
            if(isset($_SESSION["loggedUser"])){
                if($_SESSION["loggedUser"]->getRole()=="Admin"){
                    $this->movieDAO->UpdateAll();

                    $this->ShowListView();
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