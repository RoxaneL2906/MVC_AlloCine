<?php

require_once(__DIR__ . "/Router.php");

class App
{
    public static function start()
    {
        $uri = $_SERVER["REQUEST_URI"];

        $uri_elements = explode("/", $uri);

        $controllerName = isset($uri_elements[1]) ? strtok($uri_elements[1], '?') : "";
        $methodName = isset($uri_elements[2]) ? strtok($uri_elements[2], '?') : "";
        $params = array_splice($uri_elements, 3);

        $controller = Router::getController($controllerName);

        $result = $controller->view($methodName, $params);

        // console(($result));

        $view = $result['view'] ?? 'home';
        $params = $result['params'] ?? [];
        $title = $result['title'] ?? null;

        extract($params);
        ob_start();
        require __DIR__ . "/../views/{$view}.php";
        $content = ob_get_clean();

        require __DIR__ . "/../views/layout.php";
    }
}
