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
        private $roomDAO;
        private $movieDAO;
        private $genreDAO;
        private $functionDAO;
        private $purchaseDAO;

        public function __construct()
        {   
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
            $this->functionDAO = new FunctionDAO();
            $this->purchaseDAO = new PurchaseDAO();
        }

        function helpMovieList(){
            return $this->movieDAO->GetAll();
        }

        function helpGetCinemas(){
            return $this->cinemaDAO->GetAll();
        }

        function helpGetCinemaById($idCinema){
            return $this->cinemaDAO->GetById($idCinema);
        }

        function helpGetCinemasByMovie(Movie $movie){
            return $this->cinemaDAO->GetByMovie($movie);
        }

        function helpGetRoomsByCinema(Cinema $cinema){
            
            return $this->roomDAO->GetAllByCinemaId($cinema->getIdCinema());
        
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
     
        function helpMovieById($idMovie){
            return $movie=$this->movieDAO->GetById($idMovie);
        }

        function helpGetRoom($idRoom){
            return $this->roomDAO->GetById($idRoom);
        }

        function helpGetGenre($idGenre){
            return $this->genreDAO->GetById($idGenre);
        }

        function getCinemaDAO(){
            return $this->cinemaDAO;
        }
        
        function getRoomDAO(){
            return  $this->roomDAO;
        }

        function getMovieDAO(){
            return $this->movieDAO;
        }

        function getGenreDAO(){
            return $this->genreDAO;
        }

        function getPurchaseDAO(){
            return $this->purchaseDAO;
        }

        function getUserDAO(){
            return $this->userDAO;
        }
    }

?>