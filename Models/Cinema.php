<?php
    namespace Models;

    class Cinema
    {
        
        private $idCinema;
        private $cinemaName;
        private $address;
        private $ticketPrice;
        private $cinemaRoomList;

        public function __construct($idCinema,$cinemaName, $address, $ticketPrice){
            $this->idCinema=$idCinema;
            $this->cinemaName = $cinemaName;
            $this->address = $address;
            $this->ticketPrice = $ticketPrice;
            $this->cinemaRoomList = array();
        }
        
        public function setIdCinema($idCinema){
            $this->idCinema=$idCinema;
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

        public function getAddress()
        {
            return $this->address;
        }

        public function setAddress($address)
        {
            $this->address = $address;
        }

        public function getTicketPrice()
        {
            return $this->ticketPrice;
        }

        public function setTicketPrice($ticketPrice)
        {
            $this->ticketPrice = $ticketPrice;
        }

        public function getCinemaRoomList()
        {
            return $this->cinemaRoomList;
        }

        public function setCinemaRoomList($cinemaRoomList)
        {
            $this->cinemaRoomList = $cinemaRoomList;
        }
    }
?>

