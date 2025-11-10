<section class="dashboard">
    <div>
        <h3>Ajouter un média</h3>
        <form method="post" action="/film/addFilm">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom">

            <label for="date_sortie">Date de sortie :</label>
            <input type="date" name="date_sortie" id="date_sortie">

            <label for="genre">Genre :</label>
            <input type="text" name="genre" id="genre">

            <label for="auteur">Auteur :</label>
            <input type="text" name="auteur" id="auteur">

            <button type="submit">Ajouter le film</button>
        </form>
    </div>

    <div>
        <h3>Liste de films</h3>
        <div class="list">
            <?php foreach ($films as $film): ?>
                <div>
                    <a href="http://localhost:8080/film/show/<?= $film->getId(); ?>"><?= $film->getNom(); ?></a>
                    <form method="post" action="/diffusion/addDiffusion">
                        <input type="hidden" name="film_id" value="<?= $film->getId(); ?>">
                        <input type="date" name="date_diffusion">
                        <button type="submit">Programmer diffusion</button>
                    </form>
                    <input type="button" onclick="location.href='http://localhost:8080/film/delFilm/<?= $film->getId(); ?>'" value="Supprimer">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>