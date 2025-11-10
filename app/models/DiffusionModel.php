<?php

require_once(__DIR__ . "/FilmModel.php");

class DiffusionModel
{

    private PDO $bdd;
    private PDOStatement $getDiffusions;
    private PDOStatement $getNextDiffusions;
    private PDOStatement $getDiffusionsByFilmId;
    private PDOStatement $getDiffusion;
    private PDOStatement $addDiffusion;
    private PDOStatement $delDiffusion;

    function __construct()
    {
        $this->bdd = new PDO("mysql:host=bdd;dbname=allocine", "root", "root");

        $this->getDiffusions = $this->bdd->prepare("SELECT d.id as diffusion_id, d.*, f.id as film_id, f.* FROM `diffusion` d JOIN `film` f ON f.id = d.film_id WHERE date_diffusion >= NOW() ORDER BY date_diffusion ASC LIMIT :limit");
        $this->getNextDiffusions = $this->bdd->prepare("SELECT d.id as diffusion_id, d.*, f.id as film_id, f.* FROM `diffusion` d JOIN `film` f ON f.id = d.film_id WHERE date_diffusion >= now() ORDER BY date_diffusion ASC LIMIT 3");
        $this->getDiffusionsByFilmId = $this->bdd->prepare("SELECT d.id as diffusion_id, d.*, f.id as film_id, f.* FROM `diffusion` d JOIN `film` f ON f.id = d.film_id WHERE f.id = :id AND date_diffusion >= NOW() ORDER BY date_diffusion ASC");
        $this->getDiffusion = $this->bdd->prepare("SELECT * FROM `diffusion` WHERE id = :id");
        $this->addDiffusion = $this->bdd->prepare("INSERT INTO diffusion (film_id, date_diffusion) VALUES (:film_id, :date_diffusion)");
        $this->delDiffusion = $this->bdd->prepare("DELETE FROM diffusion WHERE id = :id");
    }

    public function getAll(int $limit = 50): array
    {
        $this->getDiffusions->bindValue("limit", $limit, PDO::PARAM_INT);
        $this->getDiffusions->execute();
        $rawDiffusions = $this->getDiffusions->fetchAll();

        $diffusionsEntity = [];
        foreach ($rawDiffusions as $rawDiffusion) {
            $filmEntity = new FilmEntity(
                $rawDiffusion["nom"],
                $rawDiffusion["date_sortie"],
                $rawDiffusion["genre"],
                $rawDiffusion["auteur"],
                $rawDiffusion["film_id"]
            );

            $diffusionsEntity[] = new DiffusionEntity(
                $filmEntity,
                $rawDiffusion["date_diffusion"],
                $rawDiffusion["id"]
            );
        }
        return $diffusionsEntity;
    }

    public function getNextDiffusions(): array
    {
        $this->getNextDiffusions->execute();
        $rawNextDiffusions = $this->getNextDiffusions->fetchAll();

        $diffusionsEntity = [];
        foreach ($rawNextDiffusions as $rawNextDiffusion) {
            $filmEntity = new FilmEntity(
                $rawNextDiffusion["nom"],
                $rawNextDiffusion["date_sortie"],
                $rawNextDiffusion["genre"],
                $rawNextDiffusion["auteur"],
                $rawNextDiffusion["film_id"]
            );

            $diffusionsEntity[] = new DiffusionEntity(
                $filmEntity,
                $rawNextDiffusion["date_diffusion"],
                $rawNextDiffusion["id"]
            );
        }
        return $diffusionsEntity;
    }

    public function getDiffusionsByFilmId(int $film_id): array
    {

        $this->getDiffusionsByFilmId->bindValue("id", $film_id, PDO::PARAM_INT);
        $this->getDiffusionsByFilmId->execute();
        $rawDiffusions = $this->getDiffusionsByFilmId->fetchAll();

        $diffusionsEntity = [];
        foreach ($rawDiffusions as $rawDiffusion) {
            $filmEntity = new FilmEntity(
                $rawDiffusion["nom"],
                $rawDiffusion["date_sortie"],
                $rawDiffusion["genre"],
                $rawDiffusion["auteur"],
                $rawDiffusion["film_id"]
            );

            $diffusionsEntity[] = new DiffusionEntity(
                $filmEntity,
                $rawDiffusion["date_diffusion"],
                $rawDiffusion["id"]
            );
        }

        return $diffusionsEntity;
    }

    public function get($id): DiffusionEntity | NULL
    {
        $this->getDiffusion->bindValue("id", $id, PDO::PARAM_INT);
        $this->getDiffusion->execute();
        $rawDiffusion = $this->getDiffusion->fetch();

        if (!$rawDiffusion) {
            return NULL;
        }

        return new DiffusionEntity(
            $rawDiffusion["film_id"],
            $rawDiffusion["date_diffusion"],
            $rawDiffusion["id"]
        );
    }

    public function add(int $film_id, string $date_diffusion): void
    {
        $this->addDiffusion->bindValue("film_id", $film_id, PDO::PARAM_INT);
        $this->addDiffusion->bindValue("date_diffusion", $date_diffusion, PDO::PARAM_STR);
        $this->addDiffusion->execute();
    }

    public function del(int $id): void
    {
        $this->delDiffusion->bindValue("id", $id, PDO::PARAM_INT);
        $this->delDiffusion->execute();
    }
}

class DiffusionEntity
{
    private $film;
    private $date_diffusion;
    private $id;

    function __construct(object $film, string $date_diffusion, int $id = NULL)
    {
        $this->setFilm($film);
        $this->setDateDiffusion($date_diffusion);
        $this->id = $id;
    }


    public function getFilm(): object
    {
        return $this->film;
    }

    public function setFilm(object $film)
    {
        $this->film = $film;
    }

    public function getDateDiffusion(): string
    {
        return $this->date_diffusion;
    }

    public function setDateDiffusion(string $date_diffusion)
    {

        $this->date_diffusion = $date_diffusion;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
