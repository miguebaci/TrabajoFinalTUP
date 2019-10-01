<?php
    namespace Controllers;


    require_once("../Config/Config.php");
    require_once("../Config/Autoload.php");

    use Repositories\ICinemaRepository as ICinemaRepository;
    use Repositories\CinemaRepository as CinemaRepository;
    use Models\Cinema as Cinema;
    use Config\Autoload as Autoload;

    Autoload::Start();

    if($_POST){
        $cinemaName="";
        $adress="";
        $totalCap=0;
        $ticketPrice=0;
        if(isset($_POST["cinemaName"])){
            $cinemaName=$_POST["cinemaName"];
        }
        if(isset($_POST["adress"])){
            $adress=$_POST["adress"];
        }
        if(isset($_POST["totalCap"])){
            $totalCap=$_POST["totalCap"];
        }
        if(isset($_POST["ticketPrice"])){
            $ticketPrice=$_POST["ticketPrice"];
        }

        $newCinema=new Cinema($cinemaName,$adress,$totalCap,$ticketPrice);
        $repo=new CinemaRepository();
        $repo->Add($newCinema);
        /*$newCinema=new Cinema($cinemaName,$adress,$totalCap,$ticketPrice);
        $repo->Add($newCinema);*/

        echo "<script> alert('Cinema added');";
    }else{
        echo "<script> alert('Cinema error');";  
    }
    echo "window.location = '../index.php'; </script>";


?>