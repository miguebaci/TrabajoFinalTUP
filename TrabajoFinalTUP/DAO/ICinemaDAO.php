<?php
    namespace DAO;
    use Models\Cinema as Cinema;
    interface ICinemaDAO
    {
        function Add(Cinema $cinema);
        function GetAll();
        function Delete(Cinema $cinema);
        function GetById($idCinema);
    }
?>