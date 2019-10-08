<?php
    namespace DAO;

    use DAO\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;

    class MovieDAO implements IMovieDAO
    {
        private $movieList = array();

        public function Add(Movie $movie)
        {
            $this->RetrieveData();
            
            array_push($this->movieList, $movie);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->movieList;
        }

        public function Delete($idMovie)
        {
            $this->retrieveData();
		    $newList = array();
            foreach ($this->movieList as $Movie) 
            {
                if($movie->getIdMovie() != $idMovie)
                {
				array_push($newList, $movie);
			    }
		    }  

		    $this->movieList = $newList;
		    $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->movieList as $Movie)
            {
                $valuesArray["idMovie"] = $movie->getIdMovie();
                $valuesArray["movieName"] = $movie->getMovieName();
                $valuesArray["language"] = $movie->getLanguage();
                $valuesArray["duration"] = $movie->getDuration();
                $valuesArray["image"] = $movie->getImage();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents(ROOT . 'Data/Movies.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->movieList = array();

            if(file_exists(ROOT . 'Data/Movies.json'))
            {
                $jsonContent = file_get_contents(ROOT . 'Data/Movies.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $movie = new Movie($valuesArray["idMovie"], $valuesArray["movieName"],$valuesArray["language"],$valuesArray["duration"],$valuesArray["image"]);
                    array_push($this->movieList, $movie);
                }
            }
        }
    }
?>