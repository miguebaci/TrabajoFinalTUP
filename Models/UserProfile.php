<?php
    namespace Models;

    class UserProfile
    {
        private $lastName;
        private $firstName;
        private $dni;

        public function __construct($lastName, $firstName,$dni){
            $this->lastName = $lastName;
            $this->firstName = $firstName;
            $this->dni=$dni;
        }

        public function getLastName()
        {
            return $this->lastName;
        }

        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
        }

        public function getFirstName()
        {
            return $this->firstName;
        }

        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
        }

        public function getDni()
        {
            return $this->dni;
        }

        public function setDni($dni)
        {
            $this->dni = $dni;
        }
        
    }
?>