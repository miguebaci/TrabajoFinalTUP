<?php
    namespace Controllers;

    use DAO\IUserDAO as IUserDAO;
    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function Register()
        {
            require_once(VIEWS_PATH."register.php");
        }

        public function Login()
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function RegisterValidation()
        {   
            if($_POST){
                if($this->userDAO->emailVerification($_POST["email"])==NULL){
                    if($_POST["password"]==$_POST["password2"]){    
                        $user=new User(0,$_POST["email"],$_POST["password"],$_POST["role"]);
                        $this->userDAO->Add($user);
                        echo "<script> alert('Account created');";
                        echo "window.location = '".FRONT_ROOT."index.php'; </script>";
                    }else{
                        echo "<script> alert('Passwords do not match');";
                        echo "window.location = '".FRONT_ROOT."User/Register'; </script>";
                    }
                }else{
                    echo "<script> alert('Email already in use');";
                    echo "window.location = '".FRONT_ROOT."User/Register'; </script>";
                }
            }else{
                echo "<script> alert('There was an error');";
                echo "window.location = '".FRONT_ROOT."User/Register'; </script>";
            }
        }

        public function LoginValidation(){
            if($_POST){
                $user=$this->userDAO->emailVerification($_POST["email"]);
                if($user!=NULL){
                    if($_POST["password"]=$user[0]["password"]){
                        $loggedUser= new User($user[0]["idUser"],$user[0]["email"],$user[0]["password"],$user[0]["idRole"]);
                        $_SESSION["loggedUser"]=$loggedUser;
                        var_dump($loggedUser);
                        echo "<script> alert('Logged In');";
                        echo "window.location = '".FRONT_ROOT."index.php'; </script>";
                    }
                    echo "<script> alert('Wrong Password');";
                    echo "window.location = '".FRONT_ROOT."User/Login'; </script>";
                }
                echo "<script> alert('Email does not exist');";
                echo "window.location = '".FRONT_ROOT."User/Login'; </script>";
            }
        }

        public function LoginFacebook(){
            require_once(VIEWS_PATH."loginfb.php");
        }

        public function FBCallback(){
            require_once(VIEWS_PATH."fb-callback.php");
        }

    }
?>