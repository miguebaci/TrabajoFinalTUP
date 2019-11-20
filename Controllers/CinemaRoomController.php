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

        public function Add($idCinema, $roomName, $totalCap)
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
                $cinema=$this->cinemaRoomDAO->GetCinemaById($idCinema);
                $newRoom=new CinemaRoom(0,$roomName,$totalCap);
                $newRoom->setCinema($cinema);
                $this->cinemaRoomDAO->Add($newRoom);
            $this->ShowListView($cinema);

        }

        public function Update($idCinema, $roomName, $totalCap)
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            if($_POST){
                $updatedRoom= array("roomName"=>$roomName, "totalCap"=>$totalCap);
                $room=$this->cinemaRoomDAO->GetById($_SESSION["idRoom"]);
                $this->cinemaRoomDAO->Update($room, $updatedRoom);
                $cinema=$room->getCinema();
                $this->ShowListView($cinema);
            }
        }

        public function Select($button)
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            if($_POST){
                if($button == "add"){
                    $idCinema=$_SESSION["idCinema"];
                    $cinema=$this->cinemaRoomDAO->GetCinemaById($idCinema);
                    require_once(VIEWS_PATH."cinemaRoom-add.php");

                }
                if($button == "function"){
                    
                    $room=$this->cinemaRoomDAO->GetById($_SESSION['idRoom']);
                    $idRoom=$room->getIdCinemaRoom();
                    $room->setFunctionList($this->helper->helpGetAllByRoom($room));
                    $functionList=$room->getFunctionList();
                    require_once(VIEWS_PATH."moviefunction-list.php");

                }
                
                if($button == "edit"){
                    $room=$this->cinemaRoomDAO->GetById($_SESSION['idRoom']);
                    require_once(VIEWS_PATH."cinemaRoom-mod.php");

                }
                else if($button == "delete"){
                    $idRoom=$_SESSION['idRoom'];
                    $room=$this->cinemaRoomDAO->GetById($idRoom);
                    $cinema=$this->cinemaRoomDAO->Delete($room);
                    $this->ShowListView($cinema);
                    
                }
        }
        }
    }
?>