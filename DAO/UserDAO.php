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
                    $user = new User($row["idUser"],
                    $row["email"],
                    $row["password"],
                    $this->getRoleById($row["idRole"]));

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByIdRole($role){
            try
            {
                $query = "SELECT idRole FROM ".$this->tableName. " WHERE ". $this->tableName .".description ='$role'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                return $resultSet["idRole"];
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function GetRoleById($idRole){
            try
            {
                $query = "SELECT description FROM ".$this->tableName. " WHERE ". $this->tableName .".idRole ='$idRole'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                return $resultSet["idRole"];
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

    }
?>