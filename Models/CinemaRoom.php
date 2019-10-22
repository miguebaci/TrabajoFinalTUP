<?php
 namespace Models;

 use Models\CinemaRoom as CinemaRoom;

 class CinemaRoom
 {
     
     private $idCinemaRoom;
     private $totalCap;

     public function __construct($idCinemaRoom,$totalCap){
         $this->idCinemaRoom=$idCinemaRoom;
         $this->totalCap = $totalCap;
     }
     
     public function setIdCinemaRoom($idCinemaRoom){
         $this->idCinemaRoom=$idCinemaRoom;
     }

     public function getIdCinemaRoom()
     {
         return $this->idCinemaRoom;
     }
     public function getTotalCap()
     {
         return $this->totalCap;
     }

     public function setTotalCap($totalCap)
     {
         $this->totalCap = $totalCap;
     }
 }
?>