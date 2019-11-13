<?php
    namespace Controllers;

    use DAO\IPurchaseDAO as IPurchaseDAO;
    use DAO\PurchaseDAO as PurchaseDAO;
    use Models\Purchase as Purchase;

    use DAO\FunctionDAO as FunctionDAO;

    class PurchaseController
    {
        private $purchaseDAO;
        private $functionDAO;

        public function __construct()
        {
            $this->purchaseDAO = new PurchaseDAO();
            $this->functionDAO = new FunctionDAO();
        }

        public function ShowBuyView(){
            if($_POST){
                $idFunction=$_POST["buy_button"];
                require_once(VIEWS_PATH."buy-select.php");
            }
        }

        public function Buy(){
            if($_POST){
                $discount=0;
                $cinema=$this->functionDAO->GetCinemaByFunction($this->functionDAO->GetById($_POST["buy_button"]));
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