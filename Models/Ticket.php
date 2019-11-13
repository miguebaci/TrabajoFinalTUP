<?php
    namespace Models;

    class Ticket
    {
        private $QR;
        private $ticketNumber;
        private $movieFunction;

        public function getQR()
        {
            return $this->QR;
        }

        public function setQR($QR)
        {
            $this->QR = $QR;
        }

        public function getTicketNumber()
        {
            return $this->ticketNumber;
        }

        public function setTicketNumber($ticketNumber)
        {
            $this->ticketNumber = $ticketNumber;
        }

        public function getMovieFunction(){
            return $this->movieFunction;
        }

        public function setMovieFunction($movieFunction){
            $this->movieFunction=$movieFunction;
        }
    }
?>