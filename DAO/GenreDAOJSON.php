<?php
    namespace DAO;

    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;

    class GenreDAOJSON implements IGenreDAO
    {
        private $genreList = array();

        public function Add(Genre $genre)
        {
            $this->RetrieveData();
            
            array_push($this->genreList, $genre);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->genreList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->genreList as $genre)
            {
                $valuesArray["idGenre"] = $genre->getIdGenre();
                $valuesArray["description"] = $genre->getDescription();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents(ROOT . 'Data/genres.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->genreList = array();

            if(file_exists(ROOT . 'Data/genres.json'))
            {
                $jsonContent = file_get_contents(ROOT . 'Data/genres.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $genre = new Genre($valuesArray["idGenre"],$valuesArray["description"]);

                    array_push($this->genreList, $genre);
                }
            }
        }

        public function GetById($idGenre){
            $genre;
            $this->RetrieveData();
            foreach($this->genreList as $genres){
                if($genres->getIdGenre()==$idGenre){
                    $genre=$genres;
                }
            }
            return $genre;
        }

        public function UpdateAll(){
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.themoviedb.org/3/genre/movie/list?language=en-US&api_key=f9b934d767d65140edaa81c51e8a4111",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "{}",
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            $arrayToDecode=json_decode($response,true);

            $array=$arrayToDecode["results"];

            $this->RetrieveData();

            foreach($array as $thing=>$genre){
                $flag=false;
                foreach($this->genreList as $genreJSON){
                    if($genreJSON->getIdGenre()==$genre['idGenre']){
                        $flag=true;
                    }
                }
                if($flag==false){
                    $genres=new Genre($genre['idGenre'],$genre['description']);
                    $this->Add($genres);   
                }
            }
        }
    }
?>