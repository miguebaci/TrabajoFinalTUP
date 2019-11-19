<?php
    namespace Helper;

    use DAO\GenreDAO as GenreDAO;
    use Models\Genre as Genre;


    class GenreHelper{

        private $genreDAO;

        public function __construct()
        {   
            $this->genreDAO = new GenreDAO();
        }

        function helpGenre(){
            return $this->genreDAO->GetAll();
        }

        function helpGenreList(){
            $this->genreDAO->UpdateAll();
        }
        
        function getGenreDAO(){
            return $this->genreDAO;
        }
    }

?>