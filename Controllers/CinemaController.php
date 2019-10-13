<?php
    namespace Controllers;

    use DAO\ICinemaDAO as ICinemaDAO;
    //use DAO\CinemaDAO as CinemaDAO;
    use DAO\CinemaDAOJSON as CinemaDAO;
    use Models\Cinema as Cinema;

    class CinemaController
    {
        private $cinemaDAO;

        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."cinema-add.php");
        }

        public function ShowListView()
        {
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function Add()
        {   
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
        
                $newCinema=new Cinema(0,$cinemaName,$adress,$totalCap,$ticketPrice);
                $repo=new CinemaDAO();
                $repo->Add($newCinema);
        
                echo "<script> alert('Cinema added');";
            }else{
                echo "<script> alert('Cinema error');";  
            }
            echo "window.location = '../index.php'; </script>";
        }

        public function Update()
        {   
            if($_POST){
                $updatedCinema=$_POST;
                $repo=new CinemaDAO();
                $cinema=$repo->GetById($updatedCinema["idCinema"]);
                $repo->Update($cinema, $updatedCinema);
                $this->ShowListView();

            }
        }

        public function Select()
        {   
            if($_POST){
                
                if(isset($_POST["edit_button"])){
                    $idCinema=$_POST["edit_button"];
                    $repo=new CinemaDAO();
                    $cinema=$repo->GetById($idCinema);
                    require_once(VIEWS_PATH."cinema-mod.php");

                }
                else if(isset($_POST["delete_button"])){
                    $idCinema=$_POST["delete_button"];
                    $repo=new CinemaDAO();
                    $cinema=$repo->GetById($idCinema);
                    $repo->Delete($cinema);
                    $this->ShowListView();
                }
        }
        }
    }
?>