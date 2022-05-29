<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/UserManager.php";

class admin extends Controller {

    const FIELDS = [
        "email",
        "name",
        "password",
        "userType"
    ];

    public function new() {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->checkAuth("admin/new", function () {
                if ($_SESSION["user"]["userType"] !== "MANAGER") {
                    redirectRelative("home/index");
                }
                return $this->getViewData();
            });
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->checkAuth("admin/new", function() {
                if ($_SESSION["user"]["userType"] !== "MANAGER") {
                    redirectRelative("home/index");
                }
            });

            $userDetails = filterArrayByKeys($_POST, self::FIELDS);
            $undefinedFields = getUnsetKeys($userDetails, self::FIELDS);

            if (!empty($undefinedFields)) {
                create_flash_message("admin/new", "All fields are required.", FLASH_ERROR);
                redirectRelative("admin/new");
            }

            if (!$this->validate_user_details($userDetails)) {
                create_flash_message("admin/new", "Fix invalid fields.", FLASH_ERROR);
                redirectRelative("admin/new");
            }

            if (UserManager::getUserDetails($userDetails["email"]) !== false) {
                create_flash_message("admin/new", "Email already registered.", FLASH_ERROR);
                redirectRelative("admin/new");
            }

            $result = UserManager::registerUser(
                $userDetails["email"],
                $userDetails["name"],
                $userDetails["password"],
                $userDetails["userType"]
            );

            if ($result)
                create_flash_message("admin/new", "User registered successfully.", FLASH_SUCCESS);
            else
                create_flash_message("admin/new", "Something went wrong", FLASH_ERROR);

            redirectRelative("admin/new");
        }
    }

    public function edit(string $email = "") {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->checkAuth("admin/edit", function () {
                return false;
            });

            if ($_SESSION["user"]["userType"] !== "MANAGER") {
                redirectRelative("home/index");
            }

            $data = $this->getViewData();

            if (!empty($email)) {
                $user = UserManager::getUserDetails($email);

                if ($user)
                    $data["showUser"] = $user;
                else
                    redirectRelative("admin/edit");
            }

            $this->showView("admin/edit", $data);

        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->checkAuth("admin/edit", function () {
                if ($_SESSION["user"]["userType"] !== "MANAGER") {
                    http_response_code(403);
                    die;
                }
            });

            if (empty($email)) {
                http_response_code(400);
                die();
            }

            $email = urldecode($email);

            $result = UserManager::getUserDetails($email);
            if (!$result) {
                http_response_code(404);
                die();
            }

            $userDetails = filterArrayByKeys($_POST, ["name", "userType"]);
            $undefinedFields = getUnsetKeys($userDetails, ["name", "userType"]);

            $userDetails["email"] = $email;

            if (!empty($undefinedFields)) {
                http_response_code(400);
                die();
            }

            if (!$this->validate_user_details($userDetails, true)) {
                http_response_code(400);
                die();
            }

            $result = UserManager::updateUser(
                $email,
                $userDetails["name"],
                $userDetails["userType"]
            );

            if ($result) {
                $response = UserManager::getUserDetails($userDetails["email"]);
                echo json_encode($response);
            } else {
                http_response_code(500);
                die();
            }

        } else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $this->checkAuth("admin/edit", function () {
                if ($_SESSION["user"]["userType"] !== "MANAGER") {
                    http_response_code(403);
                    die();
                }
                return $this->getViewData();
            });

            if (empty($email)) {
                http_response_code(400);
                die();
            }

            $email = urldecode($email);

            $result = UserManager::getUserDetails($email);
            if (!$result) {
                http_response_code(404);
                die();
            }

            $result = UserManager::removeUser($email);
            if (!$result) {
                http_response_code(400);
                die();
            }
        }
    }

    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->checkAuth("admin/search", function () {
                return false;
            });

            if ($_SESSION["user"]["userType"] !== "MANAGER") {
                http_response_code(403);
                die();
            }

            $filterFields = filterArrayByKeys($_GET, self::FIELDS);

            $result = UserManager::getUsersBy(
                $filterFields["email"],
                $filterFields["name"],
                "",
            );
            if ($result) {
                echo json_encode($result);
            } else {
                http_response_code(500);
                die;
            }
        }
    }

    public function validate_user_details($userDetails, $ignorePassword = false) : bool {
        if (strlen($userDetails["name"]) < 1)
            return false;
        if (!filter_var($userDetails["email"], FILTER_VALIDATE_EMAIL))
            return false;
        if (!$ignorePassword)
            if (strlen($userDetails["password"] < 8))
                return false;
        if (!in_array($userDetails["userType"], ["EMPLOYEE", "MANAGER"], true))
            return false;

        return true;
    }

}