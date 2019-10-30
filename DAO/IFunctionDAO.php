<?php
    namespace DAO;
    use Models\MovieFunction as MovieFunction;
    interface IFunctionDAO
    {
        function Add(MovieFunction $movieFunction, $idMovie, $idRoom);
        function GetAll();
        function Delete(MovieFunction $movieFunction);
        function Update(MovieFunction $movieFunction, $updatedRoom);
        function GetById($idFunction);
    }
?>