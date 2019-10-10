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
                    $cinema = new Cinema($row["cinemaName"],$row["adress"],$row["totalCap"],$row["ticketPrice"]);
                    /*$cinema->setCinemaName($row["cinemaName"]);
                    $cinema->setAdress($row["adress"]);
                    $cinema->setTotalCap($row["totalCap"]);
                    $cinema->setTicketPrice($row["ticketPrice"]);*/

                    array_push($cinemaList, $cinema);
                }

                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    
        public function Delete($cinemaName)
        {
            $this->retrieveData();
		    $newList = array();
            foreach ($this->cinemaList as $cinema) 
            {
                if($cinema->getCinemaName() != $cinemaName)
                {
				array_push($newList, $cinema);
			    }
		    }  

		    $this->cinemaList = $newList;
		    $this->SaveData();
        }

        public function Update(Cinema $updatedCinema, $cinemaName)
        {
            $this->retrieveData();
		    $newList = array();
            foreach ($this->cinemaList as $cinema) 
            {
                if($cinema->getCinemaName() != $cinemaName)
                {
				array_push($newList, $cinema);
                }
                else
                {
                    if($cinema["cinemaName"] != $updatedCinema->getCinemaName() && $updatedCinema->getCinemaName() != NULL)
                    {
                        $cinema->setCinemaName($updatedCinema->getCinemaName());
                    }
                    if($cinema["adress"] != $updatedCinema->getAdress() && $updatedCinema->getAdress() != NULL)
                    {
                        $cinema->setAdress($updatedCinema->getAdress());
                    }
                    if($cinema["totalCap"] != $updatedCinema->getTotalCap() && $updatedCinema->getTotalCap() != NULL)
                    {
                        $cinema->setTotalCap($updatedCinema->getTotalCap());
                    }
                    if($cinema["ticketPrice"] != $updatedCinema->getTicketPrice() && $updatedCinema->getTicketPrice() != NULL)
                    {
                        $cinema->setTicketPrice($updatedCinema->getTicketPrice());
                    }
                    array_push($newList, $cinema);
                }
		    }  
            
		    $this->cinemaList = $newList;
		    $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
            {
                //$valuesArray["idCine"] = $cinema->getIdCine();
                $valuesArray["cinemaName"] = $cinema->getCinemaName();
                $valuesArray["adress"] = $cinema->getAdress();
                $valuesArray["totalCap"] = $cinema->getTotalCap();
                $valuesArray["ticketPrice"] = $cinema->getTicketPrice();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents(ROOT . 'Data/cinemas.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cinemaList = array();

            if(file_exists(ROOT . 'Data/cinemas.json'))
            {
                $jsonContent = file_get_contents(ROOT . 'Data/cinemas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cinema = new Cinema($valuesArray["cinemaName"],$valuesArray["adress"],$valuesArray["totalCap"],$valuesArray["ticketPrice"]);
                    //$cinema->setIdCine($valuesArray["idCine"]);

                    array_push($this->cinemaList, $cinema);
                }
            }
        }
    }
?>