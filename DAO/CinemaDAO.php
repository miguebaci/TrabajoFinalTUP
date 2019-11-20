<?php
    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;
    use Models\CinemaRoom as CinemaRoom;
    use Models\Movie as Movie;
    use DAO\Connection as Connection;

    class CinemaDAO implements ICinemaDAO
    {
        private $connection;
        private $tableName = "cinema";

        public function Add(Cinema $cinema)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (cinemaName, adress, ticketPrice) VALUES (:cinemaName, :adress, :ticketPrice);";
                
                $parameters["cinemaName"] = $cinema->getCinemaName();
                $parameters["adress"] = $cinema->getAdress();
                $parameters["ticketPrice"] = $cinema->getTicketPrice();

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
                {   $roomList=$this->GetRoomList($row["idCinema"]);
                    $cinema = new Cinema($row["idCinema"],
                    $row["cinemaName"],
                    $row["adress"],
                    $row["ticketPrice"]);
                    $cinema->setCinemaRoomList($roomList);
                    array_push($cinemaList, $cinema);
                }

                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function Delete(Cinema $cinema)
        {   
            try
            {
            $idCinema=$cinema->getIdCinema();
            $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".idCinema ='$idCinema'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function Update(Cinema $cinema, $updatedCinema)
        {
            try{
                $idCinema=$cinema->getIdCinema();
                $newName=$updatedCinema['cinemaName'];
                $newAdress=$updatedCinema['adress'];
                $newTicketPrice=$updatedCinema['ticketPrice'];
                $query = "UPDATE ". $this->tableName ." SET cinemaName='$newName', adress='$newAdress', ticketPrice='$newTicketPrice'"  . " WHERE idCinema ='$idCinema'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
                }
                catch(Exception $ex){
                    throw $ex;
                }
        }

        public function GetById($idCinema){
            try
            {
            $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".idCinema ='$idCinema'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $cinema=NULL;
            foreach ($resultSet as $row)
                {   $roomList=$this->GetRoomList($row["idCinema"]);
                    $cinema = new Cinema($row["idCinema"],
                    $row["cinemaName"],
                    $row["adress"],
                    $row["ticketPrice"]);
                    $cinema->setCinemaRoomList($roomList);
                }
            return $cinema;
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function GetByMovie(Movie $movie){
            try
            {
            $idMovie=$movie->getIdMovie();
            $query = "SELECT * FROM ".$this->tableName. " C 
            INNER JOIN room R ON C.idCinema = R.idCinema
            INNER JOIN moviefunction MF ON R.idRoom = MF.idRoom
            INNER JOIN movie M ON M.idMovie = MF.idMovie
            WHERE M.idMovie ='$idMovie' GROUP BY C.idCinema";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $cinemaList=array();
            foreach ($resultSet as $row)
                {   
                    $cinema = new Cinema($row["idCinema"],
                    $row["cinemaName"],
                    $row["adress"],
                    $row["ticketPrice"]);
                    array_push($cinemaList, $cinema);
                }
            return $cinemaList;
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function GetByGenre($idGenre){
            try
            {
            $query = "SELECT * FROM ".$this->tableName. " C 
            INNER JOIN room R ON C.idCinema = R.idCinema
            INNER JOIN moviefunction MF ON R.idRoom = MF.idRoom
            INNER JOIN movie M ON M.idMovie = MF.idMovie
            INNER JOIN moviexgenre MXG ON M.idMovie = MXG.idMovie
            WHERE MXG.idGenre ='$idGenre' GROUP BY C.idCinema";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $cinemaList=array();
            foreach ($resultSet as $row)
                {   
                    $cinema = new Cinema($row["idCinema"],
                    $row["cinemaName"],
                    $row["adress"],
                    $row["ticketPrice"]);
                    array_push($cinemaList, $cinema);
                }
            return $cinemaList;
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function GetRoomList($idCinema){
            try
            {
                $roomList = array();
                $query = "SELECT * FROM room WHERE room.idCinema = ".$idCinema;

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

    }
