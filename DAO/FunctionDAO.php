<?php

namespace DAO;

use Helper\FunctionHelper as FunctionHelper;
use DAO\IFunctionDAO as IFunctionDAO;
use Models\MovieFunction as MovieFunction;
use Models\Movie as Movie;
use Models\CinemaRoom as CinemaRoom;
use Models\Cinema as Cinema;
use DAO\Connection as Connection;

class FunctionDAO implements IFunctionDAO
{
    private $connection;
    private $helper;
    private $tableName = "moviefunction";
    private $movieTable = "movie";

    public function __construct()
    {
        $this->helper = new FunctionHelper();
    }

    public function Add(MovieFunction $movieFunction)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (idMovie, idRoom, function_date, function_time) VALUES (:idMovie, :idRoom, :function_date, :function_time);";

            $movie = $movieFunction->getMovie();
            $date = $movieFunction->getDate();
            $movie = $movieFunction->getMovie();
            $room = $movieFunction->getRoom();
            $date = $date->format("Y-m-d");
            $parameters["idMovie"] = $movie->getidMovie();
            $parameters["idRoom"] = $room->getIdCinemaRoom();
            $parameters["function_date"] = $date;
            $parameters["function_time"] = $movieFunction->getTime();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function GetAll()
    {
        try {
            $functionList = array();

            $query = "SELECT * FROM 
            (SELECT * FROM " . $this->tableName . " F WHERE F.function_date >= CURDATE()) A 
            WHERE A.idMovieFunction NOT IN (SELECT idMovieFunction FROM moviefunction F WHERE F.function_date = CURDATE() AND F.function_time < CURTIME()) 
            GROUP BY A.idMovieFunction ORDER BY A.function_date";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $movieFunction = new MovieFunction($row["idMovieFunction"], $row["function_date"], $row["function_time"], $this->GetMovieByFunctionId($row["idMovieFunction"]));
                $roomDAO = $this->helper->getRoomDAO();
                $room = $roomDAO->GetById($movieFunction->getIdFunction());
                $movieFunction->setRoom($room);

                array_push($functionList, $movieFunction);
            }

            return $functionList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function GetAllByRoomIdAdmin(CinemaRoom $room)
    {
        try {
            $idRoom = $room->getIdCinemaRoom();
            $functionList = array();

            $query = "SELECT * FROM 
            (SELECT * FROM " . $this->tableName . " F WHERE F.function_date >= CURDATE()) A 
            WHERE A.idRoom = " . $idRoom . "
            AND A.idMovieFunction NOT IN (SELECT idMovieFunction FROM moviefunction F WHERE F.function_date = CURDATE() AND F.function_time < CURTIME()) 
            GROUP BY A.idMovieFunction ORDER BY A.function_date";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $movieFunction = new MovieFunction(
                    $row["idMovieFunction"],
                    $row["function_date"],
                    $row["function_time"],
                    $this->GetMovieByFunctionId($row["idMovieFunction"])
                );
                $movieFunction->setRoom($room);

                array_push($functionList, $movieFunction);
            }
            return $functionList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function GetAllByRoomId(CinemaRoom $room)
    {
        try {
            $idRoom = $room->getIdCinemaRoom();
            $functionList = array();

            $query = "SELECT * FROM 
            (SELECT * FROM " . $this->tableName . " F WHERE F.function_date >= CURDATE()) A 
            WHERE A.idRoom = " . $idRoom . " 
            AND  A.function_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 3 DAY
            AND A.idMovieFunction NOT IN (SELECT idMovieFunction FROM moviefunction F WHERE F.function_date = CURDATE() AND F.function_time < CURTIME()) 
            GROUP BY A.idMovieFunction ORDER BY A.function_date";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $movieFunction = new MovieFunction(
                    $row["idMovieFunction"],
                    $row["function_date"],
                    $row["function_time"],
                    $this->GetMovieByFunctionId($row["idMovieFunction"])
                );
                $movieFunction->setRoom($room);

                array_push($functionList, $movieFunction);
            }
            return $functionList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetMovieByFunctionId($idFunction)
    {
        try {
            $query = "SELECT M.idMovie, M.movieName, M.movielanguage, M.duration, M.poster_image FROM " . $this->movieTable . " M INNER JOIN " . $this->tableName . " F ON M.idMovie = F.IdMovie   WHERE F.idMovieFunction = '$idFunction'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $genreDAO = $this->helper->getGenreDAO();
            foreach ($resultSet as $row) {
                $movie = new Movie(
                    $row["idMovie"],
                    $row["movieName"],
                    $row["movielanguage"],
                    $row["duration"],
                    $row["poster_image"],
                    $genreDAO->GetAllGenresByIds($genreDAO->GetIdGenreById($row["idMovie"]))
                );
            }
            return $movie;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function Delete(MovieFunction $movieFunction)
    {
        try {
            $idFunction = $movieFunction->getIdFunction();
            $query = "DELETE FROM " . $this->tableName . " WHERE " . $this->tableName . ".idMovieFunction ='$idFunction'";
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function DeleteOldFunctions()
    {
        try {
            $idArray = array();
            $query = "SELECT idMovieFunction FROM (SELECT * FROM " . $this->tableName . " F 
            WHERE F.function_date <= CURDATE()) A 
            WHERE A.idMovieFunction NOT IN (SELECT idMovieFunction FROM " . $this->tableName . " F WHERE F.function_date = CURDATE() AND F.function_time > CURTIME())";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                array_push($idArray, $row["idMovieFunction"]);
            }

            foreach ($idArray as $idFunction) {
                $query2 = "DELETE FROM " . $this->tableName . " WHERE " . $this->tableName . ".idMovieFunction ='$idFunction'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query2);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetById($idFunction)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE " . $this->tableName . ".idMovieFunction ='$idFunction'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $movieFunction = NULL;
            foreach ($resultSet as $row) {
                $movie = $this->GetMovieByFunctionId($idFunction);
                $movieFunction = new MovieFunction(
                    $row["idMovieFunction"],
                    $row["function_date"],
                    $row["function_time"],
                    $movie
                );
            }
            return $movieFunction;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetByCinemaIdAndMovieId($idCinema, $idMovie)
    {
        try {
            $query = "SELECT A.idMovieFunction, A.function_date, A.function_time FROM (SELECT F.idMovieFunction, F.function_date, F.function_time FROM " . $this->tableName . " F
            INNER JOIN room R ON R.idRoom = F.IdRoom
            INNER JOIN cinema C ON C.idCinema = R.IdCinema
            WHERE F.idMovie ='$idMovie' AND C.idCinema = '$idCinema') A  WHERE A.function_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 3 DAY
            AND A.idMovieFunction NOT IN (SELECT idMovieFunction FROM moviefunction F WHERE F.function_date = CURDATE() AND F.function_time < CURTIME())
            GROUP BY A.idMovieFunction";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $movieFunction = NULL;
            $functionList = array();

            foreach ($resultSet as $row) {
                $movie = $this->GetMovieByFunctionId($row["idMovieFunction"]);
                $movieFunction = new MovieFunction(
                    $row["idMovieFunction"],
                    $row["function_date"],
                    $row["function_time"],
                    $movie
                );
                array_push($functionList, $movieFunction);
            }

            return $functionList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetByCinemaIdAndMovieIdAndDate($idCinema, $idMovie, $startDate, $endDate)
    {
        try {
            $query = "SELECT A.idMovieFunction, A.function_date, A.function_time FROM (SELECT F.idMovieFunction, F.function_date, F.function_time FROM " . $this->tableName . " F
            INNER JOIN room R ON R.idRoom = F.IdRoom
            INNER JOIN cinema C ON C.idCinema = R.IdCinema
            WHERE F.idMovie ='$idMovie' AND C.idCinema = '$idCinema') A  WHERE A.function_date BETWEEN '$startDate' AND '$endDate'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $movieFunction = NULL;
            $functionList = array();

            foreach ($resultSet as $row) {
                $movie = $this->GetMovieByFunctionId($row["idMovieFunction"]);
                $movieFunction = new MovieFunction(
                    $row["idMovieFunction"],
                    $row["function_date"],
                    $row["function_time"],
                    $movie
                );
                array_push($functionList, $movieFunction);
            }

            return $functionList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetByCinemaIdAndGenreId($idCinema, $idGenre)
    {
        try {
            $query = "SELECT A.idMovieFunction, A.function_date, A.function_time FROM (SELECT F.idMovieFunction, F.function_date, F.function_time FROM " . $this->tableName . " F
            INNER JOIN movie M ON M.idMovie = F.idMovie
            INNER JOIN room R ON R.idRoom = F.IdRoom
            INNER JOIN cinema C ON C.idCinema = R.IdCinema
            INNER JOIN moviexgenre MXG ON M.idMovie = MXG.idMovie
            WHERE MXG.idGenre LIKE'$idGenre' AND C.idCinema = '$idCinema')A  WHERE A.function_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 3 DAY
            AND A.idMovieFunction NOT IN (SELECT idMovieFunction FROM moviefunction F WHERE F.function_date = CURDATE() AND F.function_time < CURTIME())
            GROUP BY A.idMovieFunction";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $movieFunction = NULL;
            $functionList = array();

            foreach ($resultSet as $row) {
                $movie = $this->GetMovieByFunctionId($row["idMovieFunction"]);
                $movieFunction = new MovieFunction(
                    $row["idMovieFunction"],
                    $row["function_date"],
                    $row["function_time"],
                    $movie
                );
                array_push($functionList, $movieFunction);
            }

            return $functionList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function FunctionExist(CinemaRoom $room, $date, $time)
    {
        try {
            $idRoom = $room->getIdCinemaRoom();
            $query = "SELECT function_date, function_time FROM " . $this->tableName . " WHERE idRoom ='$idRoom'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $exists = false;

            foreach ($resultSet as $row) {
                $functionTime = date_create($row["function_time"]);
                $functionDate = date_create($row["function_date"]);
                if ($functionDate == $date && $functionTime->format('H:i') == $time) {
                    return $exists = true;
                }
            }
            return $exists;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function GetRoomId(MovieFunction $movieFunction)
    {
        try {
            $idFunction = $movieFunction->getIdFunction();
            $query = "SELECT idRoom FROM " . $this->tableName . " WHERE " . $this->tableName . ".idMovieFunction ='$idFunction'";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $idRoom = NULL;

            foreach ($resultSet as $row) {
                $idRoom = $row["idRoom"];
            }
            return $idRoom;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetCinemaByFunction(MovieFunction $movieFunction)
    {
        try {
            $idFunction = $movieFunction->getIdFunction();
            $query = "SELECT *
                            FROM " . $this->tableName . " MF 
                            JOIN room R
                            ON R.idRoom = MF.idRoom 
                            JOIN cinema C
                            ON C.idCinema=R.idCinema 
                            WHERE MF.idMovieFunction = :idMovieFunction";

            $parameters["idMovieFunction"] = $movieFunction->getIdFunction();

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);


            $cinema = new Cinema($resultSet[0]["idCinema"], $resultSet[0]["cinemaName"], $resultSet[0]["address"], $resultSet[0]["ticketPrice"]);
            $room = array(new CinemaRoom($resultSet[0]["idRoom"], $resultSet[0]["roomName"], $resultSet[0]["totalCap"]));
            $cinema->setCinemaRoomList($room);
            $mf = array();
            array_push($mf, $movieFunction);
            $cinema->getCinemaRoomList()[0]->setFunctionList($mf);
            return $cinema;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllMoviesInFunctions(){
        $functionList = $this->GetAll();
        $movieList = array();
        foreach ($functionList as $function) {
            $movie = $this->GetMovieByFunctionId($function->getIdFunction());
            if (!in_array($movie, $movieList)) {
                array_push($movieList, $movie);
            }
        }
        return $movieList;
    }
}
?>