<section class="dashboard">
    <div>
        <h3>Ajouter un média</h3>
        <form class="add-media" method="post" action="/film/addFilm">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required>
            </div>
            <div>
                <label for="date_sortie">Date de sortie :</label>
                <input type="date" name="date_sortie" id="date_sortie" required>
            </div>
            <div class="select-wrapper">
                <label for="genre">Genre :</label>
                <select name="genre" id="genre" required>
                    <option value=''></option>
                    <option value='Action'>Action</option>
                    <option value='Animation'>Animation</option>
                    <option value='Aventure'>Aventure</option>
                    <option value='Comédie'>Comédie</option>
                    <option value='Documentaire'>Documentaire</option>
                    <option value='Drame'>Drame</option>
                    <option value='Fantastique'>Fantastique</option>
                    <option value='Horreur'>Horreur</option>
                    <option value='Policier'>Policier</option>
                    <option value='Romance'>Romance</option>
                    <option value='Science-fiction'>Science-fiction</option>
                    <option value='Thriller'>Thriller</option>
                </select>
            </div>
            <div>
                <label for="auteur">Auteur :</label>
                <input type="text" name="auteur" id="auteur" required>
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
                    <input type="button" onclick="if (confirm('Voulez-vous vraiment supprimer ce film ?')) {
                                location.href='http://localhost:8080/film/delFilm/<?= $film->getId(); ?>';
                            }" value="Supprimer">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>