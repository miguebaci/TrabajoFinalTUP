<?php
use DAO\FunctionDAO as FunctionDAO;
$functionDAO = new FunctionDAO;
$functionList = $functionDAO->GetAll();
$movieList = array();
    foreach ($functionList as $function) 
    {
        $movie = $functionDAO->GetMovieByFunctionId($function->getIdFunction());
            if(!in_array($movie, $movieList))
            {
                array_push($movieList,$movie);
            }
    }
?>