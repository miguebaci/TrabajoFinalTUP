<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use DAO\IMovieDAO as IMovieDAO;

    use DAO\IRoomDAO as IRoomDAO;
    use DAO\RoomDAO as RoomDAO;

    use DAO\IGenreDAO as IGenreDAO;
    use DAO\GenreDAO as GenreDAO;

    use DAO\IFunctionDAO as IFunctionDAO;
    use DAO\FunctionDAO as FunctionDAO;

    use Date as Date;

    use Models\MovieFunction as MovieFunction;

    class FunctionController
    {
        private $functionDAO;

        public function __construct()
        {
            $this->functionDAO = new FunctionDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."movieFunction-add.php");
        }

        public function ShowListView($idRoom)
        {
            $functionList = $this->functionDAO->GetAllByRoomId($idRoom);
            require_once(VIEWS_PATH."movieFunction-list.php");
        }

        public function Add()
        {   
            if($_POST){
                $idMovie="";
                $idRoom="";
                $functionDate= date('d-m-Y');
                $functionTime="";

                if(isset($_POST["idMovie"])){
                    $idMovie=$_POST["idMovie"];
                }
                if(isset($_POST["idRoom"])){
                    $idRoom=$_POST["idRoom"];
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
                
                while($functionDate < $functionEndDate) {
                    $newFunction=new MovieFunction(0,$functionDate,$functionTime);
                    $this->functionDAO->Add($newFunction, $idMovie, $idRoom);
                    $functionDate =date_add($functionDate,date_interval_create_from_date_string("1 days"));//funcion de aumento
                    //var_dump($functionDate);
                }
        
                
        
                echo "<script> alert('Function added');";
            }else{
                echo "<script> alert('Function error');";  
            }
            echo "</script>";
            $this->ShowListView($idRoom);

        }

        public function Update()
        {   
            if($_POST){
                $updatedFunction=$_POST;
                $idRoom=$this->functionDAO->GetCinemaRoomId($updatedFunction["idFunction"]);
                $function=$this->functionDAO->GetById($updatedFunction["idFunction"]);
                $this->functionDAO->Update($function, $updatedFunction);
                $this->ShowListView($idRoom);
            }
        }

        public function Select()
        {   
            if($_POST){
                if(isset($_POST["add_button"])){
                    $movieDAO= new MovieDAO();
                    $genreRepo = new GenreDAO();
                    $movieList= $movieDAO->GetAll();
                    $idRoom=$_POST["add_button"];
                    require_once(VIEWS_PATH."movie-select-list.php");

                }

                if(isset($_POST["select_movie"])){
                    $idMovie=$_POST["select_movie"];
                    $idRoom=$_POST["idRoom"];
                    require_once(VIEWS_PATH."movieFunction-add.php");

                }

                if(isset($_POST["list_button"])){
                    $idRoom=$_POST["list_button"];
                    $movieFunction=$this->functionDAO->GetById($idRoom);
                    require_once(VIEWS_PATH."movieFunction-list.php");

                }
                else if(isset($_POST["delete_button"])){
                    $idFunction=$_POST["delete_button"];
                    $idRoom=$this->functionDAO->GetRoomId($idFunction);
                    $function=$this->functionDAO->GetById($idFunction);
                    $this->functionDAO->Delete($function);
                    $this->ShowListView($idRoom);
                    
                }
        }
        }
    }
?>