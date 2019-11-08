<?php
    namespace Controllers;

    use DAO\IRoomDAO as IRoomDAO;
    use DAO\RoomDAO as RoomDAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use DAO\CinemaDAO as CinemaDAO;

    use DAO\MovieDAO as MovieDAO;
    use DAO\IMovieDAO as IMovieDAO;

    use DAO\IFunctionDAO as IFunctionDAO;
    use DAO\FunctionDAO as FunctionDAO;
    
    use DAO\IGenreDAO as IGenreDAO;
    use DAO\GenreDAO as GenreDAO;

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
            require_once(VIEWS_PATH."validate-session-admin.php");
            require_once(VIEWS_PATH."cinemaRoom-add.php");
        }

        public function ShowListView($idCinema)
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            $cinemaRoomList = $this->cinemaRoomDAO->GetAllByCinemaId($idCinema);
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
        
                $newRoom=new CinemaRoom(0,$roomName,$totalCap);
                $this->cinemaRoomDAO->Add($newRoom, $idCinema);
        
                echo "<script> alert('Room added');";
            }else{
                echo "<script> alert('Room error');";  
            }
            echo "</script>";
            $this->ShowListView($idCinema);

        }

        public function Update()
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            if($_POST){
                $updatedRoom=$_POST;
                $idCinema=$this->cinemaRoomDAO->GetCinemaId($updatedRoom["idRoom"]);
                $room=$this->cinemaRoomDAO->GetById($updatedRoom["idRoom"]);
                $this->cinemaRoomDAO->Update($room, $updatedRoom);
                $this->ShowListView($idCinema);
            }
        }

        public function Select()
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            if($_POST){
                if(isset($_POST["add_button"])){
                    $idCinema=$_POST["add_button"];
                    require_once(VIEWS_PATH."cinemaRoom-add.php");

                }
                if(isset($_POST["function_button"])){
                    
                    $functionDAO = new FunctionDAO();
                    $movieDAO = new MovieDAO();
                    $genreRepo = new GenreDAO();
                    $idRoom=$_POST["function_button"];
                    $functionList=$functionDAO->GetAllByRoomId($idRoom);
                    require_once(VIEWS_PATH."moviefunction-list.php");

                }
                
                if(isset($_POST["edit_button"])){
                    $idRoom=$_POST["edit_button"];
                    $room=$this->cinemaRoomDAO->GetById($idRoom);
                    require_once(VIEWS_PATH."cinemaRoom-mod.php");

                }
                else if(isset($_POST["delete_button"])){
                    $room=$_POST["delete_button"];
                    $cinema=$this->cinemaRoomDAO->GetCinemaId($room);
                    $room=$this->cinemaRoomDAO->GetById($room);
                    $this->cinemaRoomDAO->Delete($room);
                    $this->ShowListView($cinema);
                    
                }
        }
        }
    }
?>