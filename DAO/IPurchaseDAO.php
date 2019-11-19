<?php
    namespace DAO;
    use Models\Purchase as Purchase;
    interface IPurchaseDAO
    {
        function Buy($cinema,$discount,$quantity);
        function CreateTicket($purchase,$cinema);
        function CreateQR($cinema,$quantity);
        function Add($purchase,$user);
        function AddTicket($ticket);
        function bringUserPurchases($user);
        function getPurchasesByCinema($cinema, $dateStart, $dateEnd);
        function getPurchasesByMovie($movie, $dateStart, $dateEnd);
    }
?>