<?php

require_once(__DIR__."/../models/DiffusionModel.php");

class DiffusionController{
    public function view(string $method,array $params = []){
        try {
            return call_user_func([$this,$method],$params);
        } catch (Error $e) {
            return call_user_func([$this, "diffusion"], $params);
        }
    }

    public function diffusion(array $params = []){
        $diffusionModel = new DiffusionModel();
        $diffusions = $diffusionModel->getAll();
        return ['view' => 'diffusion', 'params' => ['diffusions' => $diffusions], 'title' => 'Diffusions'];
    }

    public function addDiffusion(array $params = [])
    {
        $diffusionModel = new DiffusionModel();
        $diffusionModel->add($_POST['film_id'], $_POST['date_diffusion']);
        header('Location: http://localhost:8080/dashboard');
    }

    public function delDiffusion(array $params = [])
    {
        $id = $params[0];
        $diffusionModel = new DiffusionModel();
        $diffusionModel->del($id);
        header('Location: http://localhost:8080/dashboard');
    }
}