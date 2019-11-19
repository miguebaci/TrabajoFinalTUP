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
            require_once(VIEWS_PATH."validate-session-admin.php");
            $this->genreDAO->UpdateAll();
        }
    }
?>