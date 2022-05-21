<?php
require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/UserManager.php";

class auth extends Controller
{
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
}
