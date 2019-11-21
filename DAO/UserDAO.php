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

        /*
         * Recieves and User
         * Adds it to the Database
         */ 

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

                $query= "SELECT LAST_INSERT_ID()";

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query);

                $query2 = "INSERT INTO ".$this->profileTable." (idUser, firstName, lastName, dni) 
                            VALUES (:idUser, :firstName, :lastName, :dni);";
                
                $parameters2["idUser"] = $resultSet[0][0];
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

        /*
         * Recieves data from the facebook api (Email, First Name, Last Name)
         * Adds it as an User to the Database
         */ 

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

                $query= "SELECT LAST_INSERT_ID()";

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query);

                $query2 = "INSERT INTO ".$this->profileTable." (idUser, firstName, lastName, dni) 
                            VALUES (:idUser, :firstName, :lastName, :dni);";
                
                $parameters2["idUser"] = $resultSet[0][0];
                $parameters2["firstName"] = $first_name;
                $parameters2["lastName"] = $last_name;
                $parameters2["dni"] = -1;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query2, $parameters2);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        /*
         * Checks in the Database for all the Users
         * Returns a list of the Users
         */ 

        public function GetAll()
        {
            try
            {
                $cinemaList = array();

                $query = "SELECT U.idUser,U.email,U.password,R.role_description 
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
                    $row["role_description"]);

                    $query2 ="SELECT UP.firstName,UP.lastName,UP.dni 
                            FROM ".$this->tableName. " U 
                            INNER JOIN ".$this->profileTable." UP
                            ON U.idUser = UP.idUser
                            WHERE U.idUser=".$row["idUser"];

                    $this->connection = Connection::GetInstance();

                    $resultSet2 = $this->connection->Execute($query2);

                    if($resultSet2!=NULL){
                        $user->setUserProfile($resultSet2[0]["lastName"],$resultSet2[0]["firstName"],$resultSet2[0]["dni"]);
                        $resultSet2=NULL;
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

        /*
         * Recieves the name of a role 
         * Checks the Database for that name
         * Returns it's ID
         */

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

        /*
         * Recieves the ID of a role
         * Checks for it in the Database
         * Returns the name of that role
         */

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

        /*
         * Recieves an email
         * Checks with all the emails of the Users
         * And returns it's User if it has one
         */

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
        
        /*
         * Recieves a password and an user id
         * Updates it in the database
         */

        public function setNewPassword($password,$user){
            try
            {
                $query = "UPDATE ".$this->tableName."
                          SET password = :password 
                          WHERE idUser= :idUser";
                
                $parameters["password"] = $password;
                $parameters["idUser"] = $user->getIdUser();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        /*
         * Recieves UserProfile and User
         * Updates it on the DataBase
         */

        public function setUserNewProfile($userProfile,$user){
            try
            {   
                $query2 ="SELECT *
                            FROM ".$this->profileTable." UP
                            WHERE UP.idUser= :idUser";

                $parameters2["idUser"]=$user->getIdUser();

                $this->connection = Connection::GetInstance();

                $resultSet2 = $this->connection->Execute($query2,$parameters2);
                
                if($resultSet2!=NULL){
                    $query = "UPDATE ".$this->profileTable."
                    SET lastName = :lastName, firstName = :firstName, dni = :dni
                    WHERE idUser= :idUser";
          
                    $parameters["idUser"]=$user->getIdUser();
                    $parameters["lastName"] = $userProfile->getLastName();
                    $parameters["firstName"] = $userProfile->getFirstName();
                    $parameters["dni"] = $userProfile->getDni();

                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
                }else{
                    $query = "INSERT INTO ".$this->profileTable." (idUser, firstName, lastName, dni) 
                            VALUES (:idUser, :firstName, :lastName, :dni);";
                
                    $parameters["idUser"] = $user->getIdUser();
                    $parameters["lastName"] = $userProfile->getLastName();
                    $parameters["firstName"] = $userProfile->getFirstName();
                    $parameters["dni"] = $userProfile->getDni();

                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
                }

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetUserById($idUser){
            try
            {
                $user=NULL;
                $query = "SELECT U.idUser,U.email,U.password,R.role_description 
                            FROM ".$this->tableName. " U 
                            INNER JOIN ".$this->roleTable." R 
                            ON R.idRole = U.idRole 
                            WHERE U.idUser= :idUser";

                $parameters["idUser"]=$idUser;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query,$parameters);
                
                foreach ($resultSet as $row)
                {               
                    $user = new User($row["idUser"],
                    $row["email"],
                    $row["password"],
                    $row["role_description"]);

                    $query2 ="SELECT UP.firstName,UP.lastName,UP.dni 
                            FROM ".$this->tableName. " U 
                            INNER JOIN ".$this->profileTable." UP
                            ON U.idUser = UP.idUser
                            WHERE U.idUser=".$row["idUser"];

                    $this->connection = Connection::GetInstance();

                    $resultSet2 = $this->connection->Execute($query2);

                    if($resultSet2!=NULL){
                        $user->setUserProfile($resultSet2[0]["lastName"],$resultSet2[0]["firstName"],$resultSet2[0]["dni"]);
                        $resultSet2=NULL;
                    }
                }
                
                return $user;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    }
?>