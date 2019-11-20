<?php
    namespace Helper;
    
    use Models\CinemaRoom as CinemaRoom;
    use DAO\FunctionDAO as FunctionDAO;

    class RoomHelper{

        private $functionDAO;

        public function __construct()
        {   
            $this->functionDAO = new FunctionDAO();
        }

        function helpGetAllByRoom(CinemaRoom $room){
        return $this->functionDAO->GetAllByRoomIdAdmin($room);
        }
        function getFunctionDAO(){
            return $this->functionDAO;
        }
    }

?>