<?php
    namespace DAO;

    use DAO\IPurchaseDAO as IPurchaseDAO;
    use Models\Purchase as Purchase;
    use Models\Ticket as Ticket;
    use DAO\Connection as Connection;
    use Helper\PurchaseHelper as Helper;
    use \Exception as Exception;

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
         * Recieves the Purchase info and the Cinema with its Room, Function, and Movie
         * Generates a Ticket and adds it to the Database
         * And returns the Ticket
         */

        public function CreateTicket($purchase,$cinema,$quantity){
            $tickets=array();
            for($i=0;$i<$quantity;$i++){
                $ticket= new Ticket();
                $ticket->setQR($this->CreateQR($cinema,$purchase,$i+1));
                $ticket->setMovieFunction($cinema->getCinemaRoomList()[0]->getFunctionList()[0]);
                array_push($tickets,$ticket);
            }
            return $tickets;
        }

        /*
         * Recieves the Cinema with its Room, Function, and Movie, and the quantity of Tickets.
         * Generates the link to the image of the QR code
         * Returns the QR
         */

        public function CreateQR($cinema,$purchase,$number){
            $room=$cinema->getCinemaRoomList()[0];
            $function=$room->getFunctionList()[0];
            $movie=$function->getMovie();
            $QR="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$cinema->getCinemaName()."/".$cinema->getIdCinema()."/".$room->getRoomName()."/".$room->getIdCinemaRoom()."/".$function->getIdFunction()."/".$function->getDate()."/".$function->getTime()."/".$purchase->getIdPurchase()."/".$movie->getMovieName()."/".$movie->getIdMovie()."/".$number."&choe=UTF-8";
            $QR=str_replace(" ","-",$QR);
            return $QR;
        }

        /*
         * Recieves the Purchase Info with its Ticket
         * Adds the Purchase to the Database
         * Returns the ID in the Database of the Purchase
         */

        public function Add($purchase){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idUser, total, discount, purchaseDate) 
                            VALUES (:idUser, :total, :discount, :purchaseDate);";
                
                $parameters["idUser"]=$purchase->getUser()->getIdUser();
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

        public function AddTicket($ticket, $purchase){
            try
            {
                $query = "INSERT INTO ".$this->ticketTable." (idMovieFunction, QR, idPurchase) 
                            VALUES (:idMovieFunction, :QR, :idPurchase);";
                

                $parameters["idMovieFunction"]=$ticket->getMovieFunction()->getIdFunction();
                $parameters["QR"]=$ticket->getQR();
                $parameters["idPurchase"]=$purchase->getIdPurchase();

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
         * Recieves an User
         * Checks the purchases in the Database
         * And returns the purchase list
         */

        public function bringUserPurchases($user){
            try
            {
                $query="SELECT * 
                FROM ".$this->tableName."  
                WHERE idUser= :idUser";

                $parameters["idUser"]=$user->getIdUser();

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query, $parameters);

                $purchaseList=array();

                foreach ($resultSet as $row ) {
                    $purchase=new Purchase($row["purchaseDate"], $row["total"], $row["discount"],$this->helper->helpUserById($row["idUser"]));
                    $purchase->setIdPurchase($row["idPurchase"]);

                    $query2="SELECT * 
                        FROM ".$this->ticketTable." T 
                        JOIN ".$this->tableName." P 
                        ON T.idPurchase=P.idPurchase 
                        WHERE T.idPurchase= :idPurchase;";

                    $parameters2["idPurchase"]=$purchase->getIdPurchase();

                    $this->connection = Connection::GetInstance();
        
                    $resultSet2=$this->connection->Execute($query2, $parameters2);

                    $tickets=array();

                    foreach($resultSet2 as $row2){
                        $ticket=new Ticket();
                        $ticket->setTicketNumber($row2["idTicket"]);
                        $ticket->setQR($row2["QR"]);
                        $ticket->setMovieFunction($this->helper->helpFunctionById($row2["idMovieFunction"]));
                        array_push($tickets,$ticket);
                    }

                    $purchase->setTickets($tickets);

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

                $query="SELECT SUM(P.total - (P.discount * P.total / 100))/COUNT(T.idTicket) as Total, COUNT(T.idTicket) as Tickets 
                FROM ".$this->tableName." P 
                JOIN ".$this->ticketTable." T 
                ON T.idPurchase=P.idPurchase
                JOIN moviefunction MD 
                ON MD.idMovieFunction=T.idMovieFunction 
                JOIN room R 
                ON R.idRoom=MD.idRoom 
                JOIN cinema C 
                ON C.idCinema=R.idCinema 
                WHERE C.idCinema = :idCinema AND (P.purchaseDate >= :dateStart AND P.purchaseDate <= :dateEnd) 
                GROUP BY P.idPurchase 
                ORDER BY P.idPurchase;";

                $parameters["idCinema"]=$cinema->getIdCinema();
                $parameters["dateStart"]=$dateStart;
                $parameters["dateEnd"]=$dateEnd;

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query, $parameters);

                $purchase["Total"]=0;
                $purchase["Tickets"]=0;
                foreach($resultSet as $row){
                    $purchase["Total"]+=$row["Total"];
                    $purchase["Tickets"]+=$row["Tickets"];
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

                $query="SELECT SUM(P.total - (P.discount * P.total / 100))/COUNT(T.idTicket) as Total, COUNT(T.idTicket) as Tickets 
                FROM ".$this->tableName." P 
                JOIN ".$this->ticketTable." T 
                ON T.idPurchase=P.idPurchase
                JOIN moviefunction MD 
                ON MD.idMovieFunction=T.idMovieFunction 
                JOIN Movie M 
                ON M.idMovie=MD.idMovie 
                WHERE M.idMovie = :idMovie AND (P.purchaseDate >= :dateStart AND P.purchaseDate <= :dateEnd) 
                GROUP BY P.idPurchase;";

                $parameters["idMovie"]=$movie->getIdMovie();
                $parameters["dateStart"]=$dateStart;
                $parameters["dateEnd"]=$dateEnd;

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query, $parameters);

                $purchase["Total"]=0;
                $purchase["Tickets"]=0;
                foreach($resultSet as $row){
                    $purchase["Total"]+=$row["Total"];
                    $purchase["Tickets"]+=$row["Tickets"];
                }

                return $purchase;

            }catch(Exception $ex){
                throw $ex;
            }
        }


        /*
         * Recieves a Movie Function
         * Gets the ticket price for that function from the database
         * Returns the ticket price
         */

        public function getFunctionTicketPrice($function){
            try{

                $query="SELECT C.TicketPrice 
                FROM moviefunction MF 
                JOIN room R 
                ON MF.idRoom=R.idRoom 
                JOIN cinema C 
                ON C.idCinema=R.idCinema 
                WHERE MF.idMovieFunction= :idMovieFunction;";

                $parameters["idMovieFunction"]=$function->getIdFunction();

                $this->connection = Connection::GetInstance();

                $resultSet=$this->connection->Execute($query, $parameters);

                $ticketPrice=$resultSet[0][0];
                
                return $ticketPrice;

            }catch(Exception $ex){
                throw $ex;
            }
        }

    }
?>