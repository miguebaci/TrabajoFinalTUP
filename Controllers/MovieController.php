<?php
    namespace Controllers;

    use DAO\IMovieDAO as IMovieDAO;
    use DAO\MovieDAO as MovieDAO;

    use DAO\IGenreDAO as IGenreDAO;
    use DAO\GenreDAO as GenreDAO;
use Helper\GenreHelper;
use Models\Movie as Movie;
    use Models\Genre as Genre;

    class MovieController
    {
        private $movieDAO;
        private $genreHelper;

        public function __construct()
        {
            $this->movieDAO = new movieDAO();
            $this->genreHelper = new GenreHelper();
        }
        
        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            $movieList = $this->movieDAO->GetAll();
            $genreRepo = $this->genreHelper->getGenreDAO();
            require_once(VIEWS_PATH."movie-list.php");
            
        }

        public function UpdateMovies(){
            require_once(VIEWS_PATH."validate-session-admin.php");
            $this->genreHelper->helpGenre();
            $this->movieDAO->UpdateAll();
            $this->ShowListView();
        }
    }    
?>