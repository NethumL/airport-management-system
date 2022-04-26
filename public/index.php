<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/exceptions.php";

ob_start();

try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    // Ignore missing .env
}

define("BASE_URL", $_ENV["BASE_URL"]);
define("PUBLIC_URL", $_ENV["BASE_URL"] . "public/");

require_once __DIR__ . '/../app/init.php';

$original = $_SERVER["REQUEST_URI"];

if (str_ends_with($original, ".php")) {
    header("Location: " . BASE_URL . "home/index");
    die();
} else if (str_starts_with($original, BASE_URL)) {
    $url = substr($original, strlen(BASE_URL));
} else {
    header("Location: " . BASE_URL . "home/index");
    die();
}

$app = new App($url);
ob_end_flush();
