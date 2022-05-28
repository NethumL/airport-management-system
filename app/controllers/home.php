<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/BookingManager.php";
require_once __DIR__ . "/../models/FlightManager.php";
require_once __DIR__ . "/../models/SeatManager.php";

class home extends Controller
{
    public function index()
    {
        session_start();

        if (isset($_SESSION['user'])) {
            $this->checkAuth("home/index", function () {
                $data = $this->getViewData();
                $user = $_SESSION["user"];

                if ($user["userType"] === "CUSTOMER") {
                    $result = BookingManager::getBookingBy($user["email"]);
                    $bookings = [];
                    foreach ($result as $booking) {
                        $flight = FlightManager::getFlight($booking["flightNumber"]);
                        $seats = [];
                        foreach ($booking['seats'] as $seatId) {
                            $seats[] = SeatManager::getSeat($seatId);
                        }
                        $bookings[] = [...$booking, "flight" => $flight, "seats" => $seats];
                    }
                    $data["bookings"] = $bookings;
                }
                return $data;
            });
        }

        $data = $this->getViewData();

        $startDate = date("Y-m-d");

        $date = date_create($startDate);
        date_add($date, date_interval_create_from_date_string("3 days"));
        $endDate = date_format($date, "Y-m-d");

        $data["flights"] = FlightManager::getFlightsBy("", "", $startDate, $endDate);

        $this->showView("home/index", $data);
    }
}
