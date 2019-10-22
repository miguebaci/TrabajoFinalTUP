<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO implements IUserDAO
    {
        private $connection;
        private $tableName = "user";

        public function Add(User $user)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (email, password, idRole) VALUES (:email, :password, :idRole);";
                
                $parameters["email"] = $user->getEmail();
                $parameters["password"] = $cinema->getPassword();
                $parameters["idRole"] = $this->getIdRole($cinema->getRole());

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
                    $cinema = new Cinema($row["idUser"],
                    $row["email"],
                    $row["password"],
                    $this->getRoleById($row["idRole"]));

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