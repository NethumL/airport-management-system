<?php

function includeWithVariables($filePath, $variables = [])
{
    if (file_exists($filePath)) {
        extract($variables);
        include $filePath;
    }
}

function showNavbar(array $data, bool $isLoggedIn = true)
{
    includeWithVariables(
        __DIR__ . "/views/templates/navbar.php",
        array("isLoggedIn" => $isLoggedIn, "user" => $data["user"] ?? null)
    );
}

function redirectRelative(string $relativePath)
{
    header("Location: " . BASE_URL . $relativePath);
    die;
}

function safeJsonEncode($obj): string
{
    $encoded = json_encode($obj, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
    return $encoded ?: 'null';
}

const FLASH = "FLASH";
const FLASH_SUCCESS = "success";
const FLASH_ERROR = "danger";

function create_flash_message(string $name, string $message, string $type): void
{
    if (isset($_SESSION[FLASH][$name])) {
        unset($_SESSION[FLASH][$name]);
    }

    $_SESSION[FLASH][$name] = [
        "message" => $message,
        "type" => $type
    ];
}

function display_flash_message(string $name): void
{
    if (!isset($_SESSION[FLASH][$name])) {
        return;
    }

    $message_arr = $_SESSION[FLASH][$name];
    unset($_SESSION[FLASH][$name]);
    $output = "<div class=\"alert alert-%s mx-4\" role=\"alert\">%s</div>";
    echo sprintf($output, $message_arr["type"], htmlspecialchars($message_arr["message"]));
}
