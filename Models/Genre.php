<?php
    namespace Models;

    use Models\Genre as Genre;

    class Genre
    {   
        private $description;

        public function __construct($description){
            $this->description = $description;
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