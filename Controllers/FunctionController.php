<?php
    namespace Controllers;
    
    use Models\CinemaRoom as CinemaRoom;
    use Models\Movie as Movie;
    use DAO\FunctionDAO as FunctionDAO;
    use Helper\FunctionHelper as FunctionHelper;
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

        public function ShowListView(CinemaRoom $room)
        {
            require_once(VIEWS_PATH."validate-session-admin.php");
            $idRoom=$room->getIdCinemaRoom();
            $room->setFunctionList($this->functionDAO->GetAllByRoomIdAdmin($room));
            $functionList=$room->getFunctionList();
            require_once(VIEWS_PATH."moviefunction-list.php");
        }

        public function Add($functionTime, $function_date_start, $function_date_end)
        {   
            require_once(VIEWS_PATH."validate-session-admin.php");

                $movie= $this->helper->helpMovieById($_SESSION["idMovie"]); 
                $room = $this->helper->helpGetRoom($_SESSION["idRoom"]);

                $functionDate = date_create($function_date_start);
                $functionEndDate = date_create($function_date_end);               
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
                    return $this->ShowAddViewError($room);
                }
            $this->ShowListView($room);

        }
        public function MovieAdd($select_movie)
        {   var_dump($select_movie);
            $idMovie=$select_movie;
            $idRoom=$_SESSION["idRoom"];
            require_once(VIEWS_PATH."movieFunction-add.php");
        }

        public function GetAllCinemasByMovie(Movie $movie)
        {
            $cinemaFunction=array();
            $cinemaArray = $this->helper->helpGetCinemasByMovie($movie);
            foreach ($cinemaArray as $cinema) {
                $resultset["cinema"] = $cinema;
                $resultset["functions"] = $this->functionDAO->GetByCinemaIdAndMovieId($cinema->getIdCinema(),$movie->getIdMovie());
                array_push($cinemaFunction,$resultset);
            }
            return $cinemaFunction;
        }

        public function GetAllCinemasByGenre($idGenre)
        {
            $cinemaFunction=array();
            $cinemaArray = $this->helper->helpGetCinemasByGenre($idGenre);
            foreach ($cinemaArray as $cinema) {
                $resultset["cinema"] = $cinema;
                $resultset["functions"] = $this->functionDAO->GetByCinemaIdAndGenreId($cinema->getIdCinema(),$idGenre);
                array_push($cinemaFunction,$resultset);
            }
            return $cinemaFunction;
        }

        public function GetFunctionsByGenre($genre_select)
        {
            $list=$this->GetAllCinemasByGenre($genre_select);
            require_once(VIEWS_PATH."movieFunction-select.php");
        }

        public function Select($button)
        {   
                if($button =="add_button"){
                    require_once(VIEWS_PATH."validate-session-admin.php");
                    $movieList= $this->helper->helpMovieList();
                    $idRoom=$_SESSION["idRoom"];
                    require_once(VIEWS_PATH."movie-select-list.php");

                }

                if($button == "list_button"){
                    require_once(VIEWS_PATH."validate-session-admin.php");
                    $idRoom=$_SESSION["idRoom"];
                    $this->ShowListView($idRoom);

                }

                if($button =="idMovie_Selected")
                {
                    $movie = $this->helper->helpMovieById($_SESSION["idMovie"]);
                    $list =  $this->GetAllCinemasByMovie($movie);
                    require_once(VIEWS_PATH."movieFunction-select.php");
                }

                if($button == "delete_old")
                {
                    $this->functionDAO->DeleteOldFunctions();
                    require_once(VIEWS_PATH."success-view.php");
                }

                else if($button == "delete"){
                    require_once(VIEWS_PATH."validate-session-admin.php");
                    $idFunction=$_SESSION["idFunction"];
                    var_dump($idFunction);
                    var_dump($_SESSION["idFunction"]);
                    $function=$this->functionDAO->GetById($idFunction);
                    $idRoom=$this->functionDAO->GetRoomId($function);
                    $room=$this->helper->helpGetRoom ($idRoom);
                    $this->functionDAO->Delete($function);
                    $this->ShowListView($room);
                    
                }
            }
    }
?>