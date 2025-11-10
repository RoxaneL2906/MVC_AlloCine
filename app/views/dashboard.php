<section class="dashboard">
    <div>
        <h3>Ajouter un média</h3>
        <form class="add-media" method="post" action="/film/addFilm">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom">
            </div>
            <div>
                <label for="date_sortie">Date de sortie :</label>
                <input type="date" name="date_sortie" id="date_sortie">
            </div>
            <div>
                <label for="genre">Genre :</label>
                <input type="text" name="genre" id="genre">
            </div>
            <div>
                <label for="auteur">Auteur :</label>
                <input type="text" name="auteur" id="auteur">
            </div>
            <button type="submit">Ajouter le film</button>
        </form>
    </div>

    <div class="right">
        <h3>Liste de films</h3>
        <div class="list-dashboard">
            <?php foreach ($films as $film): ?>
                <div class="details">
                    <a href="http://localhost:8080/film/show/<?= $film->getId(); ?>"><?= $film->getNom(); ?></a>
                    <form method="post" action="/diffusion/addDiffusion">
                        <h5>Programmer une diffusion : </h5>
                        <input type="hidden" name="film_id" value="<?= $film->getId(); ?>">
                        <input type="date" name="date_diffusion">
                        <button type="submit">Programmer</button>
                    </form>
                    <input type="button" onclick="location.href='http://localhost:8080/film/delFilm/<?= $film->getId(); ?>'" value="Supprimer">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>