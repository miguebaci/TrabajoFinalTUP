<?php
    namespace Controllers;
    
    use Models\CinemaRoom as CinemaRoom;
    use DAO\IFunctionDAO as IFunctionDAO;
    use DAO\FunctionDAO as FunctionDAO;
    use Helpers\FunctionHelper as FunctionHelper;
    use Models\Genre as Genre;


    use Models\MovieFunction as MovieFunction;

    class FunctionController
    {
        private $functionDAO;
        private $helper;

        public function __construct()
        {
            $this->functionDAO = new FunctionDAO();
            $this->helper = new FunctionHelper();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            require_once(VIEWS_PATH."movieFunction-add.php");
        }
        public function ShowAddViewError(CinemaRoom $room)
        {   $idRoom=$room->getIdCinemaRoom();
            $movie=$room->getMovie();
            $idMovie=$movie->getIdMovie();
            require_once(VIEWS_PATH."validate-session-admin.php");
            require_once(VIEWS_PATH."movieFunction-add.php");
        }

        public function ShowGenreListView(Genre $genre)
        {
            require_once(VIEWS_PATH."validate-session.php");
            $idGenre=$genre->getIdGenre();
            $functionDAO = $this->functionDAO;
            $functionList = $functionDAO->GetAllByGenre($idGenre);
            $movieDAO= $this->helper->getMovieDAO();
            require_once(VIEWS_PATH."movieFunction-genreList.php");
        }

        public function ShowListView(CinemaRoom $room)
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            $idRoom=$room->getIdCinemaRoom();
            $functionList = $this->functionDAO->GetAllByRoomId($room);
            $movieDAO= $this->helper->getMovieDAO();
            require_once(VIEWS_PATH."movieFunction-list.php");
        }

        public function Add()
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");
            if($_POST){
                $idMovie="";
                $idRoom="";
                $functionDate= date('d-m-Y');
                $functionTime="";

                if(isset($_POST["idMovie"])){
                    $idMovie=$_POST["idMovie"];
                    $movieDAO= $this->helper->getMovieDAO();
                    $movie = $movieDAO->GetById($idMovie);
                }
                if(isset($_POST["idRoom"])){
                    $idRoom = $_POST["idRoom"];
                    $roomDAO = $this->helper->getRoomDAO();
                    $room = $roomDAO->GetById($idRoom);
                }
                if(isset($_POST["function_date_start"]) && isset($_POST["function_date_end"])){
                    $functionStartDate = $_POST["function_date_start"];
                    $functionEndDate = $_POST["function_date_end"];
                }
                if(isset($_POST["function_time"])){
                    $functionTime=$_POST["function_time"];
                }
                
                $functionDate = date_create($functionStartDate);
                $functionEndDate = date_create($functionEndDate);               
                if($functionDate<=$functionEndDate)
                {
                    while($functionDate <= $functionEndDate)
                    {   $exists=$this->functionDAO->FunctionExist($room,$functionDate, $functionTime);
                        if(!$exists)
                        {
                            $newFunction=new MovieFunction(0,$functionDate,$functionTime,$movie);
                            $newFunction->setMovie($movie);
                            $newFunction->setRoom($room);
                            $this->functionDAO->Add($newFunction);
                        }
                        else{
                            echo "<script> alert('Function already exists on date: ".$functionDate->format('Y-m-d')." at: ".$functionTime."');";
                            echo "</script>";
                        }
                        $functionDate = date_add($functionDate, date_interval_create_from_date_string("1 days"));//funcion de aumento
                    }
                }
                else
                {
                    echo "<script> alert('Function date incorrect, try a valid date');";
                    echo "</script>";
                    return $this->ShowAddViewError($idRoom, $idMovie);
                }
            }else{
                echo "<script> alert('Function error');";  
            }
            echo "</script>";
            $this->ShowListView($room);

        }

        public function getall(){
            $list=array();
            $list = $this->functionDAO->GetAllCinemasData();
            var_dump($list);
        }

        public function Select()
        {   
            if($_POST){
                $roomDAO= $this->helper->getRoomDAO();
                if(isset($_POST["add_button"])){
                    require_once(VIEWS_PATH."validate-session-admin.php");
                    $movieList= $this->helper->helpMovieList();
                    $idRoom=$_POST["add_button"];
                    require_once(VIEWS_PATH."movie-select-list.php");

                }

                if(isset($_POST["select_movie"])){
                    $idMovie=$_POST["select_movie"];
                    $idRoom=$_POST["idRoom"];
                    require_once(VIEWS_PATH."movieFunction-add.php");

                }

                if(isset($_POST["genre_select"])){
                    $idGenre=$_POST["genre_select"];
                    $genre=$this->helper->helpGetGenre($idGenre);
                    $this->ShowGenreListView($genre);

                }

                if(isset($_POST["list_button"])){
                    require_once(VIEWS_PATH."validate-session-admin.php");
                    $idRoom=$_POST["list_button"];
                    $this->ShowListView($idRoom);

                }

                if(isset($_POST["idMovie_Selected"]))
                {
                    $functionList=$this->functionDAO->GetByMovieId($_POST["idMovie_Selected"]);
                    require_once(VIEWS_PATH."movieFunction-select.php");
                }

                if(isset($_POST["delete_old"]))
                {
                    $this->functionDAO->DeleteOldFunctions();
                    require_once(VIEWS_PATH."success-view.php");
                }

                else if(isset($_POST["delete_button"])){
                    require_once(VIEWS_PATH."validate-session-admin.php");
                    $idFunction=$_POST["delete_button"];
                    $function=$this->functionDAO->GetById($idFunction);
                    $idRoom=$this->functionDAO->GetRoomId($function);
                    $room=$this->helper->helpGetRoom ($idRoom);
                    $this->functionDAO->Delete($function);
                    $this->ShowListView($room);
                    require_once(VIEWS_PATH."validate-post.php");
                    
                }
            }
        }
    }
?>