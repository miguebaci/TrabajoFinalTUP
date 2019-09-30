<?php
    namespace Controllers;

    use Repositories\CinemaRepository as CinemaRepository;
    use Models\Cinema as Cinema;

    class CinemaController
    {
        private $cinemaRepository;

        public function __construct()
        {
            $this->cinemaRepository = new CinemaRepository();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."cinema-add.php");
        }

        public function ShowListView()
        {
            $cinemaList = $this->cinemaRepository->GetAll();

            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function Add($recordId, $firstName, $lastName)
        {
            $cinema = new Cinema();
            $cinema->setCinemaName($cinemaName);
            $cinema->setadress($adress);
            $cinema->setTotalCap($totalCap);
            $cinema->setTicketPrice($ticketPrice);

            $this->cinemaRepository->Add($cinema);

            $this->ShowAddView();
        }
    }
?>