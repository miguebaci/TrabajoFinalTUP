<?php
    namespace Repositories;

    use Models\Cinema as Cinema;

    interface ICinemaRepository
    {
        function Add(Cinema $cinema);
        function GetAll();
    }
?>