<?php
    namespace DAO;

    use DAO\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;

    use DAO\GenreDAO as GenreDAO;

    use \Exception as Exception;

    use DAO\Connection as Connection;

    class MovieDAO implements IMovieDAO
    {
        private $connection;
        private $tableName = "movie";
        private $mxgTable = "moviexgenre";
        private $genreDAO;

        public function __construct() {
            $this->genreDAO=new GenreDAO();
        }

        public function Add(Movie $movie)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idMovie, movieName, movielanguage, duration, poster_image) VALUES (:idMovie, :movieName, :movielanguage, :duration, :poster_image);";
                
                $parameters["idMovie"] = $movie->getIdMovie();
                $parameters["movieName"] = $movie->getMovieName();
                $parameters["movielanguage"] = $movie->getLanguage();
                $parameters["duration"] = $movie->getDuration();
                $parameters["poster_image"] = $movie->getImage();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                $this->MXG($movie);

                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function MXG(Movie $movie){
            foreach($movie->getGenre() as $genre){
                $query = "INSERT INTO ".$this->mxgTable." (idMovie, idGenre) VALUES (:idMovie, :idGenre);";

                $parameters["idMovie"]=$movie->getIdMovie();
                $parameters["idGenre"]=$genre->getIdGenre();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
        }

        public function GetAll()
        {
            try
            {
                $movieList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {   


                    $movie = new Movie(
                    $row["idMovie"],
                    $row["movieName"],
                    $row["movielanguage"],
                    $row["duration"],
                    $row["poster_image"],
                    $this->genreDAO->GetAllGenresByIds($this->genreDAO->GetIdGenreById($row["idMovie"])));

                    array_push($movieList, $movie);
                }

                return $movieList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById($idMovie)
        {
            try
            {                
                $query = "SELECT * FROM ".$this->tableName." WHERE idMovie ='$idMovie'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                $movie=NULL;

                foreach ($resultSet as $row)
                {   
                    $movie = new Movie(
                    $row["idMovie"],
                    $row["movieName"],
                    $row["movielanguage"],
                    $row["duration"],
                    $row["poster_image"],
                    $this->genreDAO->GetAllGenresByIds($this->genreDAO->GetIdGenreById($row["idMovie"])));
                }

                return $movie;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function UpdateAll(){
            try{
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.themoviedb.org/3/movie/now_playing?page=1&language=en-US&api_key=f9b934d767d65140edaa81c51e8a4111",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10000,
                    CURLOPT_TIMEOUT => 10000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => "",
                ));

                $response = curl_exec($curl);
                
                $err = curl_error($curl);

                curl_close($curl);
                $arrayToDecode=json_decode($response,true);
                
                $array=$arrayToDecode["results"];

                foreach($array as $thing => $movie){
                
                    $query = "SELECT idMovie FROM " .$this->tableName." WHERE idMovie = :idMovie";
                    $parameters["idMovie"]=$movie['id'];
                    $this->connection = Connection::GetInstance();
                    $resultSet= NULL;
                    $resultSet = $this->connection->Execute($query,$parameters);                
                    
                    $genres=$this->genreDAO->GetAllGenresByIds($movie['genre_ids']);

                    $movies=new Movie($movie['id'],$movie['title'],$movie['original_language'],$this->RetrieveRuntime($movie['id']),$movie['poster_path'], $this->genreDAO->GetAllGenresByIds($movie['genre_ids']));
                    if($resultSet == NULL){
                        $this->Add($movies);
                    }
                
                }
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }
        
        private function RetrieveRuntime($id){
            try{
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.themoviedb.org/3/movie/".$id."?language=en-US&api_key=f9b934d767d65140edaa81c51e8a4111",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10000,
                CURLOPT_TIMEOUT => 10000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            $arrayToDecode=json_decode($response,true);
        
            return $arrayToDecode['runtime'];
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }
    }
?>