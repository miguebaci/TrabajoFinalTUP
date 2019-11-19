<?php
    namespace Controllers;

    use DAO\IPurchaseDAO as IPurchaseDAO;
    use DAO\PurchaseDAO as PurchaseDAO;
    use Models\Purchase as Purchase;
    use Helper\PurchaseHelper as Helper;

    use DAO\FunctionDAO as FunctionDAO;

    class PurchaseController
    {
        private $purchaseDAO;
        private $functionDAO;
        private $helper;

        public function __construct()
        {
            $this->purchaseDAO = new PurchaseDAO();
            $this->functionDAO = new FunctionDAO();
            $this->helper = new Helper();
        }

        public function ShowBuyView(){
            if($_POST){
                require_once(VIEWS_PATH."validate-session.php");
                $idFunction=$_POST["buy_button"];
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