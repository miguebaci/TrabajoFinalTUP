<?php
    namespace DAO;
    use Models\Movie as Movie;
    interface IMovieDAO
    {
        function Add(Movie $movie);
        function MXG($idMovie, $genres);
        function GetAll();
        function GetIdGenreById($idMovie);
        function UpdateAll();
    }
?>