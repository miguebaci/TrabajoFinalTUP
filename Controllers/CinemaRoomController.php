<?php
    namespace Controllers;

    use DAO\IRoomDAO as IRoomDAO;
    use DAO\RoomDAO as RoomDAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use DAO\CinemaDAO as CinemaDAO;

    use Models\CinemaRoom as CinemaRoom;

    class CinemaRoomController
    {
        private $cinemaRoomDAO;

        public function __construct()
        {
            $this->cinemaRoomDAO = new RoomDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."cinemaRoom-add.php");
        }

        public function ShowListView()
        {
            $cinemaRoomList = $this->cinemaRoomDAO->GetAll();
            require_once(VIEWS_PATH."cinemaRoom-list.php");
        }

        public function Add()
        {   
            if($_POST){
                $idCinema="";
                $roomName="";
                $totalCap=0;
                if(isset($_POST["idCinema"])){
                    $idCinema=$_POST["idCinema"];
                }
                if(isset($_POST["roomName"])){
                    $roomName=$_POST["roomName"];
                }
                if(isset($_POST["totalCap"])){
                    $totalCap=$_POST["totalCap"];
                }
        
                $newRoom=new CinemaRoom(0,$roomName,$totalCap);
                $this->cinemaRoomDAO->Add($newRoom, $idCinema);
        
                echo "<script> alert('Room added');";
            }else{
                echo "<script> alert('Room error');";  
            }
            echo "window.location = '../index.php'; </script>";
        }

        public function Update()
        {   
            if($_POST){
                $updatedRoom=$_POST;
                $Room=$this->cinemaRoomDAO->GetById($updatedRoom["idRoom"]);
                $this->cinemaRoomDAO->Update($Room, $updatedRoom);
                $this->ShowListView();

            }
        }

        public function Select()
        {   
            if($_POST){
                if(isset($_POST["add_button"])){
                    $idCinema=$_POST["add_button"];
                    require_once(VIEWS_PATH."cinemaRoom-add.php");

                }
                if(isset($_POST["function_button"])){
                    $idRoom=$_POST["function_button"];
                    $room=$this->cinemaRoomDAO->GetById($idRoom);
                    require_once(VIEWS_PATH."moviefunction-add.php");

                }

                if(isset($_POST["list_button"])){
                    $idRoom=$_POST["list_button"];
                    $room=$this->cinemaRoomDAO->GetById($idRoom);
                    require_once(VIEWS_PATH."movieFunction-list.php");

                }
                
                if(isset($_POST["edit_button"])){
                    $idRoom=$_POST["edit_button"];
                    $room=$this->cinemaRoomDAO->GetById($idRoom);
                    require_once(VIEWS_PATH."cinemaRoom-mod.php");

                }
                else if(isset($_POST["delete_button"])){
                    $idRoom=$_POST["delete_button"];
                    $idCinema=$this->cinemaRoomDAO->GetCinemaId($idRoom);
                    $room=$this->cinemaRoomDAO->GetById($idRoom);
                    $cinemaDAO=new CinemaDAO();
                    $this->cinemaRoomDAO->Delete($room);
                    $cinema=$cinemaDAO->GetById($idCinema);
                    $cinemaRoomList=$this->cinemaRoomDAO->GetAllByCinemaId($idCinema);
                    require_once(VIEWS_PATH."cinemaRoom-list.php");
                    
                }
        }
        }
    }
?>