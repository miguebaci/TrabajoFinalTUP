<?php
    namespace Models;
    
    use Models\UserProfile as UserProfile;

    class User
    {
        private $idUser;
        private $email;
        private $password;
        private $role;
        private $userProfile;

        public function __construct($idUser, $email, $password, $role){
            $this->idUser = $idUser;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
        }

        public function getIdUser()
        {
            return $this->idUser;
        }

        public function setIdUser($idUser)
        {
            $this->idUser = $idUser;
        } 

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function setRole($role)
        {
            $this->role = $role;
        }

        public function getRole()
        {
            return $this->role;
        }

        public function setUserProfile($lastName,$firstName,$dni){
            $this->userProfile=new UserProfile($lastName,$firstName,$dni);
        }

        public function getUserProfile(){
            return $this->userProfile;
        }
    }
?>