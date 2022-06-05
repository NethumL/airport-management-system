<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/UserManager.php";
require_once __DIR__ . "/../models/FlightManager.php";
require_once __DIR__ . "/../models/AirportManager.php";
require_once __DIR__ . "/../models/SeatManager.php";
require_once __DIR__ . "/../models/BookingManager.php";
require_once __DIR__ . "/../models/PaymentManager.php";

class flight extends Controller
{
    const FIELDS = [
        "airline",
        "begin",
        "end",
        "departureDateTime",
        "arrivalDateTime",
        "economyClassPrice",
        "businessClassPrice",
        "status"
    ];
    const PAYMENT_FIELDS = ["creditCardNumber"];

    public function index(string $id = "")
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $data = $this->getViewData();
            $data["airports"] = AirportManager::getAllAirports();
            if (!empty($id)) {
                $flight = FlightManager::getFlight($id);
                if ($flight) {
                    $data["flight"] = $flight;
                } else {
                    redirectRelative("flight/index");
                }
            }
            $this->showView("flight/index", $data);
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->checkAuth("flight/index", function () {
            });
            if (!in_array($_SESSION["user"]["userType"], ["EMPLOYEE", "MANAGER"], true)) {
                http_response_code(403);
                die;
            }

            $flightDetails = filterArrayByKeys($_POST, self::FIELDS);

            $undefinedFields = getUnsetKeys($flightDetails, self::FIELDS);

            if (!empty($undefinedFields)) {
                http_response_code(400);
                die;
            }

            if (!$this->validate_flight_details($flightDetails)) {
                http_response_code(400);
                die;
            }

            $result = FlightManager::editFlight(
                $id,
                $flightDetails["airline"],
                $flightDetails["begin"],
                $flightDetails["end"],
                $flightDetails["departureDateTime"],
                $flightDetails["arrivalDateTime"],
                $flightDetails["economyClassPrice"],
                $flightDetails["businessClassPrice"],
                $flightDetails["status"]
            );
            if ($result) {
                $response = FlightManager::getFlight($id);
                echo json_encode($response);
            } else {
                http_response_code(500);
                die;
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $this->checkAuth("flight/index", function () {
            });
            if ($_SESSION["user"]["userType"] != "EMPLOYEE" and $_SESSION["user"]["userType"] != "MANAGER") {
                http_response_code(403);
                die;
            }

            if (empty($id)) {
                http_response_code(400);
                die;
            }

            $result = FlightManager::getFlight($id);
            if (!$result) {
                http_response_code(404);
            }

            $result = FlightManager::deleteFlight($id);
            if (!$result) {
                http_response_code(400);
                die;
            }
        }
    }

    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $result = FlightManager::getFlightsBy(
                $_GET["from"],
                $_GET["to"],
                status: $_GET["status"]
            );
            if ($result !== false) {
                echo json_encode($result);
            } else {
                http_response_code(500);
                die;
            }
        }
    }

    public function new()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->checkAuth("flight/new", function () {
                if (!in_array($_SESSION["user"]["userType"], ["EMPLOYEE", "MANAGER"], true)) {
                    redirectRelative("home/index");
                }

                $data = $this->getViewData();
                $airports = AirportManager::getAllAirports();
                $data["airports"] = $airports;

                return $data;
            });
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->checkAuth("flight/new", function () {
            });
            if (!in_array($_SESSION["user"]["userType"], ["EMPLOYEE", "MANAGER"], true)) {
                redirectRelative("home/index");
            }

            $flightDetails = filterArrayByKeys($_POST, self::FIELDS);

            $undefinedFields = getUnsetKeys($flightDetails, array_filter(self::FIELDS, function ($field) {
                return $field != "status";
            }));

            if (!empty($undefinedFields)) {
                create_flash_message("flight/new", "All fields are required.", FLASH_ERROR);
                redirectRelative("flight/new");
            }

            if (!$this->validate_flight_details($flightDetails)) {
                create_flash_message("flight/new", "Fix invalid fields.", FLASH_ERROR);
                redirectRelative("flight/new");
            }

            $planeWidth = (int)$_ENV["PLANE_WIDTH"];
            $planeLength = (int)$_ENV["PLANE_LENGTH"];
            $result = FlightManager::addFlight(
                $flightDetails["airline"],
                $flightDetails["begin"],
                $flightDetails["end"],
                $flightDetails["departureDateTime"],
                $flightDetails["arrivalDateTime"],
                $flightDetails["economyClassPrice"],
                $flightDetails["businessClassPrice"],
                "SCHEDULED",
                $planeWidth,
                $planeLength
            );

            if ($result) {
                create_flash_message("flight/new", "Flight added successfully.", FLASH_SUCCESS);
            } else {
                create_flash_message("flight/new", "Something went wrong.", FLASH_ERROR);
            }
            redirectRelative("flight/new");
        }
    }

    public function view(string $id)
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $data = $this->getViewData();

            $flight = FlightManager::getFlight($id);
            if (!$flight) {
                redirectRelative("flight/index");
            }
            $data["flight"] = $flight;
            $this->showView("flight/view", $data);
        }
    }

    public function book(string $id)
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->checkAuth("flight/book", function ($id) {
                if ($_SESSION["user"]["userType"] != "CUSTOMER") {
                    redirectRelative("home/index");
                }
                $data = $this->getViewData();

                $flight = FlightManager::getFlight($id);
                $seats = SeatManager::getSeatsBy($id);
                if ($flight && $seats) {
                    $data["flight"] = $flight;
                    $data["seats"] = $seats;
                } else {
                    redirectRelative("home/index");
                }

                return $data;
            }, [$id]);
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->checkAuth("flight/book", function () {
            });
            if ($_SESSION["user"]["userType"] != "CUSTOMER") {
                redirectRelative("home/index");
            }

            $flight = FlightManager::getFlight($id);
            if (!$flight) {
                redirectRelative("flight/index");
            }

            $bookedSeats = [];
            foreach ($_POST as $key => $value) {
                if (str_starts_with($key, "seat-")) {
                    $seatId = substr($key, 5);
                    $result = SeatManager::getSeat($seatId);
                    if (!$result || $result["isBooked"]) {
                        redirectRelative("flight/book/$seatId");
                    }
                    $bookedSeats[] = $seatId;
                }
            }

            $bookingId = BookingManager::bookFlight($id, 0, $_SESSION["user"]["email"], $bookedSeats);

            if ($bookingId) {
                foreach ($bookedSeats as $seat) {
                    SeatManager::updateBookingStatus($seat, 1);
                }
                create_flash_message("flight/pay", "Booking placed successfully.", FLASH_SUCCESS);
                redirectRelative("flight/pay/$bookingId");
            } else {
                create_flash_message("flight/book", "Something went wrong.", FLASH_ERROR);
                redirectRelative("flight/book/$bookingId");
            }
        }
    }

    public function pay(string $id)
    {
        session_start();
        $this->checkAuth("flight/pay", function () {
            return false;
        });
        if ($_SESSION["user"]["userType"] != "CUSTOMER") {
            redirectRelative("home/index");
        }

        $booking = BookingManager::getBooking($id);
        if (!$booking || $booking["email"] != $_SESSION["user"]["email"]) {
            redirectRelative("home/index");
        }
        $flight = FlightManager::getFlight($booking["flightNumber"]);
        $seats = [];
        $amount = 0;
        foreach ($booking["seats"] as $seatId) {
            $seat = SeatManager::getSeat($seatId);
            $amount += $seat["class"] == "ECONOMY" ? $flight["economyClassPrice"] : $flight["businessClassPrice"];
            $seats[] = $seat;
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $data = $this->getViewData();

            $data["booking"] = $booking;
            $data["flight"] = $flight;
            $data["seats"] = $seats;
            $data["amount"] = $amount;

            $this->showView("flight/pay", $data);
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $paymentDetails = filterArrayByKeys($_POST, self::PAYMENT_FIELDS);

            $undefinedFields = getUnsetKeys($paymentDetails, self::PAYMENT_FIELDS);

            if (!empty($undefinedFields)) {
                create_flash_message("flight/pay", "All fields are required.", FLASH_ERROR);
                redirectRelative("flight/pay/$id");
            }

            if (!$this->validate_payment_details($paymentDetails)) {
                create_flash_message("flight/pay", "Fix invalid fields.", FLASH_ERROR);
                redirectRelative("flight/pay/$id");
            }

            $result = PaymentManager::addPayment(
                $paymentDetails["creditCardNumber"],
                $amount,
                $_SESSION["user"]["email"],
                $id,
            );
            if ($result) {
                BookingManager::updatePaidStatus($id, true);
                create_flash_message("home/index", "Payment successful", FLASH_SUCCESS);
                redirectRelative("home/index");
            } else {
                create_flash_message("flight/pay", "Something went wrong.", FLASH_ERROR);
                redirectRelative("flight/pay/$id");
            }
        }
    }

    private function validate_flight_details($details): bool
    {
        if (strlen($details["airline"]) < 1)
            return false;
        if (!ctype_digit($details["begin"]) || !ctype_digit($details["end"]))
            return false;
        return true;
    }

    private function validate_payment_details($details): bool
    {
        if (!ctype_digit($details["creditCardNumber"]))
            return false;
        return true;
    }
}
