<?php
    namespace Models;

    use Models\Cinema as Cinema;

    class Cinema
    {
        // private static $autoIncrement=0;
        //private $idCine;
        private $cinemaName;
        private $totalCap;
        private $adress;
        private $ticketPrice;

        public function __construct($cinemaName, $adress, $totalCap, $ticketPrice){
        //    $this->idCine = self::IncrementId();
            $this->cinemaName = $cinemaName;
            $this->totalCap = $totalCap;
            $this->adress = $adress;
            $this->ticketPrice = $ticketPrice;
        }
        
        /*public function getIdCine()
        {
            return $this->idCine;
        }*/

        /*public function setIdCine($idCine)
        {
            $this->idCine = $idCine;
        }*/

       /* private static function IncrementId(){
            self::$autoIncrement++;
            return self::$autoIncrement;
        }*/

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

        public function setAdress($adress)
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

