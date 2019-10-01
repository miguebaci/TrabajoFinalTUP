<?php
    namespace Models;

    use Models\User as User;

    class User
    {
        private $email;
        private $password;

        public function __construct($email, $password){
            $this->email = $email;
            $this->password = $password;
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
    }
?>