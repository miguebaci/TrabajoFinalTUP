<?php
namespace Models;

    class Purchase
    {
        private $idPurchase;
        private $purchase_date;
        private $total;
        private $discount;
        private $tickets;
        private $user;

        public function __construct($purchase_date, $total, $discount, $user, $tickets=array()){
            $this->purchase_date = $purchase_date;
            $this->total = $total;
            $this->discount = $discount;
            $this->user=$user;
            $this->tickets=$tickets;
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

        public function getDiscount()
        {
            return $this->discount;
        }

        public function setDiscount($discount)
        {
            $this->discount = $discount;
        }

        public function getTickets()
        {
            return $this->tickets;
        }

        public function setTickets($tickets)
        {
            $this->tickets = $tickets;
        }

        public function addTickets($tickets){
            array_push($this->tickets,$tickets);
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