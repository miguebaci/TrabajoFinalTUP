<?php

    namespace Controllers;

    use Repositories\ICinemaRepository as ICinemaRepository;
    use Repositories\CinemaRepository as CinemaRepository;
    use Models\Cinema as Cinema;

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

        $cinema=new Cinema($cinemaName,$adress,$totalCap,$ticketPrice);
        $repo=new CinemaRepository();
        $repo->Add($cinema);
        echo "<script> alert('Cinema added');";
    }else{
        echo "<script> alert('Cinema error');";  
    }
    echo "window.location = '../cinema-add.php'; </script>";


?>