<?php
    namespace DAO;

    use DAO\IPurchaseDAO as IPurchaseDAO;
    use Models\Purchase as Purchase;
    use Models\Ticket as Ticket;
    use DAO\Connection as Connection;

    class PurchaseDAO // implements IPurchaseDAO
    {
        private $connection;
        private $tableName="purchase";
        private $ticketTable="ticket";

        public function Buy($cinema,$discount,$quantity){
            $purchase=new Purchase(date("Y-m-d h:i:sa"),$cinema->getTicketPrice()*$quantity,$quantity,$discount);
            $purchase->setTicket($this->CreateTicket($purchase,$cinema));
            $purchase->setIdPurchase($this->Add($purchase));
            return $purchase;

        }

        public function CreateTicket($purchase,$cinema){
            $ticket= new Ticket();
            $ticket->setQR($this->CreateQR($cinema));
            $ticket->setTicketNumber($this->AddTicket($ticket,$cinema->getCinemaRoomList()[0]->getFunctionList()[0]));
            return $ticket;
        }

        public function CreateQR($cinema){
            $room=$cinema->getCinemaRoomList()[0];
            $function=$room->getFunctionList()[0];
            $movie=$function->getMovie();
            $QR="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$cinema->getCinemaName()."-".$cinema->getIdCinema()."-".$room->getRoomName()."-".$room->getIdCinemaRoom()."-".$function->getIdFunction()."-".$function->getDate()."-".$function->getTime()."-".$movie->getMovieName()."-".$movie->getIdMovie()."&choe=UTF-8";
            $QR=str_replace(" ","",$QR);
            return $QR;
        }

        public function Add($purchase){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idUser, idTicket, ticketQuantity, total, discount, purchaseDate) 
                            VALUES (:idUser, :idTicket, :ticketQuantity, :total, :discount, :purchaseDate);";
                
                $parameters["idUser"]=$_SESSION["loggedUser"]->getIdUser();
                $parameters["idTicket"]=$purchase->getTicket()->getTicketNumber();
                $parameters["ticketQuantity"]=$purchase->getTicketQuantity();
                $parameters["total"]=$purchase->getTotal();
                $parameters["discount"]=$purchase->getDiscount();
                $parameters["purchaseDate"]=$purchase->getPurchase_date();

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

        public function AddTicket($ticket,$function){
            try
            {
                $query = "INSERT INTO ".$this->ticketTable." (idMovieFunction, QR) 
                            VALUES (:idMovieFunction, :QR);";
                
                $parameters["idMovieFunction"]=$function->getIdFunction();
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

    }
?>