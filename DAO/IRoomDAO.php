<?php
    namespace DAO;
    use Models\CinemaRoom as CinemaRoom;
    use Models\Cinema as Cinema;
    interface IRoomDAO
    {
        function Add(CinemaRoom $cinemaRoom, Cinema $cinema);
        function GetAll();
        function GetAllByCinemaId(Cinema $cinema);
        function Delete(CinemaRoom $cinemaRoom);
        function Update(CinemaRoom $cinemaRoom, $updatedRoom);
        function GetById($idRoom);
        function GetCinemaId(CinemaRoom $cinemaRoom);
    }
?>