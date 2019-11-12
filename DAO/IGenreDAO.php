<?php
    namespace DAO;
    use Models\Genre as Genre;
    interface IGenreDAO
    {
        function Add(Genre $genre);
        function GetAll();
        function UpdateAll();
        function GetById($idGenre);
        function GetAllGenresByIds($genres);
        function GetIdGenreById($idMovie);
    }
?>