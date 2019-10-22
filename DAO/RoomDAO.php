<?php
    namespace DAO;

    use DAO\IRoomDAO as IRoomDAO;
    use Models\Cinema as Cinema;
    use DAO\Connection as Connection;

    class CinemaDAO implements ICinemaRoomDAO
    {
        private $connection;
        private $tableName = "room";

        public function Add(CinemaRoom $cinemaRoom, $idCinema)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (totalCap, idCinema) VALUES (:totalCap, :idCinema);";
                
                $parameters["totalCap"] = $cinemaRoom->getTotalCap();
                $parameters["idCinema"] = $idCinema;

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
                $cinemaList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $cinemaRoom = new CinemaRoom($row["idRoom"],
                    $row["totalCap"]);

                    array_push($roomList, $cinemaRoom);
                }

                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function Delete(CinemaRoom $cinemaRoom)
        {   
            try
            {
            $idRoom=$cinemaRoom->getIdCinemaRoom();
            $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".idRoom ='$idRoom'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function Update(CinemaRoom $cinemaRoom, $updatedRoom)
        {
            try{
                $idRoom=$cinemaRoom->getIdCinemaRoom();
                $newTotalCap=$updatedRoom['totalCap'];
                $query = "UPDATE ". $this->tableName ." SET totalCap='$newTotalCap' "  . " WHERE idRoom ='$idRoom'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
                }
                catch(Exception $ex){
                    throw $ex;
                }
        }

        public function GetById($idRoom){
            try
            {
            $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".idRoom ='$idRoom'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $cinemaRoom=NULL;
            foreach ($resultSet as $row)
                {               
                    $cinemaRoom = new CinemaRoom($row["idRoom"],
                    $row["totalCap"]);
                }
            return $cinemaRoom;
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }
    }
?>