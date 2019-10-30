<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO implements IUserDAO
    {
        private $connection;
        private $tableName = "user";
        private $roleTable = "userrole";
        private $profileTable = "userprofile";
        private $userList = array();

        public function Add(User $user)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (email, password, idRole) 
                            VALUES (:email, :password, :idRole);";
                
                $parameters["email"] = $user->getEmail();
                $parameters["password"] = $user->getPassword();
                $parameters["idRole"] = $this->getIdRole($user->getRole());

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                $idUser=$this->getEmailID($user->getEmail());

                $query2 = "INSERT INTO ".$this->profileTable." (idUser, firstName, lastName, dni) 
                            VALUES (:idUser, :firstName, :lastName, :dni);";
                
                $parameters2["idUser"] = $idUser;
                $parameters2["firstName"] = -1;
                $parameters2["lastName"] = -1;
                $parameters2["dni"] = -1;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query2, $parameters2);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function AddFacebook($email,$first_name,$last_name)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (email, password, idRole) 
                            VALUES (:email, :password, :idRole);";
                
                $parameters["email"] = $email;
                $parameters["password"] = "FACEBOOK".$email;
                $parameters["idRole"] = 1;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                $idUser=$this->getEmailID($email);

                $query2 = "INSERT INTO ".$this->profileTable." (idUser, firstName, lastName, dni) 
                            VALUES (:idUser, :firstName, :lastName, :dni);";
                
                $parameters2["idUser"] = $idUser;
                $parameters2["firstName"] = $first_name;
                $parameters2["lastName"] = $last_name;
                $parameters2["dni"] = -1;

                var_dump($query2);
                var_dump($parameters2);

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query2, $parameters2);
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

                $query = "SELECT U.idUser,U.email,U.password,R.role_description 
                            FROM ".$this->tableName. " U 
                            INNER JOIN ".$this->roleTable." R 
                            ON R.idRole = U.idRole";

                $query2 ="SELECT UP.firstName,UP.lastName,UP.dni 
                            FROM ".$this->tableName. " U 
                            INNER JOIN ".$this->profileTable." UP
                            ON U.idUser = UP.idUser";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $user = new User($row["idUser"],
                    $row["email"],
                    $row["password"],
                    $row["role_description"]);

                    $query2 ="SELECT UP.firstName,UP.lastName,UP.dni 
                            FROM ".$this->tableName. " U 
                            INNER JOIN ".$this->profileTable." UP
                            ON U.idUser = UP.idUser";

                    $this->connection = Connection::GetInstance();

                    $resultSet2 = $this->connection->Execute($query2);

                    if($resultSet2!=NULL){
                        $user->setUserProfile($resultSet2[0]["firstName"],$resultSet2[0]["lastName"],$resultSet2[0]["dni"]);
                    }

                    array_push($this->userList, $user);
                }

                return $this->userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetIdRole($role){
            try
            {
                $query = "SELECT idRole FROM ".$this->roleTable. " WHERE ". $this->roleTable .".role_description ='$role'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                return $resultSet[0]["idRole"];
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function GetRoleById($idRole){
            try
            {
                $query = "SELECT role_description FROM ".$this->roleTable. " WHERE ". $this->roleTable .".idRole ='$idRole'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                return $resultSet[0]["role_description"];
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function emailVerification($email){
            $this->getAll();
                $resultSet=NULL;
                foreach($this->userList as $user){
                    if($email==$user->getEmail()){
                        $resultSet=$user;
                    }
                }
                return $resultSet;
        }

        private function getEmailID($email){
            $user=$this->emailVerification($email);
            return $user->getIdUser();
        }

    }
?>