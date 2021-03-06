<?php
    namespace Controllers;

    use Models\Purchase as Purchase;
    use DAO\PurchaseDAO as PurchaseDAO;
    use Helper\PurchaseHelper as Helper;
    use Mailer\PHPMailer as PHPMailer;
    use Mailer\Exception as MailerException;

    class PurchaseController
    {
        private $purchaseDAO;
        private $helper;

        public function __construct()
        {
            $this->purchaseDAO = new PurchaseDAO();
            $this->helper = new Helper();
        }

        public function ShowBuyView($functionId){
                require_once(VIEWS_PATH."validate-session.php");
                $function=$this->helper->helpFunctionById($functionId);
                $remainingTickets=$this->helper->helpGetRemainingTickets($function);
                $ticketPrice=$this->purchaseDAO->getFunctionTicketPrice($function);
                require_once(VIEWS_PATH."buy-select.php");
        }

        public function Buy($quantity,$functionId){
            require_once(VIEWS_PATH."validate-session.php");
                $discount=0;
                $function=$this->helper->helpFunctionById($functionId);
                $date=date("l", strtotime($function->getDate()));
                $cinema=$this->helper->helpCinemaByFunction($function);
                if($date=="Tuesday" || $date=="Wednesday"){
                    if($quantity >= 2){
                        $discount=25;
                    }
                }
                $purchase=new Purchase(date("Y-m-d H:i:s"),$cinema->getTicketPrice()*$quantity,$discount,$_SESSION["loggedUser"]);
                $purchase->setIdPurchase($this->purchaseDAO->Add($purchase));
                $tickets=$this->purchaseDAO->CreateTicket($purchase,$cinema,$quantity);
                foreach($tickets as $ticket){
                    $ticket->setTicketNumber($this->purchaseDAO->AddTicket($ticket,$purchase));
                }
                $purchase->setTickets($tickets);
                $email=$purchase->getUser()->getEmail();
                $this->SendBuyMail($tickets, $email);
                require_once(VIEWS_PATH."show-qr.php");
        }

        public function SendBuyMail($tickets, $email){
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            $images=array();
            foreach ($tickets as $ticket) {
                $image = $ticket->getQR();
                $image = file_get_contents($image);
                array_push($images,$image);
            }
        
            $body = 'We have sent you a QR code, present it at the Cinema. <br> Thanks for choosing us!<p><img src="cid:qrcode" /></p>';
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
            $mail->addAddress($email);     // Add a recipient

            // Attachments
            $i=1;
            foreach($images as $image){
                $mail->addStringEmbeddedImage($image,'qrcode'.$i,'qrcode'.$i.'.jpg');         // Add attachments
                $i++;
            }

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Thanks for your purchase!';
            $mail->Body    = $body;
            $mail->AltBody = $body;

            $mail->send();

            } catch (MailerException $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }
    }
?>