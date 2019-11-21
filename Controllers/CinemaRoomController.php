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

        public function ShowAddView($idCinema)
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            require_once(VIEWS_PATH."cinemaRoom-add.php");
        }

        public function ShowListView($idCinema)
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            $cinemaRoomList=$this->cinemaRoomDAO->GetAllByCinemaId($idCinema);
            require_once(VIEWS_PATH."cinemaRoom-list.php");
        }

        public function ShowUpdateView($idRoom)
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            $room=$this->cinemaRoomDAO->GetById($idRoom);
            require_once(VIEWS_PATH."cinemaRoom-mod.php");
            
        }

        public function Add($idCinema, $roomName, $totalCap)
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
                $cinema=$this->cinemaRoomDAO->GetCinemaById($idCinema);
                $newRoom=new CinemaRoom(0,$roomName,$totalCap);
                $newRoom->setCinema($cinema);
                $this->cinemaRoomDAO->Add($newRoom);
            $this->ShowListView($idCinema);

        }

        public function Update($idRoom, $roomName, $totalCap)
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
                $updatedRoom= array("roomName"=>$roomName, "totalCap"=>$totalCap);
                $room=$this->cinemaRoomDAO->GetById($idRoom);
                $this->cinemaRoomDAO->Update($room, $updatedRoom);
                $cinema=$room->getCinema();
                $this->ShowListView($cinema->getIdCinema());
        }

        public function Delete($idRoom)
        {   
            $room=$this->cinemaRoomDAO->GetById($idRoom);
            $cinema=$this->cinemaRoomDAO->Delete($room);
            $this->ShowListView($cinema->getIdCinema());
        }
    }
?>