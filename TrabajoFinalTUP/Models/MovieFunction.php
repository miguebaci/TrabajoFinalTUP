<?php
    namespace Models;

    use Models\MovieFunction as MovieFunction;

    class MovieFunction
    {
        private $day;
        private $time;

        public function __construct($day){
            $this->day = $day;
        }

        public function getDay()
        {
            return $this->day;
        }

        public function setDay($day)
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