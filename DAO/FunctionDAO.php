<?php
    namespace DAO;

    use DAO\IFunctionDAO as IFunctionDAO;
    use Models\MovieFunction as MovieFunction;
    use Models\Movie as Movie;
    use Models\CinemaRoom as CinemaRoom;
    use DAO\Connection as Connection;

    class FunctionDAO implements IFunctionDAO
    {
        private $connection;
        private $tableName = "moviefunction";
        private $movieTable ="movie";
        private $mxgTable= "movieXgenre";

        public function Add(MovieFunction $movieFunction, CinemaRoom $room)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idMovie, idRoom, function_date, function_time) VALUES (:idMovie, :idRoom, :function_date, :function_time);";
                
                $movie = $movieFunction->getMovie();
                $date = $movieFunction->getDate();
                $date= $date->format("Y-m-d");
                $parameters["idMovie"] = $movie->getMovieId();
                $parameters["idRoom"] = $room->getIdCinemaRoom();
                $parameters["function_date"] = $date;
                $parameters["function_time"] = $movieFunction->getTime();

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
                $functionList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $movieFunction = new MovieFunction($row["idMovieFunction"],
                    $row["function_date"],
                    $row["function_time"]);

                    array_push($functionList, $movieFunction);
                }

                return $functionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        
        public function GetAllByRoomId(CinemaRoom $room)
        {
            try
            {
                $idRoom = $room->getIdCinemaRoom();
                $functionList = array();

                $query = "SELECT * FROM ".$this->tableName. " WHERE ".$this->tableName.".idRoom = ".$idRoom;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $movieFunction = new MovieFunction($row["idMovieFunction"],
                    $row["function_date"],
                    $row["function_time"]);

                    array_push($functionList, $movieFunction);
                }
                return $functionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAllByGenre($idGenre)
        {
            try
            {
                $functionList = array();

                $query = "SELECT * FROM ".$this->tableName." F INNER JOIN ".$this->mxgTable." MXG ON F.idMovie = MXG.idMovie  WHERE MXG.idGenre = ".$idGenre;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $movieFunction = new MovieFunction($row["idMovieFunction"],
                    $row["function_date"],
                    $row["function_time"]);

                    array_push($functionList, $movieFunction);
                }

                return $functionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetMovieByFunctionId(MovieFunction $movieFunction)
        {
            try
            {
                $idFunction=$function->getIdFunction();
                $query = "SELECT M.idMovie, M.movieName, M.movielanguage, M.duration, M.poster_image FROM ".$this->movieTable." M INNER JOIN ".$this->tableName." F ON M.idMovie = F.IdMovie   WHERE F.idMovieFunction = '$idFunction'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $movie = new Movie(
                        $row["idMovie"],
                        $row["movieName"],
                        $row["movielanguage"],
                        $row["duration"],
                        $row["poster_image"]);
                }
                return $movie;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        
        public function Delete(MovieFunction $movieFunction)
        {   
            try
            {
            $idFunction=$movieFunction->getIdFunction();
            $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".idMovieFunction ='$idFunction'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function GetById(MovieFunction $function){
            try
            {
            $idFunction=$function->getIdFunction();
            $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".idMovieFunction ='$idFunction'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $movieFunction=NULL;
            foreach ($resultSet as $row)
                {               
                    $movieFunction = new MovieFunction($row["idMovieFunction"],
                    $row["function_date"],
                    $row["function_time"]);
                }
            return $movieFunction;
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }
    
        public function FunctionExist(CinemaRoom $room, $date, $time){
            try
        {
            $idRoom= $room->getIdCinemaRoom();
        $query = "SELECT function_date, function_time FROM ".$this->tableName." WHERE idRoom ='$idRoom'";
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);
        $exists=false;
        foreach ($resultSet as $row)
            {        
                    $functionTime = date_create($row["function_time"]);
                    $functionDate = date_create($row["function_date"]);
                if($functionDate == $date && $functionTime->format('H:i') == $time){
                    return $exists = true;
                }
            }
        return $exists;
        }
        catch(Exception $ex)
        {
           throw $ex;
        }
        }
        public function GetRoomId(MovieFunction $movieFunction){
        try
        {
            $idFunction= $movieFunction->getIdFunction();
        $query = "SELECT idRoom FROM ".$this->tableName. " WHERE ". $this->tableName .".idMovieFunction ='$idFunction'";
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);
        $idRoom=NULL;
            foreach ($resultSet as $row)
                {               
                    $idRoom = $row["idRoom"];
                }
        return $idRoom;
        }
        catch(Exception $ex)
        {
           throw $ex;
        }
    }

}
?>