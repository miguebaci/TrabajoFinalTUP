<?php
    namespace Controllers;

    use DAO\IMovieDAO as IMovieDAO;
    use DAO\MovieDAO as MovieDAO;
    //use DAO\MovieDAOJSON as MovieDAO;

    use DAO\IGenreDAO as IGenreDAO;
    use DAO\GenreDAO as GenreDAO;
    //use DAO\GenreDAOJSON as GenreDAO;

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
            $movieList = $this->movieDAO->GetAll();
            $genreRepo = new GenreDAO();
            require_once(VIEWS_PATH."movie-list.php");
        }
        public function UpdateMovies(){
            $this->movieDAO->UpdateAll();

            $this->ShowListView();
        }
    }
?>