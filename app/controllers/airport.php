<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/AirportManager.php";

class airport extends Controller
{
    public function new()
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->checkAuth("airport/new", function () {
                if (!in_array($_SESSION["user"]["userType"], ["MANAGER", "EMPLOYEE"], true)) {
                    redirectRelative("home/index");
                }
                return $this->getViewData();
            });
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->checkAuth("airport/new", function () {
                if (!in_array($_SESSION["user"]["userType"], ["MANAGER", "EMPLOYEE"], true)) {
                    redirectRelative("home/index");
                }
            });

            $name = $_POST["name"];

            if (empty($name)) {
                create_flash_message("airport/new", "Name is required.", FLASH_ERROR);
                redirectRelative("airport/new");
            }

            if (strlen($name) < 1) {
                create_flash_message("airport/new", "Name is invalid.", FLASH_ERROR);
                redirectRelative("airport/new");
            }

            $result = AirportManager::registerAirport($name);

            if ($result)
                create_flash_message("airport/new", "Airport added successfully.", FLASH_SUCCESS);
            else
                create_flash_message("airport/new", "Something went wrong", FLASH_ERROR);

            redirectRelative("airport/new");
        }
    }

    public function edit(string $id = "")
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->checkAuth("airport/edit", function () {
                return false;
            });

            if (!in_array($_SESSION["user"]["userType"], ["MANAGER", "EMPLOYEE"], true)) {
                redirectRelative("home/index");
            }

            $data = $this->getViewData();

            if (!empty($id)) {
                $airport = AirportManager::getAirport($id);

                if ($airport)
                    $data["airport"] = $airport;
                else {
                    redirectRelative("airport/edit");
                }
            }

            $this->showView("airport/edit", $data);
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->checkAuth("airport/edit", function () {
                if (!in_array($_SESSION["user"]["userType"], ["MANAGER", "EMPLOYEE"], true)) {
                    http_response_code(403);
                    die;
                }
            });

            if (empty($id)) {
                http_response_code(400);
                die();
            }

            $result = AirportManager::getAirport($id);
            if (!$result) {
                http_response_code(404);
                die();
            }

            $name = $_POST["name"];

            if (empty($name) || strlen($name) < 1) {
                http_response_code(400);
                die();
            }

            $result = AirportManager::updateAirport($id, $name);

            if ($result) {
                $response = AirportManager::getAirport($id);
                echo json_encode($response);
            } else {
                http_response_code(500);
                die();
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $this->checkAuth("airport/edit", function () {
                if (!in_array($_SESSION["user"]["userType"], ["MANAGER", "EMPLOYEE"], true)) {
                    http_response_code(403);
                    die();
                }
                return $this->getViewData();
            });

            if (empty($id)) {
                http_response_code(400);
                die();
            }

            $result = AirportManager::getAirport($id);
            if (!$result) {
                http_response_code(404);
                die();
            }

            $result = AirportManager::removeAirport($id);
            if (!$result) {
                http_response_code(400);
                die();
            }
        }
    }

    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $name = $_GET["name"];

            $result = AirportManager::getAirportsBy($name);
            if ($result !== false) {
                echo json_encode($result);
            } else {
                http_response_code(500);
                die;
            }
        }
    }
}
