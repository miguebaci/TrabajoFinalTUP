<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;
    use Facebook\Facebook as Facebook;
    use Helper\UserHelper as Helper;
    use Mailer\PHPMailer as PHPMailer;
    use Mailer\Exception as MailerException;

    class UserController
    {
        private $userDAO;
        private $helper;

        public function __construct()
        {   
            $this->userDAO = new UserDAO();
            $this->helper= new Helper();
        }

        public function Register()
        {
            require_once(VIEWS_PATH."register.php");
        }

        public function Login()
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function RegisterValidation($role, $email, $password, $password2)
        {   
                if($this->userDAO->emailVerification($email)==NULL){
                    if($password==$password2){    
                        $user=new User(0,$email,$password,$role);
                        $this->userDAO->Add($user);
                        $this->SendCreateMail($user);
                        $this->Message("Account Created", FRONT_ROOT."index.php");
                    }else{
                        $this->Message("Passwords do not match", FRONT_ROOT."User/Register");
                    }
                }else{
                    $this->Message("Email already in use", FRONT_ROOT."User/Register");
                }
        }

        public function LoginValidation($email,$password){
                $user=$this->userDAO->emailVerification($email);
                if($user!=NULL){
                    if($password==$user->getPassword()){
                        $loggedUser= $user;
                        $_SESSION["loggedUser"]=$loggedUser;
                        $this->Message("Logged In", FRONT_ROOT."index.php");
                    }else{
                        $this->Message("Wrong Password", FRONT_ROOT."User/Login");
                    }
                }else{
                    $this->Message("Email doesnt exist", FRONT_ROOT."User/Login");
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
            $this->Message("Logged in with Facebook", FRONT_ROOT."index.php");

            // User is logged in with a long-lived access token.
            // You can redirect them to a members-only page.
            //header('Location: https://example.com/members.php');
        }
        
        public function Logout(){
            session_destroy();
            unset($_SESSION["loggedUser"]);
            unset($_SESSION["fb_access_token"]);
            $this->Message("Logged out", FRONT_ROOT."index.php");
        }

        public function UserProfile(){
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."user-profile.php");
        }

        public function ChangePassword(){
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."change-password.php");
        }

        public function ChangePasswordConfirm($oldPassword,$newPassword,$newPassword2){
            require_once(VIEWS_PATH."validate-session.php");
                if($_SESSION["loggedUser"]->getPassword()==$oldPassword){
                    if($newPassword==$newPassword2){
                        $_SESSION["loggedUser"]->setPassword($newPassword);
                        $this->userDAO->setNewPassword($newPassword, $_SESSION["loggedUser"]);
                        $this->Message("Password changed", FRONT_ROOT."User/UserProfile");
                    }else{
                        $this->Message("The Passwords do not match", FRONT_ROOT."User/ChangePassword");
                    }
                }else{
                    $this->Message("Old Password field is incorrect", FRONT_ROOT."User/ChangePassword");
                }
        }

        public function ChangeUserProfile(){
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."change-user-profile.php");
        }

        public function changeUserProfileConfirm($firstName,$lastName,$dni){
            require_once(VIEWS_PATH."validate-session.php");
                $_SESSION["loggedUser"]->setUserProfile($lastName,$firstName,$dni);
                $this->userDAO->setUserNewProfile($_SESSION["loggedUser"]->getUserProfile(),$_SESSION["loggedUser"]);
                $this->Message("Information changed", FRONT_ROOT."User/UserProfile");
        }

        public function ShowUserPurchases(){
            require_once(VIEWS_PATH."validate-session.php");
            $purchaseList=$this->helper->helpBringUserPurchases($_SESSION["loggedUser"]);
            require_once(VIEWS_PATH."show-user-purchases.php");
        }

        public function ShowAnalytics(){
            require_once(VIEWS_PATH."validate-session-admin.php");
            $cinemas=$this->helper->helpGetCinemas();
            $movies=$this->helper->helpAllMoviesInFunctions();
            require_once(VIEWS_PATH."purchase-analytics-select.php");

        }

        public function AnalyticsSelect($firstId="",$date_start,$date_end,$button_name=""){
            require_once(VIEWS_PATH."validate-session-admin.php");
                if($date_start<=$date_end){
                    if($button_name=="cinema"){
                        $cinemaId=$firstId;
                        $cinema=$this->helper->helpGetCinemaById($cinemaId);
                        $analytics=$this->helper->helpPurchasesByCinema($cinema,$date_start,$date_end);
                        require_once(VIEWS_PATH."show-cinema-analytics.php");
                    }elseif($button_name=="movie"){
                        $movieId=$firstId;
                        $movie=$this->helper->helpMovieById($movieId);
                        $analytics=$this->helper->helpPurchasesByMovie($movie,$date_start,$date_end);
                        require_once(VIEWS_PATH."show-movie-analytics.php");
                    }
                }else{
                    $this->Message("Date Error", FRONT_ROOT."User/ShowAnalytics");
                }
        }


        public function SendCreateMail(User $user){
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
            //Server settings
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'trabajofinallab4@gmail.com';                     // SMTP username
            $mail->Password   = 'Laboratorio4UTN2019';                              // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('trabajofinallab4@gmail.com', 'CinemaTek');
            $mail->addAddress($user->getEmail());     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Welcome to CinemaTek!';
            $mail->Body    = 'Hello a new account has been created with this email:' .$user->getEmail(). '. <br> Thanks for choosing us!';
            $mail->AltBody = 'Hello a new account has been created with this email. Thanks for choosing us!';

            $mail->send();

            } catch (MailerException $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }

        public function Message($message,$location){
            require_once(VIEWS_PATH."message.php");
        }
}
?>