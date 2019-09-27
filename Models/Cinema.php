<?php
    namespace Models;

    use Models\Cinema as Cinema;

    class Cinema
    {
        private $cinemaName;
        private $totalCap;
        private $adress;
        private $ticketPrice;

        public function __contruct($cinemaName, $adress, $totalCap, $ticketPrice){
            $this->cinemaName = $cinemaName;
            $this->totalCap = $totalCap;
            $this->adress = $adress;
            $this->ticketPrice = $ticketPrice;
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

