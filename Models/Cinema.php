<?php
    namespace Models;

    use Models\Cinema as Cinema;

    class Cinema
    {
        private static $autoIncrement=0;
        private $idCine;
        private $cinemaName;
        private $totalCap;
        private $adress;
        private $ticketPrice;

        public function __contruct($cinemaName, $adress, $totalCap, $ticketPrice){
            $this->idCine = IncrementId();
            $this->cinemaName = $cinemaName;
            $this->totalCap = $totalCap;
            $this->adress = $adress;
            $this->ticketPrice = $ticketPrice;
        }
        
        public function getIdCine()
        {
            return $this->idCine;
        }

        private static function IncrementId(){
            self::$autoIncrement++;
            return $autoIncrement;
        }

        public function getCinemaName()
        {
            return $this->cinemaName;
        }

        public function setCinemaName($cinemaName)
        {
            $this->cinemaName = $cinemaName;
        }

        public function getAdress()
        {
            return $this->adress;
        }

        public function setadress($adress)
        {
            $this->adress = $adress;
        }

        public function getTotalCap()
        {
            return $this->totalCap;
        }

        public function setTotalCap($totalCap)
        {
            $this->totalCap = $totalCap;
        }

        public function getTicketPrice()
        {
            return $this->ticketPrice;
        }

        public function setTicketPrice($ticketPrice)
        {
            $this->ticketPrice = $ticketPrice;
        }
    }
?>

