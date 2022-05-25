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

            if (isset($_POST["name"])) {
                $name = $_POST["name"];
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
                    $user = UserManager::getUserDetails($userDetails["email"]);
                    $_SESSION["user"] = $user;
                    create_flash_message("account/edit", "Update successful.", FLASH_SUCCESS);
                } else {
                    create_flash_message("account/edit", "Update unsuccessful.", FLASH_ERROR);
                }

            } else {
                create_flash_message("account/edit", "Provide a name.", FLASH_ERROR);
            }

            redirectRelative("account/edit");
        }
    }

}
