<?php
    namespace Models;

    use Models\MovieFunction as MovieFunction;

    class MovieFunction
    {   
        private $idFunction;
        private $date;
        private $time;
        private $movie;
        private $room;

        public function __construct($idFunction, $date , $time, $movie){
            $this->idFunction = $idFunction;
            $this->date = $date;
            $this->time = $time;
            $this->movie = $movie;
            $this->room = NULL;
        }

        public function getIdFunction()
        {
            return $this->idFunction;
        }

        public function getDate()
        {
            return $this->date;
        }

        public function setDate($date)
        {
            $this->date = $date;
        }

        public function getTime()
        {
            return $this->time;
        }

        public function setTime($time)
        {
            $this->time = $time;
        }

        public function getMovie()
        {
            return $this->movie;
        }

        public function setMovie($movie)
        {
            $this->movie = $movie;
        }

        public function getRoom()
        {
            return $this->room;
        }

        public function setRoom($room)
        {
            $this->room = $room;
        }
    }
?>