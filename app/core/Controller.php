<?php

require_once __DIR__ . "/../utils.php";

abstract class Controller
{
    public function checkAuth(string $view, callable $cb, array $args = [])
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] < 3600) {
            $_SESSION['last_activity'] = time();
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data = call_user_func_array($cb, $args);
                if ($data !== false) {
                    $this->showView($view, $data);
                }
            }
        } else {
            redirectRelative("auth/logout");
            die;
        }
    }

    public function showView(string $view, array $data = [])
    {
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    public function getViewData(): array
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        return [
            "user" => $_SESSION["user"] ?? null,
        ];
    }
}
