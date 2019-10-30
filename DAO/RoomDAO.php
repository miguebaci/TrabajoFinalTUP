<?php
    namespace DAO;

    use DAO\IRoomDAO as IRoomDAO;
    use Models\CinemaRoom as CinemaRoom;
    use DAO\Connection as Connection;

    class RoomDAO implements IRoomDAO
    {
        private $connection;
        private $tableName = "room";

        public function Add(CinemaRoom $cinemaRoom, $idCinema)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idCinema, roomName, totalCap) VALUES (:idCinema, :roomName, :totalCap);";
                
                $parameters["idCinema"] = $idCinema;
                $parameters["roomName"] = $cinemaRoom->getRoomName();
                $parameters["totalCap"] = $cinemaRoom->getTotalCap();

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
                $roomList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $cinemaRoom = new CinemaRoom($row["idRoom"],
                    $row["roomName"],
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
        
        public function GetAllByCinemaId($idCinema)
        {
            try
            {
                $roomList = array();

                $query = "SELECT * FROM ".$this->tableName. " WHERE ".$this->tableName.".idCinema = ".$idCinema;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $cinemaRoom = new CinemaRoom($row["idRoom"],
                    $row["roomName"],
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
                $newName=$updatedRoom['roomName'];
                $newTotalCap=$updatedRoom['totalCap'];
                $query = "UPDATE ". $this->tableName ." SET roomName='$newName', totalCap='$newTotalCap' "  . " WHERE idRoom ='$idRoom'";
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
                    $row["roomName"],
                    $row["totalCap"]);
                }
            return $cinemaRoom;
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }
    

        public function GetCinemaId($idRoom){
        try
        {
        $query = "SELECT idCinema FROM ".$this->tableName. " WHERE ". $this->tableName .".idRoom ='$idRoom'";
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);
        $idCinema=NULL;
        foreach ($resultSet as $row)
            {               
                $idCinema = $row["idCinema"];
            }
        return $idCinema;
        }
        catch(Exception $ex)
        {
           throw $ex;
        }
    }
}
?>