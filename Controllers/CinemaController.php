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
            require_once(VIEWS_PATH."validate-session-admin.php");
            require_once(VIEWS_PATH."cinema-add.php");   
        }

        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH."cinema-list.php");
            
        }

        public function Add()
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
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
                $array=array();
                $newCinema=new Cinema(0,$cinemaName,$adress,$ticketPrice,$array);
                $this->cinemaDAO->Add($newCinema);
        
                echo "<script> alert('Cinema added');";
            }else{
                echo "<script> alert('Cinema error');";  
            }
            echo "</script>";
            $this->ShowListView();
        }

        public function Update()
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            if($_POST){
                $cinema=$this->cinemaDAO->GetById($_POST["idCinema"]);
                $this->cinemaDAO->Update($cinema, $_POST);
                $this->ShowListView();

            }
        }

        public function Select()
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            if($_POST){

                if(isset($_POST["add_button"])){
                    $this->ShowAddView();
                }

                if(isset($_POST["room_button"])){
                    $cinema=$this->cinemaDAO->GetById($_POST["room_button"]);
                    $cinemaRoomList=$cinema->getCinemaRoomList();
                    require_once(VIEWS_PATH."cinemaRoom-list.php");
                }

                if(isset($_POST["edit_button"])){
                    $cinema=$this->cinemaDAO->GetById($_POST["edit_button"]);
                    require_once(VIEWS_PATH."cinema-mod.php");

                }
                else if(isset($_POST["delete_button"])){
                    $cinema=$this->cinemaDAO->GetById($_POST["delete_button"]);
                    $this->cinemaDAO->Delete($cinema);
                    $this->ShowListView();
                }
            }
        }
    }
?>