<?php
    namespace DAO;
    use Models\Purchase as Purchase;
    interface IPurchaseDAO
    {
        function CreateTicket($purchase,$cinema,$quantity);
        function CreateQR($cinema,$purchase);
        function Add($purchase);
        function AddTicket($ticket, $purchase);
        function bringUserPurchases($user);
        function getPurchasesByCinema($cinema, $dateStart, $dateEnd);
        function getPurchasesByMovie($movie, $dateStart, $dateEnd);
    }
?>