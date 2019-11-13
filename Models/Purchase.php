<?php
namespace Models;

    class Purchase
    {
        private $idPurchase;
        private $purchase_date;
        private $ticketQuantity;
        private $total;
        private $discount;
        private $ticket;

        public function __construct($purchase_date, $total, $ticketQuantity, $discount){
            $this->purchase_date = $purchase_date;
            $this->ticketQuantity = $ticketQuantity;
            $this->total = $total;
            $this->discount = $discount;
        }

        public function getIdPurchase()
        {
            return $this->idPurchase;
        }

        public function setIdPurchase($idPurchase)
        {
            $this->idPurchase = $idPurchase;
        }

        public function getPurchase_date()
        {
            return $this->purchase_date;
        }

        public function setPurchase_date($purchase_date)
        {
            $this->purchase_date = $purchase_date;
        }

        public function getTotal()
        {
            return $this->total;
        }

        public function setTotal($total)
        {
            $this->total = $total;
        }

        public function getTicketQuantity()
        {
            return $this->ticketQuantity;
        }

        public function setTicketQuantity($ticketQuantity)
        {
            $this->ticketQuantity = $ticketQuantity;
        }

        public function getDiscount()
        {
            return $this->discount;
        }

        public function setDiscount($discount)
        {
            $this->discount = $discount;
        }

        public function getTicket()
        {
            return $this->ticket;
        }

        public function setTicket($ticket)
        {
            $this->ticket = $ticket;
        }

    }
?>