<?php
    namespace DAO;

    use DAO\IFunctionDAO as IFunctionDAO;
    use Models\MovieFunction as MovieFunction;
    use Models\Movie as Movie;
    use DAO\Connection as Connection;

    class FunctionDAO implements IFunctionDAO
    {
        private $connection;
        private $tableName = "moviefunction";
        private $movieTable ="movie";
        private $mxgTable= "movieXgenre";

        public function Add(MovieFunction $movieFunction, $idMovie, $idRoom)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idMovie, idRoom, function_date, function_time) VALUES (:idMovie, :idRoom, :function_date, :function_time);";
                
                $date = $movieFunction->getDate();
                $date= $date->format("Y-m-d");
                $parameters["idMovie"] = $idMovie;
                $parameters["idRoom"] = $idRoom;
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
        
        
        public function GetAllByRoomId($idRoom)
        {
            try
            {
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

        public function GetMovieByFunctionId($idFunction)
        {
            try
            {

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

        public function Update(MovieFunction $movieFunction, $updatedRoom)
        {
            try{
                $idFunction=$movieFunction->getIdFunction();
                $newName=$updatedRoom['function_date'];
                $newtime=$updatedRoom['function_time'];
                $query = "UPDATE ". $this->tableName ." SET function_date='$newName', function_time='$newtime' "  . " WHERE idMovieFunction ='$idFunction'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
                }
                catch(Exception $ex){
                    throw $ex;
                }
        }

        public function GetById($idFunction){
            try
            {
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
    
        public function FunctionExist($date, $time){
            try
        {
        $query = "SELECT function_date, function_time FROM ".$this->tableName;
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
        public function GetFunctionByDateAndTime($date, $time)
        {
        try
            {
            $query = "SELECT * FROM ".$this->tableName. " WHERE function_date = '$date' AND function_time = '$time'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
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

        public function GetRoomId($idFunction){
        try
        {
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