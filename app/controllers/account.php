<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/UserManager.php";

class account extends Controller {

    public function view() {
        session_start();
        $this->checkAuth("account/view", function () {
            if (!isset($_SESSION["user"])) {
                redirectRelative("auth/login");
            }
            return $this->getViewData();
        });
    }

    public function edit() {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->checkAuth("account/edit", function () {
                return $this->getViewData();
            });

        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->checkAuth("account/edit", function () {
                return false;
            });

            $name = $_POST["name"];
            if (isset($name)) {
                if (strlen($name) < 1) {
                    create_flash_message("account/edit", "Provide a valid name.", FLASH_ERROR);
                    redirectRelative("account/edit");
                }

                $userDetails = filterArrayByKeys($_SESSION["user"], ["email", "userType"]);

                $result = UserManager::updateUser(
                    $userDetails["email"],
                    $name,
                    $userDetails["userType"]
                );

                if ($result) {
                    $response = UserManager::getUserDetails($userDetails["email"]);
                    $_SESSION["user"] = $response;
                    echo json_encode($response);
                } else {
                    http_response_code(500);
                    die();
                }

            } else {
                create_flash_message("account/edit", "Provide a name.", FLASH_ERROR);
                redirectRelative("account/edit");
            }
        }
    }

}
