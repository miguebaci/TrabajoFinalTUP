<?php
    namespace DAO;

    use DAO\IPurchaseDAO as IPurchaseDAO;
    use Models\Purchase as Purchase;
    use Models\Ticket as Ticket;
    use DAO\Connection as Connection;
    use Helper\PurchaseHelper as Helper;

    class PurchaseDAO implements IPurchaseDAO
    {
        private $connection;
        private $tableName="purchase";
        private $ticketTable="ticket";
        private $helper;

        public function __construct(){
            $this->helper=new Helper();
        }

        /*
         * Recieves a Cinema with its Room, Function, and Movie
         * Generates the Purchase with its Ticket, and adds them both to the Database
         * Returns the Purchase object
         */

        public function Buy($cinema,$discount,$quantity){
            $purchase=new Purchase(date("Y-m-d H:i:s"),$cinema->getTicketPrice()*$quantity,$quantity,$discount);
            $purchase->setTicket($this->CreateTicket($purchase,$cinema));
            $purchase->setIdPurchase($this->Add($purchase,$_SESSION["loggedUser"]));
            return $purchase;
        }

        /*
         * Recieves the Purchase info and the Cinema with its Room, Function, and Movie
         * Generates a Ticket and adds it to the Database
         * And returns the Ticket
         */

        public function CreateTicket($purchase,$cinema){
            $ticket= new Ticket();
            $ticket->setQR($this->CreateQR($cinema,$purchase->getTicketQuantity()));
            $ticket->setMovieFunction($cinema->getCinemaRoomList()[0]->getFunctionList()[0]);
            $ticket->setTicketNumber($this->AddTicket($ticket));
            return $ticket;
        }

        /*
         * Recieves the Cinema with its Room, Function, and Movie, and the quantity of Tickets.
         * Generates the link to the image of the QR code
         * Returns the QR
         */

        public function CreateQR($cinema,$quantity){
            $room=$cinema->getCinemaRoomList()[0];
            $function=$room->getFunctionList()[0];
            $movie=$function->getMovie();
            $QR="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$cinema->getCinemaName()."/".$cinema->getIdCinema()."/".$room->getRoomName()."/".$room->getIdCinemaRoom()."/".$function->getIdFunction()."/".$function->getDate()."/".$function->getTime()."/".$quantity."/".$movie->getMovieName()."/".$movie->getIdMovie()."&choe=UTF-8";
            $QR=str_replace(" ","-",$QR);
            return $QR;
        }

        /*
         * Recieves the Purchase Info with its Ticket
         * Adds the Purchase to the Database
         * Returns the ID in the Database of the Purchase
         */

        public function Add($purchase,$user){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idUser, idTicket, ticketQuantity, total, discount, purchaseDate) 
                            VALUES (:idUser, :idTicket, :ticketQuantity, :total, :discount, :purchaseDate);";
                
                $parameters["idUser"]=$user->getIdUser();
                $parameters["idTicket"]=$purchase->getTicket()->getTicketNumber();
                $parameters["ticketQuantity"]=$purchase->getTicketQuantity();
                $parameters["total"]=$purchase->getTotal();
                $parameters["discount"]=$purchase->getDiscount();
                $parameters["purchaseDate"]=$purchase->getPurchase_date();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                $query="SELECT LAST_INSERT_ID()";

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query);

                return $resultSet[0][0];
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        /*
         * Recieves a Ticket
         * Adds it to the Database
         * Returns its ID in the Database
         */

        public function AddTicket($ticket){
            try
            {
                $query = "INSERT INTO ".$this->ticketTable." (idMovieFunction, QR) 
                            VALUES (:idMovieFunction, :QR);";
                

                $parameters["idMovieFunction"]=$ticket->getMovieFunction()->getIdFunction();
                $parameters["QR"]=$ticket->getQR();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                //$query="SELECT idPurchase FROM ".$this->tableName." WHERE idTicket = :idTicket";
                $query="SELECT LAST_INSERT_ID()";

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query);

                return $resultSet[0][0];
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }        

        /*
         * Recieves an User
         * Checks the purchases in the Database
         * And returns the purchase list
         */

        public function bringUserPurchases($user){
            try
            {
                $query="SELECT * 
                FROM ".$this->tableName." P 
                JOIN ".$this->ticketTable." T 
                ON P.idTicket=T.idTicket 
                WHERE P.idUser= :idUser";

                $parameters["idUser"]=$user->getIdUser();

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query, $parameters);

                $purchaseList=array();

                foreach ($resultSet as $row ) {
                    $purchase=new Purchase($row["purchaseDate"], $row["total"], $row["ticketQuantity"], $row["discount"]);
                    $purchase->setIdPurchase($row["idPurchase"]);
                    $ticket=new Ticket();
                    $ticket->setTicketNumber($row["idTicket"]);
                    $ticket->setQR($row["QR"]);
                    $ticket->setMovieFunction($this->helper->helpFunctionById($row["idMovieFunction"]));
                    $purchase->setTicket($ticket);
                    array_push($purchaseList,$purchase);
                }

                return $purchaseList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        /*
         * Recieves a cinema, and a first date and a last date
         * Checks in the database the sells in money and tickets
         * And returns them
         */

        public function getPurchasesByCinema($cinema, $dateStart, $dateEnd){
            try{
                $dateEnd=$dateEnd." 23:59:59"; 

                $query="SELECT SUM(P.total - (P.discount * P.total / 100)) as Total, SUM(P.ticketQuantity) as Tickets 
                FROM ".$this->tableName." P 
                JOIN ".$this->ticketTable." T 
                ON T.idTicket=P.idTicket
                JOIN moviefunction MD 
                ON MD.idMovieFunction=T.idMovieFunction 
                JOIN room R 
                ON R.idRoom=MD.idRoom 
                JOIN cinema C 
                ON C.idCinema=R.idCinema 
                WHERE C.idCinema = :idCinema AND (P.purchaseDate >= :dateStart AND P.purchaseDate <= :dateEnd) 
                GROUP BY C.idCinema;";

                $parameters["idCinema"]=$cinema->getIdCinema();
                $parameters["dateStart"]=$dateStart;
                $parameters["dateEnd"]=$dateEnd;

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query, $parameters);

                if(isset($resultSet[0])){
                    $purchase["Total"]=$resultSet[0]["Total"];
                    $purchase["Tickets"]=$resultSet[0]["Tickets"];
                }else{
                    $purchase["Total"]=0;
                    $purchase["Tickets"]=0;
                }

                return $purchase;

            }catch(Exception $ex){
                throw $ex;
            }
        }

        /*
         * Recieves a movie, and a first date and a last date
         * Checks in the database the sells in money and tickets
         * And returns them
         */

        public function getPurchasesByMovie($movie, $dateStart, $dateEnd){
            try{
                $dateEnd=$dateEnd." 23:59:59"; 

                $query="SELECT SUM(P.total - (P.discount * P.total / 100)) as Total, SUM(P.ticketQuantity) as Tickets 
                FROM ".$this->tableName." P 
                JOIN ".$this->ticketTable." T 
                ON T.idTicket=P.idTicket
                JOIN moviefunction MD 
                ON MD.idMovieFunction=T.idMovieFunction 
                JOIN Movie M 
                ON M.idMovie=MD.idMovie 
                WHERE M.idMovie = :idMovie AND (P.purchaseDate >= :dateStart AND P.purchaseDate <= :dateEnd) 
                GROUP BY M.idMovie;";

                $parameters["idMovie"]=$movie->getIdMovie();
                $parameters["dateStart"]=$dateStart;
                $parameters["dateEnd"]=$dateEnd;

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query, $parameters);

                if(isset($resultSet[0])){
                    $purchase["Total"]=$resultSet[0]["Total"];
                    $purchase["Tickets"]=$resultSet[0]["Tickets"];
                }else{
                    $purchase["Total"]=0;
                    $purchase["Tickets"]=0;
                }

                return $purchase;

            }catch(Exception $ex){
                throw $ex;
            }
        }

        /*
         * Recieves a Movie Function
         * Gets the remaining tickets for that function from the database
         * Returns the remaining tickets
         */

        public function GetRemainingTickets($function){
            try{

                $query="SELECT (R.totalCap-SUM(P.ticketQuantity)) 
                FROM ".$this->tableName." P 
                JOIN ".$this->ticketTable." T
                ON P.idTicket=T.idTicket 
                JOIN moviefunction MF 
                ON T.idMovieFunction=MF.idMovieFunction
                JOIN room R 
                ON MF.idRoom=R.idRoom 
                WHERE MF.idMovieFunction= :idMovieFunction 
                GROUP BY MF.idMovieFunction;";

                $parameters["idMovieFunction"]=$function->getIdFunction();

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query, $parameters);

                $remainingTickets=$resultSet[0][0];
                
                return $remainingTickets;

            }catch(Exception $ex){
                throw $ex;
            }
        }

    }
?>