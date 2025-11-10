<?php

class FilmModel
{
    private PDO $bdd;
    private PDOStatement $getFilms;
    private PDOStatement $getFilm;
    private PDOStatement $addFilm;
    private PDOStatement $delFilm;
    private PDOStatement $editFilm;
    private PDOStatement $searchFilm;

    function __construct()
    {
        $this->bdd = new PDO("mysql:host=bdd;dbname=allocine", "root", "root");

        $this->getFilms = $this->bdd->prepare("SELECT * FROM `film` LIMIT :limit");
        $this->getFilm = $this->bdd->prepare("SELECT * FROM `film` WHERE id = :id");
        $this->addFilm = $this->bdd->prepare("INSERT INTO film (nom, date_sortie, genre, auteur) VALUES (:nom, :date_sortie, :genre, :auteur)");
        $this->delFilm = $this->bdd->prepare("DELETE FROM film WHERE id = :id");
        $this->editFilm = $this->bdd->prepare("UPDATE film SET nom = :nom, date_sortie = :date_sortie, genre = :genre, auteur = :auteur WHERE id = :id");
        $this->searchFilm = $this->bdd->prepare("SELECT * FROM `film` WHERE nom like CONCAT('%', :text, '%')");
    }

    public function getAll(int $limit = 50): array
    {
        $this->getFilms->bindValue("limit", $limit, PDO::PARAM_INT);
        $this->getFilms->execute();
        $rawFilms = $this->getFilms->fetchAll();

        $filmsEntity = [];
        foreach ($rawFilms as $rawFilm) {
            $filmsEntity[] = new FilmEntity(
                $rawFilm["nom"],
                $rawFilm["date_sortie"],
                $rawFilm["genre"],
                $rawFilm["auteur"],
                $rawFilm["id"]
            );
        }

        return $filmsEntity;
    }

    public function get($id): FilmEntity | NULL
    {
        $this->getFilm->bindValue("id", $id, PDO::PARAM_INT);
        $this->getFilm->execute();
        $rawFilm = $this->getFilm->fetch();

        if (!$rawFilm) {
            return NULL;
        }

        return new FilmEntity(
            $rawFilm["nom"],
            $rawFilm["date_sortie"],
            $rawFilm["genre"],
            $rawFilm["auteur"],
            $rawFilm["id"]
        );
    }

    public function add(string $nom, string $date_sortie, string $genre, string $auteur): void
    {
        $this->addFilm->bindValue("nom", $nom, PDO::PARAM_STR);
        $this->addFilm->bindValue("date_sortie", $date_sortie, PDO::PARAM_STR);
        $this->addFilm->bindValue("genre", $genre, PDO::PARAM_STR);
        $this->addFilm->bindValue("auteur", $auteur, PDO::PARAM_STR);
        $this->addFilm->execute();
    }

    public function del(int $id): void
    {
        $this->delFilm->bindValue("id", $id, PDO::PARAM_INT);
        $this->delFilm->execute();
    }

    public function edit(
        int $id,
        string $nom = NULL,
        string $date_sortie = NULL,
        string $genre = NULL,
        string $auteur = NULL
    ): FilmEntity | NULL {
        $originalFilmEntity = $this->get($id);

        if (!$originalFilmEntity) {
            return NULL;
        }

        $this->editFilm->bindValue(
            "nom",
            $nom ? $nom : $originalFilmEntity->getNom()
        );
        $this->editFilm->bindValue(
            "date_sortie",
            $date_sortie ? $date_sortie : $originalFilmEntity->getDateSortie()
        );
        $this->editFilm->bindValue(
            "genre",
            $genre ? $genre : $originalFilmEntity->getGenre()
        );
        $this->editFilm->bindValue(
            "auteur",
            $auteur ? $auteur : $originalFilmEntity->getAuteur()
        );

        $this->editFilm->bindValue("id", $id, PDO::PARAM_INT);

        $this->editFilm->execute();

        return $this->get($id);
    }

    public function search(string $text): array
    {
        $this->searchFilm->bindValue("text", $text, PDO::PARAM_STR);
        $this->searchFilm->execute();
        $rawFilms = $this->searchFilm->fetchAll();

        $filmsEntity = [];
        foreach ($rawFilms as $rawFilm) {
            $filmsEntity[] = new FilmEntity(
                $rawFilm["nom"],
                $rawFilm["genre"],
                $rawFilm["auteur"],
                $rawFilm["id"]
            );
        }

        return $filmsEntity;
    }
}


class FilmEntity
{
    private $nom;
    private $date_sortie;
    private $genre;
    private $auteur;
    private $id;

    function __construct(string $nom, string $date_sortie, string $genre, string $auteur, int $id = NULL)
    {
        $this->setNom($nom);
        $this->setDateSortie($date_sortie);
        $this->setGenre($genre);
        $this->setAuteur($auteur);
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function getDateSortie(): string
    {
        return $this->date_sortie;
    }

    public function setDateSortie(string $date_sortie)
    {

        $this->date_sortie = $date_sortie;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre)
    {
        $this->genre = $genre;
    }

    public function getAuteur(): string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur)
    {
        $this->auteur = $auteur;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
