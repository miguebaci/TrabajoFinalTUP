<?php
    namespace Controllers;

    use DAO\IUserDAO as IUserDAO;
    use DAO\UserDAO as UserDAO;
    use Models\User as User;
    use Facebook\Facebook as Facebook;

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
                    if($_POST["password"]==$user->getPassword()){
                        $loggedUser= $user;
                        $_SESSION["loggedUser"]=$loggedUser;
                        echo "<script> alert('Logged In');";
                        echo "window.location = '".FRONT_ROOT."index.php'; </script>";
                    }else{
                        echo "<script> alert('Wrong Password');";
                        echo "window.location = '".FRONT_ROOT."User/Login'; </script>";
                    }
                }else{
                    echo "<script> alert('Email does not exist');";
                    echo "window.location = '".FRONT_ROOT."User/Login'; </script>";
                }
            }else{
                echo "<script> alert('Erro');";
                echo "window.location = '".FRONT_ROOT."User/Login'; </script>";
            }
        }

        public function FBCallback(){
            $fb = new Facebook([
                'app_id' => '2460451207325213', // Replace {app-id} with your app id
                'app_secret' => '9af682d41351182a21de000a6efc1f48',
                'default_graph_version' => 'v3.2',
            ]);

            $helper = $fb->getRedirectLoginHelper();

            try {
                $accessToken = $helper->getAccessToken();
            }catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            if (! isset($accessToken)) {
                if ($helper->getError()) {
                    header('HTTP/1.0 401 Unauthorized');
                    echo "Error: " . $helper->getError() . "\n";
                    echo "Error Code: " . $helper->getErrorCode() . "\n";
                    echo "Error Reason: " . $helper->getErrorReason() . "\n";
                    echo "Error Description: " . $helper->getErrorDescription() . "\n";
                } else {
                    header('HTTP/1.0 400 Bad Request');
                    echo 'Bad request';
                }
                exit;
            }

            // Logged in
            /*echo '<h3>Access Token</h3>';
            var_dump($accessToken->getValue());*/

            // The OAuth 2.0 client handler helps us manage access tokens
            $oAuth2Client = $fb->getOAuth2Client();

            // Get the access token metadata from /debug_token
            $tokenMetadata = $oAuth2Client->debugToken($accessToken);
            /*echo '<h3>Metadata</h3>';
            var_dump($tokenMetadata);*/

            // Validation (these will throw FacebookSDKException's when they fail)
            $tokenMetadata->validateAppId('2460451207325213'); // Replace {app-id} with your app id
            // If you know the user ID this access token belongs to, you can validate it here
            //$tokenMetadata->validateUserId('123');
            $tokenMetadata->validateExpiration();

            if (! $accessToken->isLongLived()) {
                // Exchanges a short-lived access token for a long-lived one
                try {
                    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
                } catch (Facebook\Exceptions\FacebookSDKException $e) {
                    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                    exit;
                }

                echo '<h3>Long-lived</h3>';
                var_dump($accessToken->getValue());
            }

            $_SESSION['fb_access_token'] = (string) $accessToken;

            //Geting User Info
            $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
            $response = $fb->get('/me?locale=en_US&fields=first_name,last_name,email');
            $userNode = $response->getGraphUser();

            /*echo '<br>';
            echo $userNode["email"]." ".$userNode["last_name"]." ".$userNode["first_name"];
            echo '<br>';*/

            $user=$this->userDAO->emailVerification($userNode["email"]);
            $loggedUser=NULL;
            if($user!=NULL){
                $loggedUser= $user;
            }else{       
                $this->userDAO->AddFacebook($userNode["email"],$userNode["first_name"],$userNode["last_name"]);
                $user=$this->userDAO->emailVerification($userNode["email"]);
                $loggedUser=$user;
            }
            $_SESSION["loggedUser"]=$loggedUser;
            echo "<script> alert('Logged In With Facebook');";
            echo "window.location = '".FRONT_ROOT."index.php'; </script>";

            // User is logged in with a long-lived access token.
            // You can redirect them to a members-only page.
            //header('Location: https://example.com/members.php');
        }
        
        public function Logout(){
            session_destroy();
            unset($_SESSION["loggedUser"]);
            unset($_SESSION["fb_access_token"]);
            echo "<script> alert('Logged Out');";
            echo "window.location = '".FRONT_ROOT."index.php'; </script>";
        }


        public function LoggedUser(){
            if(isset($_SESSION["loggedUser"]))
                var_dump($_SESSION["loggedUser"]);
            else
                echo "No logged user";
        }

        public function UserProfile(){
            if(isset($_SESSION["loggedUser"])){
                if(isset($_SESSION["loggedUser"])){
                    require_once(VIEWS_PATH."user-profile.php");
                }else{
                    echo "<script> alert('You need to be logged in to access this page');";  
                    echo "window.location = '../index.php'; </script>";
                }
            }else{
                echo "<script> alert('You need to be logged in to access this page');";  
                echo "window.location = '../index.php'; </script>";
            }
        }

        public function ChangePassword(){
            if(isset($_SESSION["loggedUser"])){
                if(isset($_SESSION["loggedUser"])){
                    require_once(VIEWS_PATH."change-password.php");
                }else{
                    echo "<script> alert('You need to be logged in to access this page');";  
                    echo "window.location = '../index.php'; </script>";
                }
            }else{
                echo "<script> alert('You need to be logged in to access this page');";  
                echo "window.location = '../index.php'; </script>";
            }
        }

        public function ChangePasswordConfirm(){
            if(isset($_POST)){
                if($_SESSION["loggedUser"]->getPassword()==$_POST["oldPassword"]){
                    if($_POST["newPassword"]==$_POST["newPassword2"]){
                        $_SESSION["loggedUser"]->setPassword($_POST["newPassword"]);
                        $this->userDAO->setNewPassword($_POST["newPassword"], $_SESSION["loggedUser"]->getIdUser());
                        echo "<script> alert('Password changed');";
                        echo "window.location = '".FRONT_ROOT."User/UserProfile'; </script>";
                    }else{
                        echo "<script> alert('The Passwords do not match');";
                        echo "window.location = '".FRONT_ROOT."User/ChangePassword'; </script>";
                    }
                }else{
                    echo "<script> alert('Old Password field is wrong');";
                    echo "window.location = '".FRONT_ROOT."User/ChangePassword'; </script>";
                }
            }else{
                echo "<script> alert('Error');";
                echo "window.location = '".FRONT_ROOT."index.php'; </script>";
            }
        }

    }
?>