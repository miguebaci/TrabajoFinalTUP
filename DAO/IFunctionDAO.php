<?php
    namespace DAO;
    use Models\MovieFunction as MovieFunction;
    use Models\CinemaRoom as CinemaRoom;
    interface IFunctionDAO
    {
        function Add(MovieFunction $movieFunction);
        function GetAll();
        function GetAllByRoomId(CinemaRoom $room);
        function GetMovieByFunctionId($idFunction);
        function Delete(MovieFunction $movieFunction);
        function DeleteOldFunctions();
        function GetById($idFunction);
        function FunctionExist(CinemaRoom $room, $date, $time);
        function GetRoomId(MovieFunction $movieFunction);
    }
