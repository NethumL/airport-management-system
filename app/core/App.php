<?php

require_once __DIR__ . '/DbConnectionManager.php';
require_once __DIR__ . '/../models/UserManager.php';

class App
{
    protected Controller $controller;
    protected string $methodName;
    protected array $params = [];

    public function __construct($url)
    {
        $url = $this->parseUrl($url);

        if (file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')) {
            $controllerName = $url[0];
            unset($url[0]);
        } else {
            http_response_code(404);
            echo "Controller doesn't exist: " . $url[0] . '<br />';
            die();
        }

        DbConnectionManager::prepare(
            [
                'host' => $_ENV["DB_HOST"],
                'user' => $_ENV["DB_USER"],
                'password' => $_ENV["DB_PASSWORD"],
                'database' => $_ENV["DB_DATABASE"],
            ]
        );

        AbstractManager::prepare();

        include_once __DIR__ . '/../controllers/' . $controllerName . '.php';

        $this->controller = new $controllerName();

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->methodName = $url[1];
                unset($url[1]);
            } else {
                http_response_code(404);
                echo "Method doesn't exist: " . $url[1] . '<br />';
                die();
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->methodName], $this->params);
    }

    public function parseUrl($url)
    {
        if (!$url) {
            header("Location: " . BASE_URL . "home/index");
            die();
        }
        $url = preg_replace("/\?.*$/", "", $url);
        $url = preg_replace("/-/", "_", $url);
        return explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
    }
}
