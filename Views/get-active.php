<?php
use DAO\FunctionDAO as FunctionDAO;

$functionDAO = new FunctionDAO;
$functionList = $functionDAO->GetAll();
$movieList = $functionDAO->GetAllMoviesInFunctions();
?>