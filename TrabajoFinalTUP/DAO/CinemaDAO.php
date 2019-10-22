<?php
    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;
    use DAO\Connection as Connection;

    class CinemaDAO implements ICinemaDAO
    {
        private $connection;
        private $tableName = "cinema";

        public function Add(Cinema $cinema)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (cinemaName, adress, totalCap, ticketPrice) VALUES (:cinemaName, :adress, :totalCap, :ticketPrice);";
                
                $parameters["cinemaName"] = $cinema->getCinemaName();
                $parameters["adress"] = $cinema->getAdress();
                $parameters["totalCap"] = $cinema->getTotalCap();
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
                {               
                    $cinema = new Cinema($row["idCinema"],
                    $row["cinemaName"],
                    $row["adress"],
                    $row["totalCap"],
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
                $newTotalCap=$updatedCinema['totalCap'];
                $newTicketPrice=$updatedCinema['ticketPrice'];
                $query = "UPDATE ". $this->tableName ." SET cinemaName='$newName', adress='$newAdress', totalCap='$newTotalCap', ticketPrice='$newTicketPrice'"  . " WHERE idCinema ='$idCinema'";
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
                {               
                    $cinema = new Cinema($row["idCinema"],
                    $row["cinemaName"],
                    $row["adress"],
                    $row["totalCap"],
                    $row["ticketPrice"]);
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