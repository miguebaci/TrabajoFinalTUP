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

    use Date as Date;

    class FunctionHelper{

        private $cinemaDAO;
        private $roomDAO;
        private $movieDAO;
        private $genreDAO;

        public function __construct()
        {   
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
        }

        function helpMovieList(){
            return $this->movieDAO->GetAll();
        }

        function helpGetCinemas(){
            return $this->cinemaDAO->GetAll();
        }

        function helpGetCinemasByMovie(Movie $movie){
            return $this->cinemaDAO->GetByMovie($movie);
        }

        function helpGetCinemasByGenre($idGenre){
            return $this->cinemaDAO->GetByGenre($idGenre);
        }

        function helpGetRoomsByCinema(Cinema $cinema){
            
            return $this->roomDAO->GetAllByCinemaId($cinema->getIdCinema());
        
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