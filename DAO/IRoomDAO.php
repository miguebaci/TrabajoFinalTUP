<?php
    namespace DAO;
    use Models\CinemaRoom as CinemaRoom;
    interface IRoomDAO
    {
        function Add(CinemaRoom $cinemaRoom, $idCinema);
        function GetAll();
        function Delete(CinemaRoom $cinemaRoom);
        function Update(CinemaRoom $cinemaRoom, $updatedRoom);
        function GetById($idCinemaRoom);
    }
?>