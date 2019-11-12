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

        public function Buy(){
            if($_POST){
                $cinema=$this->functionDAO->GetCinemaByFunction($this->functionDAO->GetById($_POST["idMovieFunction"]));
                $purchase=$this->purchaseDAO->Buy($cinema,$_POST["discount"],$_POST["quantity"]);
                require_once(VIEWS_PATH."show-qr.php");
            }
        }
    }
?>