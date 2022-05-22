<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/UserManager.php";
require_once __DIR__ . "/../models/FlightManager.php";

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

    private function validate_flight_details($details): bool
    {
        if (strlen($details["airline"]) < 1)
            return false;
        if (!ctype_digit($details["begin"]) || !ctype_digit($details["end"]))
            return false;
        return true;
    }
}
