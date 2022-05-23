<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/UserManager.php";
require_once __DIR__ . "/../models/FlightManager.php";
require_once __DIR__ . "/../models/BookingManager.php";
require_once __DIR__ . "/../models/PaymentManager.php";

class flight extends Controller
{
    const FIELDS = [
        "airline",
        "begin",
        "end",
        "departureDate",
        "departureTime",
        "arrivalDate",
        "arrivalTime",
        "economyClassPrice",
        "businessClassPrice",
        "status"
    ];
    const PAYMENT_FIELDS = ["creditCardNumber", "paidAmount"];

    public function index(string $id = "")
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $data = $this->getViewData();
            if (empty($id)) {
                $data["flights"] = FlightManager::getAllFlights();
            } else {
                $flight = FlightManager::getFlight($id);
                if ($flight) {
                    $data["flight"] = $flight;
                } else {
                    http_response_code(404);
                    die;
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

            $flightDetails["departureDateTime"] = mergeDateTime($flightDetails["departureDate"], $flightDetails["departureTime"]);
            $flightDetails["arrivalDateTime"] = mergeDateTime($flightDetails["arrivalDate"], $flightDetails["arrivalTime"]);

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
            $filterFields = filterArrayByKeys($_GET, self::FIELDS);

            $result = FlightManager::getFlightsBy(
                $filterFields["begin"],
                $filterFields["end"],
                $filterFields["departureDate"],
                $filterFields["arrivalDate"],
                $filterFields["economyClassPrice"],
                $filterFields["businessClassPrice"],
                $filterFields["status"]
            );
            if ($result) {
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
                return $this->getViewData();
            });
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            $this->checkAuth("flight/new", function () {
            });
            if (!in_array($_SESSION["user"]["userType"], ["EMPLOYEE", "MANAGER"], true)) {
                redirectRelative("home/index");
            }

            $flightDetails = filterArrayByKeys($_POST, self::FIELDS);

            $undefinedFields = getUnsetKeys($flightDetails, self::FIELDS);

            if (!empty($undefinedFields)) {
                create_flash_message("flight/new", "All fields are required.", FLASH_ERROR);
                redirectRelative("flight/new");
            }

            if (!$this->validate_flight_details($flightDetails)) {
                create_flash_message("flight/new", "Fix invalid fields.", FLASH_ERROR);
                redirectRelative("flight/new");
            }

            $flightDetails["departureDateTime"] = mergeDateTime($flightDetails["departureDate"], $flightDetails["departureTime"]);
            $flightDetails["arrivalDateTime"] = mergeDateTime($flightDetails["arrivalDate"], $flightDetails["arrivalTime"]);

            $result = FlightManager::addFlight(
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
            $this->checkAuth("flight/view", function (string $id) {
                $data = $this->getViewData();

                $flight = FlightManager::getFlight($id);
                if (!$flight) {
                    redirectRelative("flight/index");
                }
                $data["flight"] = $flight;
                return $data;
            }, [$id]);
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

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $data = $this->getViewData();

            $data["booking"] = $booking;

            $this->showView("flight/pay", $data);
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
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
                $paymentDetails["paidAmount"],
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