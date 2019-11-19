<?php
    namespace Helper;
    //implementar en Controller y daos

    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;

    use DAO\RoomDAO as RoomDAO;
    use Models\CinemaRoom as CinemaRoom;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;
    
    use DAO\GenreDAO as GenreDAO;
    use Models\Genre as Genre;

    use DAO\FunctionDAO as FunctionDAO;
    use Models\MovieFunction as MovieFunction;

    use DAO\PurchaseDAO as PurchaseDAO;
    use Models\Purchase as Purchase;

    use Date as Date;

    class UserHelper{

        private $cinemaDAO;
        private $movieDAO;
        private $functionDAO;
        private $purchaseDAO;

        public function __construct()
        {   
            $this->cinemaDAO = new CinemaDAO();
            $this->movieDAO = new MovieDAO();
            $this->functionDAO = new FunctionDAO();
            $this->purchaseDAO = new PurchaseDAO();
        }

        function helpGetCinemas(){
            return $this->cinemaDAO->GetAll();
        }

        function helpGetCinemaById($idCinema){
            return $this->cinemaDAO->GetById($idCinema);
        }

        function helpPurchasesByCinema($cinema, $dateStart, $dateEnd){
            return $this->purchaseDAO->getPurchasesByCinema($cinema, $dateStart, $dateEnd);
        }

        function helpPurchasesByMovie($movie, $dateStart, $dateEnd){
            return $this->purchaseDAO->getPurchasesByMovie($movie, $dateStart, $dateEnd);
        }

        function helpAllMoviesInFunctions(){
            return $this->functionDAO->GetAllMoviesInFunctions();
        }

        function helpBringUserPurchases($user){
            return $this->purchaseDAO->bringUserPurchases($user);
        }
     
        function helpMovieById($idMovie){
            return $movie=$this->movieDAO->GetById($idMovie);
        }

        function getCinemaDAO(){
            return $this->cinemaDAO;
        }

        function getMovieDAO(){
            return $this->movieDAO;
        }

        function getPurchaseDAO(){
            return $this->purchaseDAO;
        }

        function getFunctionDAO(){
            return $this->functionDAO;
        }

    }

?>