<?php
    namespace Controllers;

    use DAO\IRoomDAO as IRoomDAO;
    use DAO\RoomDAO as RoomDAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use DAO\CinemaDAO as CinemaDAO;

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
            if(isset($_SESSION["loggedUser"])){
                if($_SESSION["loggedUser"]->getRole()=="Admin"){
                    require_once(VIEWS_PATH."cinema-add.php");
                }else{
                    echo "<script> alert('You need to be admin to access this page');";  
                    echo "window.location = '../index.php'; </script>";
                }
            }else{
                echo "<script> alert('You need to be admin to access this page');";  
                echo "window.location = '../index.php'; </script>";
            }
                
        }

        public function ShowListView()
        {
            if(isset($_SESSION["loggedUser"])){
                if($_SESSION["loggedUser"]->getRole()=="Admin"){
                    $cinemaList = $this->cinemaDAO->GetAll();
                    require_once(VIEWS_PATH."cinema-list.php");
                }else{
                    echo "<script> alert('You need to be admin to access this page');";  
                    echo "window.location = '../index.php'; </script>";
                }
            }else{
                echo "<script> alert('You need to be admin to access this page');";  
                echo "window.location = '../index.php'; </script>";
            }
            
        }

        public function Add()
        {   
            if($_POST){
                $cinemaName="";
                $adress="";
                $ticketPrice=0;
                if(isset($_POST["cinemaName"])){
                    $cinemaName=$_POST["cinemaName"];
                }
                if(isset($_POST["adress"])){
                    $adress=$_POST["adress"];
                }
                if(isset($_POST["ticketPrice"])){
                    $ticketPrice=$_POST["ticketPrice"];
                }
        
                $newCinema=new Cinema(0,$cinemaName,$adress,$ticketPrice);
                $this->cinemaDAO->Add($newCinema);
        
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
                $cinema=$this->cinemaDAO->GetById($updatedCinema["idCinema"]);
                $this->cinemaDAO->Update($cinema, $updatedCinema);
                $this->ShowListView();

            }
        }

        public function Select()
        {   
            if($_POST){

                if(isset($_POST["room_button"])){
                    $idCinema=$_POST["room_button"];
                    $cinemaRoomDAO=new RoomDAO(); 
                    $cinema=$this->cinemaDAO->GetById($idCinema);
                    $cinemaRoomList=$cinemaRoomDAO->GetAllByCinemaId($idCinema);
                    require_once(VIEWS_PATH."cinemaRoom-list.php");

                }
                if(isset($_POST["edit_button"])){
                    $idCinema=$_POST["edit_button"];
                    $cinema=$this->cinemaDAO->GetById($idCinema);
                    require_once(VIEWS_PATH."cinema-mod.php");

                }
                else if(isset($_POST["delete_button"])){
                    $idCinema=$_POST["delete_button"];
                    $cinema=$this->cinemaDAO->GetById($idCinema);
                    $this->cinemaDAO->Delete($cinema);
                    $this->ShowListView();
                }
        }
        }
    }
?>