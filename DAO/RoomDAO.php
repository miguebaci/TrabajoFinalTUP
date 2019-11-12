<?php
    namespace DAO;

    use DAO\IRoomDAO as IRoomDAO;
    use Models\CinemaRoom as CinemaRoom;
    use DAO\Connection as Connection;
    use Models\Cinema as Cinema;

    class RoomDAO implements IRoomDAO
    {
        private $connection;
        private $tableName = "room";
        private $cinemaTable = "cinema";

        public function Add(CinemaRoom $cinemaRoom)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idCinema, roomName, totalCap) VALUES (:idCinema, :roomName, :totalCap);";
                $cinema=$cinemaRoom->getCinema();
                $parameters["idCinema"] = $cinema->getIdCinema();
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
                    $id=$this->GetCinemaId($cinemaRoom);
                    $cinemaRoom->setCinema($this->GetCinemaById($id));
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
                    $cinemaRoom->setCinema($this->GetCinemaById($idCinema));
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
            $cinema=$cinemaRoom->getCinema();
            $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".idRoom ='$idRoom'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
                return $cinema;
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
                
                    $id=$this->GetCinemaId($cinemaRoom);
                    $cinemaRoom->setCinema($this->GetCinemaById($id));
            return $cinemaRoom;
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }
    

        public function GetCinemaId(CinemaRoom $cinemaRoom){
        try
        {
        $idRoom=$cinemaRoom->getIdCinemaRoom();
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

        public function GetCinemaById($idCinema){
            try
            {
            $query = "SELECT * FROM ".$this->cinemaTable." WHERE ". $this->cinemaTable .".idCinema ='$idCinema'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $cinema=NULL;
            foreach ($resultSet as $row)
                {   $cinema = new Cinema($row["idCinema"],
                    $row["cinemaName"],
                    $row["adress"],
                    $row["ticketPrice"]);
                }

            return $cinema;
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function CinemaExist($idCinema){
            try
            {
            $query = "SELECT idCinema FROM ".$this->cinemaTable." WHERE ". $this->cinemaTable .".idCinema ='$idCinema'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $exist=false;
            if($resultSet["idCinema"]=$idCinema){
                $exist=true;
            }
            return $exist;
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }
}
?>