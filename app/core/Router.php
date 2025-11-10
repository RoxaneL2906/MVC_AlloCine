<?php
require_once(__DIR__."/../controllers/FilmController.php");
require_once(__DIR__."/../controllers/NotFoundController.php");
require_once(__DIR__."/../controllers/HomeController.php");
require_once(__DIR__."/../controllers/DashboardController.php");
require_once(__DIR__."/../controllers/DiffusionController.php");

class Router{
    public static function getController(string $controllerName){
        switch ($controllerName) {
            case 'film':
                return new FilmController();
                break;
            case 'dashboard':
                return new DashboardController();
                break;
            case 'diffusion':
                return new DiffusionController();
                break;
            case 'home':
                return new HomeController();
                break;
            case '':
                return new HomeController();
                break;
            default:
                return new NotFoundController();
                break;
        }
    }
}