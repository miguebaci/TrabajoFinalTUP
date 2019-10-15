<?php
    namespace DAO;

    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;
    use DAO\Connection as Connection;

    class GenreDAO implements IGenreDAO
    {
        private $connection;
        private $tableName = "genre";

        public function Add(Genre $genre)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idGenre, description) VALUES (:idGenre, :descripcion);";
                
                $parameters["idGenre"] = $genre->getIdGenre();
                $parameters["description"] = $description->getDescription();

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
                CURLOPT_URL => "https://api.themoviedb.org/3/genre/movie/list?language=en-US&api_key=f9b934d767d65140edaa81c51e8a4111",
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
                
                $array=$arrayToDecode["results"];

                foreach($array as $thing => $genre){
                
                    $url_id = $genre['idGenre'];
                    $query = "SELECT idGenre FROM " .$this->tableName." WHERE idGenre ='$url_id'";
                    $this->connection = Connection::GetInstance();
                    $resultSet= NULL;
                    $resultSet = $this->connection->Execute($query);                

                    $genres=new Genre($genre['idGenre'],$genre['descrption']);
                    if($resultSet == NULL){
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
                        $genre = new Genre($row["idGenre"],
                        $row["description"],
                        $row["adress"]);
                    }
                return $cinema;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>