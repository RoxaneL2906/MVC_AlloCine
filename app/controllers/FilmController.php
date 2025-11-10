<?php

require_once(__DIR__ . "/../models/FilmModel.php");
require_once(__DIR__ . "/../models/DiffusionModel.php");

class FilmController
{
    public function view(string $method, array $params = [])
    {
        try {
            return call_user_func([$this, $method], $params);
        } catch (Error $e) {
            console($e);
        }
    }

    public function show(array $params = [])
    {
        $id = $params[0];

        $filmModel = new FilmModel();
        $film = $filmModel->get($id);

        $diffusionModel = new DiffusionModel();
        $diffusions = $diffusionModel->getDiffusionsByFilmId($id);
        $pastDiffusions = $diffusionModel->getPastDiffusionsByFilmId($id);


        return ['view' => 'single-film', 'params' => ['film' => $film, 'diffusions' => $diffusions, 'pastDiffusions' => $pastDiffusions], 'title' => 'Film'];
    }

    public function addFilm(array $params = [])
    {
        $filmsModel = new FilmModel();
        $filmsModel->add($_POST['nom'], $_POST['date_sortie'], $_POST['genre'], $_POST['auteur']);
        header('Location: http://localhost:8080/dashboard');
    }

    public function delFilm(array $params = [])
    {
        $id = $params[0];
        $filmsModel = new FilmModel();
        $filmsModel->del($id);
        header('Location: http://localhost:8080/dashboard');
    }

 
}
