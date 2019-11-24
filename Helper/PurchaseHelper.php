<?php
    namespace Helper;
    //implementar en Controller y daos

    use DAO\FunctionDAO as FunctionDAO;
    use Models\MovieFunction as MovieFunction;
    use DAO\UserDAO as UserDAO;

    class PurchaseHelper{
        private $functionDAO;

        public function __construct(){
            $this->functionDAO=new FunctionDAO();
            $this->userDAO= new UserDAO();
        }

        function getFunctionDAO(){
            return $this->functionDAO;
        }

        function helpFunctionById($idFunction){
            return $this->functionDAO->getById($idFunction);
        }

        function helpCinemaByFunction($movieFunction){
            return $this->functionDAO->GetCinemaByFunction($movieFunction);
        }

        function helpUserById($id){
            return $this->userDAO->GetUserById($id);
        }

        function helpGetRemainingTickets($function){
            return $this->functionDAO->GetRemainingTickets($function);
        }
    
    }
?>