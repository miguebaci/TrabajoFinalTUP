<?php
 namespace Models;

 class CinemaRoom
 {
     
     private $idCinemaRoom;
     private $roomName;
     private $totalCap;
     private $functionList;
     private $cinema;

     public function __construct($idCinemaRoom, $roomName, $totalCap){
         $this->idCinemaRoom=$idCinemaRoom;
         $this->roomName=$roomName;
         $this->totalCap = $totalCap;
         $this->functionList = array();
         $this->cinema= NULL;
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

     public function getFunctionList()
     {
         return $this->functionList;
     }

     public function setFunctionList($functionList)
     {
         $this->functionList = $functionList;
     }

     public function getCinema()
     {
         return $this->cinema;
     }

     public function setCinema($cinema)
     {
         $this->cinema = $cinema;
     }

 }
?>