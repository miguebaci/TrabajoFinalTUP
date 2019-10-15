<?php
    namespace Models;

    use Models\Genre as Genre;

    class Genre
    {   
        private $idGenre;
        private $description;

        public function __construct($idGenre,$description){
            $this->idGenre=$idGenre;
            $this->description = $description;
        }

        public function setIdGenre($idGenre){
            $this->idGenre=$idGenre;
        }

        public function getIdGenre(){
            return $this->idGenre;
        }

        public function getDescription()
        {
            return $this->description;
        }

        public function setDescription($description)
        {
            $this->description = $description;
        }
    }
?>