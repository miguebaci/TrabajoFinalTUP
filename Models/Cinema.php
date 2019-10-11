<?php
    namespace Models;

    use Models\Cinema as Cinema;

    class Cinema
    {
        
        private $idCinema;
        private $cinemaName;
        private $totalCap;
        private $adress;
        private $ticketPrice;

        public function __construct($idCinema,$cinemaName, $adress, $totalCap, $ticketPrice){
            $this->idCinema=$idCinema;
            $this->cinemaName = $cinemaName;
            $this->totalCap = $totalCap;
            $this->adress = $adress;
            $this->ticketPrice = $ticketPrice;
        }
        
       public function getIdCinema()
        {
            return $this->idCinema;
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

