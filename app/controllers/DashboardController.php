<?php

require_once(__DIR__."/../models/FilmModel.php");

class DashboardController{
    public function view(string $method,array $params = []){
        try {
            return call_user_func([$this,$method],$params);
        } catch (Error $e) {
            return call_user_func([$this, "dashboard"], $params);
        }
    }

    public function dashboard(array $params = []){
        $filmsModel = new FilmModel();
        $films = $filmsModel->getAll();
        return ['view' => 'dashboard', 'params' => ['films' => $films], 'title' => 'Dashboard'];
    }
}