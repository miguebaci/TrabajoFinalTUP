<?php
    namespace DAO;
    use Models\MovieFunction as MovieFunction;
    interface IFunctionDAO
    {
        function Add(MovieFunction $movieFunction, CinemaRoom $room);
        function GetAll();
        function GetAllByRoomId(CinemaRoom $room);
        function GetAllByGenre($idGenre);
        function GetMovieByFunctionId(MovieFunction $movieFunction);
        function Delete(MovieFunction $movieFunction);
        function GetById(MovieFunction $function);
        function FunctionExist(CinemaRoom $room, $date, $time);
        function GetRoomId(MovieFunction $movieFunction);
    }
?>