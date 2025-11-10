<?php

require_once(__DIR__ . "/../models/FilmModel.php");
require_once(__DIR__ . "/../models/DiffusionModel.php");

class HomeController
{
    public function view(string $method, array $params = [])
    {
        try {
            return call_user_func([$this, $method], $params);
        } catch (Error $e) {
            return call_user_func([$this, "home"], $params);
        }
    }

    public function home($params = [])
    {
        $filmsModel = new FilmModel();
        $films = $filmsModel->getAll();
        $diffusionsModel = new DiffusionModel();
        $diffusions = $diffusionsModel->getNextDiffusions();
        return ['view' => 'home', 'params' => ['films' => $films, 'diffusions' => $diffusions], 'title' => 'Accueil'];
    }

    public function search($params = [])
    {
        $text = $_GET['text'];
        
        $filmsModel = new FilmModel();
        $films = $filmsModel->search($text);
        
        return ['view' => 'home', 'params' => ['films' => $films], 'title' => 'Accueil'];
    }
}
