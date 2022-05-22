<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/UserManager.php";
require_once __DIR__ . "/../models/UnverifiedUserManager.php";
require_once __DIR__ . "/../EmailHandler.php";

class auth extends Controller
{
    public function register()
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_SESSION["user"]) && isset($_SESSION["last_activity"])) {
                redirectRelative("home/index");
            } else {
                $data = $this->getViewData();
                $this->showView("auth/register", $data);
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userDetails = filterArrayByKeys($_POST, ["email", "name", "password"]);
            $undefinedFields = getUnsetKeys($userDetails, ["email", "name", "password"]);
            if (!empty($undefinedFields)) {
                create_flash_message("auth/register", "All fields are required.", FLASH_ERROR);
                redirectRelative("auth/register");
            }

            if (!filter_var($userDetails["email"], FILTER_VALIDATE_EMAIL)) {
                create_flash_message("auth/register", "Email is invalid.", FLASH_ERROR);
                redirectRelative("auth/register");
            }

            $isRegistered = UserManager::getUserDetails($userDetails["email"]) !== false;

            $isUnverified = UnverifiedUserManager::getUnverifiedUserDetails($userDetails["email"]) !== false;

            if ($isRegistered || $isUnverified) {
                EmailHandler::sendEmail($userDetails["email"], $userDetails["name"], "Email is already registered", "reregister_email", []);
                create_flash_message("auth/login", "Check your inbox for a verification email", FLASH_SUCCESS);
                redirectRelative("auth/login");
            }

            $result = UnverifiedUserManager::addUnverifiedUser($userDetails["email"], $userDetails["name"], $userDetails["password"]);
            if ($result) {
                EmailHandler::sendEmail($userDetails["email"], $userDetails["name"], "Verify email", "email_verification", ['token' => $result]);
                create_flash_message("auth/login", "Check your inbox for a verification email", FLASH_SUCCESS);
                redirectRelative("auth/login");
            } else {
                create_flash_message("auth/register", "Something went wrong", FLASH_ERROR);
                redirectRelative("auth/register");
            }
        }
    }

    public function login()
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_SESSION["user"]) && isset($_SESSION["last_activity"])) {
                redirectRelative("home/index");
            } else {
                $this->showView("auth/login");
                die;
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["email"], $_POST["password"])) {
                if (strlen($_POST["email"]) < 1 || strlen($_POST["password"]) < 1) {
                    create_flash_message("auth/login", "Both email and password required", FLASH_ERROR);
                } else if (!UserManager::checkCredentials($_POST["email"], $_POST["password"])) {
                    create_flash_message("auth/login", "Invalid email or password", FLASH_ERROR);
                } else {
                    $_SESSION["user"] = UserManager::getUserDetails($_POST["email"]);
                    $_SESSION["last_activity"] = time();
                    redirectRelative("home/index");
                }
            } else {
                create_flash_message("auth/login", "Login error occurred.", FLASH_ERROR);
            }
            redirectRelative("auth/login");
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        redirectRelative("auth/login");
    }

    public function send_verification()
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_SESSION["user"]) && isset($_SESSION["last_activity"])) {
                redirectRelative("home/index");
            } else {
                $data = $this->getViewData();
                $this->showView("auth/send_verification", $data);
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["email"])) {
                create_flash_message("auth/send-verification", "Please enter your email", FLASH_ERROR);
                redirectRelative("auth/send-verification");
            }

            $email = $_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                create_flash_message("auth/send-verification", "Email is invalid", FLASH_ERROR);
                redirectRelative("auth/send-verification");
            }

            $isRegistered = UserManager::getUserDetails($email) !== false;

            $isUnverified = UnverifiedUserManager::getUnverifiedUserDetails($email) !== false;

            if ($isRegistered) {
                $user = UnverifiedUserManager::getUnverifiedUserDetails($email);
                EmailHandler::sendEmail($user["email"], $user["name"], "Email is already registered", "reregister_email", []);
            } else if ($isUnverified) {
                $token = UnverifiedUserManager::updateVerificationToken($email);
                $user = UnverifiedUserManager::getUnverifiedUserDetails($email);
                EmailHandler::sendEmail($user["email"], $user["name"], "Verify email", "email_verification", ['token' => $token]);
            } else {
                $name = substr($email, 0, strrpos($email, '@'));  // Extract name from email address
                EmailHandler::sendEmail($email, $name, "Someone tried to verify this email", "verify_unregistered_email", []);
            }

            create_flash_message("auth/login", "Check your inbox for a verification email", FLASH_SUCCESS);
            redirectRelative("auth/login");
        } else {
            redirectRelative("home/index");
        }
    }
}
