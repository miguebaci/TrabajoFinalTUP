<?php
    namespace Controllers;

    use DAO\IPurchaseDAO as IPurchaseDAO;
    use DAO\PurchaseDAO as PurchaseDAO;
    use Models\Purchase as Purchase;
    use Helper\PurchaseHelper as Helper;

    class PurchaseController
    {
        private $purchaseDAO;
        private $helper;

        public function __construct()
        {
            $this->purchaseDAO = new PurchaseDAO();
            $this->helper = new Helper();
        }

        public function ShowBuyView(){
            if($_POST){
                require_once(VIEWS_PATH."validate-session.php");
                $function=$this->helper->helpFunctionById($_POST["buy_button"]);
                $remainingTickets=$this->purchaseDAO->GetRemainingTickets($function);
                require_once(VIEWS_PATH."buy-select.php");
            }
        }

        public function Buy(){
            require_once(VIEWS_PATH."validate-session.php");
            if($_POST){
                $discount=0;
                $cinema=$this->helper->helpCinemaByFunction($this->helper->helpFunctionById($_POST["buy_button"]));
                if(isset($_POST["discount"])){
                    if($_POST["discount"] == "BADU"){
                        $discount=10;
                    }
                }
                $purchase=$this->purchaseDAO->Buy($cinema,$discount,$_POST["quantity"]);
                require_once(VIEWS_PATH."show-qr.php");
            }
        }
    }
?>