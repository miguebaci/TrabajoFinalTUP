<?php
    namespace Models;

    use Models\MovieFunction as MovieFunction;

    class MovieFunction
    {   
        private $idFunction;
        private $date;
        private $time;

        public function __construct($day){
            $this->day = $day;
        }

        public function getIdFunction()
        {
            return $this->idFunction;
        }

        public function getDate()
        {
            return $this->day;
        }

        public function setDate($day)
        {
            $this->day = $day;
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