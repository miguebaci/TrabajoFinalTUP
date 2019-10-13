<?php
    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;

    class CinemaDAOJSON implements ICinemaDAO
    {
        private $cinemaList = array();

        public function Add(cinema $cinema)
        {
            $this->RetrieveData();

            $cinema->setIdCinema($this->getLastId()+1);
            
            array_push($this->cinemaList, $cinema);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cinemaList;
        }

        public function Delete(Cinema $cinema)
        {
            $this->retrieveData();
            $newList = array();
            $idCinema=$cinema->getIdCinema();
            foreach ($this->cinemaList as $cinemas) 
            {
                if($cinemas->getIdCinema() != $idCinema)
                {
				    array_push($newList, $cinemas);
			    }
		    }  

		    $this->cinemaList = $newList;
		    $this->SaveData();
        }

        public function Update(Cinema $cinema, $updatedCinema)
        {
            $this->retrieveData();
		    $newList = array();
            foreach ($this->cinemaList as $cinema) 
            {
                if($cinema->getIdCinema() != $updatedCinema["idCinema"])
                {
				array_push($newList, $cinema);
                }
                else
                {
                    if($updatedCinema["cinemaName"] != $cinema->getCinemaName() && $updatedCinema["cinemaName"] != NULL)
                    {
                        $cinema->setCinemaName($updatedCinema["cinemaName"]);
                    }
                    if($updatedCinema["adress"] != $cinema->getAdress() && $updatedCinema["adress"] != NULL)
                    {
                        $cinema->setAdress($updatedCinema["adress"]);
                    }
                    if($updatedCinema["totalCap"] != $cinema->getTotalCap() && $updatedCinema["totalCap"] != NULL)
                    {
                        $cinema->setTotalCap($updatedCinema["totalCap"]);
                    }
                    if($updatedCinema["ticketPrice"] != $cinema->getTicketPrice() && $updatedCinema["ticketPrice"] != NULL)
                    {
                        $cinema->setTicketPrice($updatedCinema["ticketPrice"]);
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
                $valuesArray["idCinema"] = $cinema->getIdCinema();
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
                    $cinema = new Cinema($valuesArray["idCinema"],$valuesArray["cinemaName"],$valuesArray["adress"],$valuesArray["totalCap"],$valuesArray["ticketPrice"]);

                    array_push($this->cinemaList, $cinema);
                }
            }
        }

        private function GetLastId(){
            $this->RetrieveData();
            $this->cinemaList!=NULL ? $cinema=end($this->cinemaList):$cinema=NULL;
            return $cinema==NULL ? 0 : $cinema->getIdCinema();
        }

        public function GetById($idCinema){
            $cinema;
            $this->RetrieveData();
            foreach($this->cinemaList as $cinemas){
                if($cinemas->getIdCinema()==$idCinema){
                    $cinema=$cinemas;
                }
            }
            return $cinema;
        }
    }
?>