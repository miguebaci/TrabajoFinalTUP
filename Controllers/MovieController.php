<?php
    namespace Controllers;

    use DAO\IMovieDAO as IMovieDAO;
    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

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

            require_once(VIEWS_PATH."movie-list.php");
        }
        public function UpdateMovies(){
            $this->movieDAO->UpdateAll();

            require_once(VIEWS_PATH."movie-list.php");
        }
?>