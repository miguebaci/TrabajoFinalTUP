<?php
    namespace DAO;
    use Models\CinemaRoom as CinemaRoom;
    use Models\Cinema as Cinema;
    interface IRoomDAO
    {
        function Add(CinemaRoom $cinemaRoom);
        function GetAll();
        function GetAllByCinemaId($idCinema);
        function Delete(CinemaRoom $cinemaRoom);
        function Update(CinemaRoom $cinemaRoom, $updatedRoom);
        function GetById($idRoom);
        function GetCinemaId(CinemaRoom $cinemaRoom);
        function GetCinemaById($idCinema);
        function CinemaExist($idCinema);
    }
?>