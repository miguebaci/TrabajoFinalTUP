<?php
    namespace Helper;
    //implementar en Controller y daos

    use DAO\FunctionDAO as FunctionDAO;
    use Models\MovieFunction as MovieFunction;

    class PurchaseHelper{
        private $functionDAO;

        public function __construct(){
            $this->functionDAO=new FunctionDAO();
        }

        function getFunctionDAO(){
            return $this->functionDAO;
        }

        function helpFunctionById($idFunction){
            $this->functionDAO->getById($idFunction);
        }

        function helpCinemaByFunction($movieFunction){
            return $this->functionDAO->GetCinemaByFunction($movieFunction);
        }
    }

?>