<?php
 namespace Models;

 use Models\CinemaRoom as CinemaRoom;

 class CinemaRoom
 {
     
     private $idCinemaRoom;
     private $roomName;
     private $totalCap;

     public function __construct($idCinemaRoom, $roomName, $totalCap){
         $this->idCinemaRoom=$idCinemaRoom;
         $this->roomName=$roomName;
         $this->totalCap = $totalCap;
     }
     
     public function setIdCinemaRoom($idCinemaRoom){
         $this->idCinemaRoom=$idCinemaRoom;
     }

     public function getIdCinemaRoom()
     {
         return $this->idCinemaRoom;
     }

     public function setRoomName($roomName){
        $this->roomName=$roomName;
    }

    public function getRoomName()
    {
        return $this->roomName;
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