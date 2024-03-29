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

function getUnsetKeys(array $data, array $keys): array
{
    return array_filter($keys, function ($key) use ($data) {
        return !isset($data[$key]);
    });
}

function filterArrayByKeys(array $data, array $keys): array
{
    return array_filter($data, function ($key) use ($keys) {
        return in_array($key, $keys);
    }, ARRAY_FILTER_USE_KEY);
}

function safeJsonEncode($obj): string
{
    $encoded = json_encode($obj, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
    return $encoded ?: 'null';
}

function mergeDateTime(string $date, string $time): string
{
    $datetime = new DateTime($date);
    $timeObj = new DateTime($time);

    $datetime->setTime($timeObj->format('H'), $timeObj->format('i'), $timeObj->format('s'));
    return $datetime->format('Y-m-d H:i:s');
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
