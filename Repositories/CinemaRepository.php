<?php
    namespace Repositories;

    use Repositories\ICinemaRepository as ICinemaRepository;
    use Models\Cinema as Cinema;

    class CinemaRepository implements ICinemaRepository
    {
        private $cinemaList = array();

        public function Add(cinema $cinema)
        {
            $this->RetrieveData();
            
            array_push($this->cinemaList, $cinema);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cinemaList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
            {
                $valuesArray["idCine"] = $cinema->getIdCine();
                $valuesArray["cinemaName"] = $cinema->getCinemaName();
                $valuesArray["adress"] = $cinema->getAdress();
                $valuesArray["totalCap"] = $cinema->getTotalCap();
                $valuesArray["ticketPrice"] = $cinema->getTicketPrice();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('../Data/cinemas.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cinemaList = array();

            if(file_exists('../Data/cinemas.json'))
            {
                $jsonContent = file_get_contents('../Data/cinemas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cinema = new Cinema($valuesArray["cinemaName"],$valuesArray["adress"],$valuesArray["totalCap"],$valuesArray["ticketPrice"]);
                    $cinema->setIdCine($valuesArray["idCine"]);

                    array_push($this->cinemaList, $cinema);
                }
            }
        }
    }
?>