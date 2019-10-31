<?php
    namespace Models;

    use Models\MovieFunction as MovieFunction;

    class MovieFunction
    {   
        private $idFunction;
        private $date;
        private $time;

        public function __construct($idFunction, $date , $time){
            $this->idFunction = $idFunction;
            $this->date = $date;
            $this->time = $time;
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
    }
?>