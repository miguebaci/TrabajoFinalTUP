<?php
    namespace Controllers;

    use DAO\RoomDAO as RoomDAO;
    use Helper\RoomHelper as RoomHelper;
    use Models\Cinema as Cinema;
    use Models\CinemaRoom as CinemaRoom;

    class CinemaRoomController
    {
        private $cinemaRoomDAO;
        private $helper;

        public function __construct()
        {
            $this->cinemaRoomDAO = new RoomDAO();
            $this->helper = new RoomHelper();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            require_once(VIEWS_PATH."cinemaRoom-add.php");
        }

        public function ShowListView(Cinema $cinema)
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            $cinemaRoomList=$this->cinemaRoomDAO->GetAllByCinemaId($cinema->getIdCinema());
            require_once(VIEWS_PATH."cinemaRoom-list.php");
        }

        public function Add()
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
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
                $cinema=$this->cinemaRoomDAO->GetCinemaById($idCinema);
                $newRoom=new CinemaRoom(0,$roomName,$totalCap);
                $newRoom->setCinema($cinema);
                $this->cinemaRoomDAO->Add($newRoom);
        
                echo "<script> alert('Room added');";
            }else{
                echo "<script> alert('Room error');";  
            }
            echo "</script>";
            $this->ShowListView($cinema);

        }

        public function Update()
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            if($_POST){
                $updatedRoom=$_POST;
                $room=$this->cinemaRoomDAO->GetById($updatedRoom["idRoom"]);
                $this->cinemaRoomDAO->Update($room, $updatedRoom);
                $cinema=$room->getCinema();
                $this->ShowListView($cinema);
            }
        }

        public function Select()
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            if($_POST){
                if(isset($_POST["add_button"])){
                    $idCinema=$_POST["add_button"];
                    $cinema=$this->cinemaRoomDAO->GetCinemaById($idCinema);
                    require_once(VIEWS_PATH."cinemaRoom-add.php");

                }
                if(isset($_POST["function_button"])){
                    
                    $room=$this->cinemaRoomDAO->GetById($_POST["function_button"]);
                    $idRoom=$room->getIdCinemaRoom();
                    $room->setFunctionList($this->helper->helpGetAllByRoom($room));
                    $functionList=$room->getFunctionList();
                    require_once(VIEWS_PATH."moviefunction-list.php");

                }
                
                if(isset($_POST["edit_button"])){
                    $room=$this->cinemaRoomDAO->GetById($_POST["edit_button"]);
                    require_once(VIEWS_PATH."cinemaRoom-mod.php");

                }
                else if(isset($_POST["delete_button"])){
                    $idRoom=$_POST["delete_button"];
                    $room=$this->cinemaRoomDAO->GetById($idRoom);
                    $cinema=$this->cinemaRoomDAO->Delete($room);
                    $this->ShowListView($cinema);
                    
                }
        }
        }
    }
?>