<?php
namespace Models;

use Models\Movie as Movie;

class Movie
{   //private static $autoIncrement;
    private $idMovie;
    private $movieName;
    private $duration;
    private $language;
    private $image;
    private $idGenre;

    public function __construct($idMovie, $movieName, $language, $duration, $image, $idGenre){
        $this->idMovie=$idMovie;
        $this->movieName = $movieName;
        $this->duration = $duration;
        $this->language = $language;
        $this->image = $image;
        $this->idGenre= json_encode($idGenre);
    }
    
    public function getIdMovie()
    {
        return $this->idMovie;
    }

    private function setIdMovie($idMovie)
    {
        $this->idMovie = $idMovie;
    }
    /*
    private function IncrementId(){
        self::$autoIncrement++;
        return self::$autoIncrement;
    }*/

    public function getMovieName()
    {
        return $this->movieName;
    }

    public function setMovieName($movieName)
    {
        $this->movieName = $movieName;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getIdGenre(){

        return json_decode($this->idGenre,true);
    }

    public function setIdGenre($idGenre){
        $idGenres=json_encode($idGenre);
        $this->idGenre=$idGenres;
    }
}
?>