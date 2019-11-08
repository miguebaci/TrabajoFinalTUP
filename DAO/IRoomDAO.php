<?php
    namespace DAO;
    use Models\CinemaRoom as CinemaRoom;
    interface IRoomDAO
    {
        function Add(CinemaRoom $cinemaRoom, Cinema $cinema);
        function GetAll();
        function GetAllByCinemaId(Cinema $cinema);
        function Delete(CinemaRoom $cinemaRoom);
        function Update(CinemaRoom $cinemaRoom, $updatedRoom);
        function GetById(CinemaRoom $cinemaRoom);
        function GetCinemaId(CinemaRoom $cinemaRoom);
    }
?>