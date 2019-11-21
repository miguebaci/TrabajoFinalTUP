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
        private $user;

        public function __construct($purchase_date, $total, $ticketQuantity, $discount, $user){
            $this->purchase_date = $purchase_date;
            $this->ticketQuantity = $ticketQuantity;
            $this->total = $total;
            $this->discount = $discount;
            $this->user=$user;
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

        public function getUser()
        {
            return $this->user;
        }

        public function setUser($user)
        {
            $this->user = $user;
        }

    }
?>