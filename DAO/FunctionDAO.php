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

        public function Add(MovieFunction $movieFunction, $idMovie, $idRoom)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idMovie, idRoom, function_date, function_time) VALUES (:idMovie, :idRoom, :function_date, :function_time);";
                
                $parameters["idMovie"] = $idMovie;
                $parameters["idRoom"] = $idRoom;
                $parameters["function_date"] = $movieFunction->getDate();
                //$parameters["function_date"] = date("Y-m-d");
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