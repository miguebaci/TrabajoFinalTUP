<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO implements IUserDAO
    {
        private $connection;
        private $tableName = "user";
        private $roleTable = "role";

        public function Add(User $user)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (email, password, idRole) 
                            VALUES (:email, :password, :idRole);";
                
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

                $query = "SELECT U.idUser,U.email,U.password,R.description 
                            FROM ".$this->tableName. " U 
                            INNER JOIN ".$this->roleTable." R 
                            ON R.idRole = U.idRole";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $user = new User($row["idUser"],
                    $row["email"],
                    $row["password"],
                    $row["description"]));

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetIdRole($role){
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

    }
?>