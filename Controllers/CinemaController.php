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

        public function ShowUpdateView($idCinema)
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            $cinema=$this->cinemaDAO->GetById($idCinema);
            require_once(VIEWS_PATH."cinema-mod.php");
            
        }

        public function Add($cinemaName,$address,$ticketPrice)
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            
                $array=array();
                $newCinema=new Cinema(0,$cinemaName,$address,$ticketPrice,$array);
                $this->cinemaDAO->Add($newCinema);
            $this->ShowListView();
        }

        public function Update($idCinema, $cinemaName, $address, $ticketPrice)
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            
                $cinema=$this->cinemaDAO->GetById($idCinema);
                $mod= array("cinemaName"=>$cinemaName, "address"=>$address, "ticketPrice"=>$ticketPrice);
                $this->cinemaDAO->Update($cinema, $mod);
                $this->ShowListView();
        }

        public function Delete($idCinema)
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            $cinema=$this->cinemaDAO->GetById($idCinema);
            $this->cinemaDAO->Delete($cinema);
            $this->ShowListView();
            
        }
    }
?>