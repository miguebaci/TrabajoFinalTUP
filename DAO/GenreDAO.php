<?php
    namespace DAO;

    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;
    use DAO\Connection as Connection;

    class GenreDAO implements IGenreDAO
    {
        private $connection;
        private $tableName = "genre";
        private $mxgTable = "moviexgenre";

        public function Add(Genre $genre)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idGenre, description) VALUES (:idGenre, :description);";
                
                $parameters["idGenre"] = $genre->getIdGenre();
                $parameters["description"] = $genre->getDescription();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $genreList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $genre = new Genre(
                    $row["idGenre"],
                    $row["description"]);

                    array_push($genreList, $genre);
                }

                return $genreList;
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
                CURLOPT_URL => "http://api.themoviedb.org/3/genre/movie/list?language=en-US&api_key=f9b934d767d65140edaa81c51e8a4111",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "{}",
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);
                $arrayToDecode=json_decode($response,true);
                
                $array=$arrayToDecode["genres"];

                foreach($array as $genre){
                
                    $url_id = $genre['id'];
                    $query = "SELECT idGenre FROM " .$this->tableName." WHERE idGenre ='$url_id'";
                    $this->connection = Connection::GetInstance();
                    $resultSet= NULL;
                    $resultSet = $this->connection->Execute($query);                

                    if($resultSet == NULL){
                        $genres=new Genre($genre['id'],$genre['name']);
                        $this->Add($genres);
                    }
                }
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function GetById($idGenre){
            try
            {   
                $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".idGenre ='$idGenre'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $genre=NULL;
                foreach ($resultSet as $row)
                    {   
                        $genre = new Genre($row["idGenre"],$row["description"]);
                    }
                return $genre;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAllGenresByIds($genres){
            try
            {
                $genreList=array();
                foreach($genres as $idGenre){
                    $query = "SELECT * FROM ".$this->tableName. " G
                                WHERE G.idGenre = :idGenre";
                    $parameters["idGenre"]=$idGenre;
                    $this->connection = Connection::GetInstance();
                    $resultSet = $this->connection->Execute($query,$parameters);
                    $genre=NULL;
                    foreach ($resultSet as $row)
                        {   
                            $genre = new Genre($row["idGenre"],$row["description"]);
                        }
                    array_push($genreList,$genre);
                }
                return $genreList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetIdGenreById($idMovie){
            try
            {
                $query= "SELECT MXG.idGenre FROM ".$this->mxgTable." MXG WHERE MXG.idMovie = ".$idMovie.";";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $genreArray = array();
                    foreach($resultSet as $row)
                    {
                        array_push($genreArray, $row['idGenre']);
                    }
                return $genreArray;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
        }

    }
?>