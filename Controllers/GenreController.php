<?php
    namespace Controllers;

    use DAO\IGenreDAO as IGenreDAO;
    //use DAO\GenreDAO as GenreDAO;
    use DAO\GenreDAOJSON as GenreDAO;
    use Models\Genre as Genre;

    class GenreController
    {
        private $genreDAO;

        public function __construct()
        {
            $this->genreDAO = new GenreDAO();
        }

        public function UpdateGenres(){
            $this->genreDAO->UpdateAll();

            echo "Where do we go now?";
        }
    }
?>