<?php
    namespace Models;

    use Models\Ticket as Ticket;

    class Ticket
    {
        private $QR;
        private $ticketNumber;

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
    }
?>