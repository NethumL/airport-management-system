<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/BookingManager.php";
require_once __DIR__ . "/../models/FlightManager.php";

class home extends Controller
{
    public function index()
    {
        session_start();

        $data = [];

        if (isset($_SESSION['user'])) {
            $this->checkAuth("home/index", function() {
                return false;
            });

            $data = $this->getViewData();
            $user = $_SESSION["user"];

            if ($user["userType"] === "CUSTOMER") {
                $data["bookings"] = BookingManager::getBookingBy($user["email"]);
            } else if (in_array($_SESSION["user"]["userType"], ["EMPLOYEE", "MANAGER"], true)) {
                $startDate = date("Y-m-d");

                $date = date_create($startDate);
                date_add($date,date_interval_create_from_date_string("3 days"));
                $endDate =  date_format($date,"Y-m-d");

                $data["flights"] = FlightManager::getFlightsBy("", "", $startDate, $endDate);
            }

        }

        $this->showView("home/index", $data);
    }
}
