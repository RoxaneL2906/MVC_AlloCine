<div class="search">
    <p></p>
    <form method="get" action="/home/search">
        <input class="searchBar" type="text" name="text" placeholder="Recherche par nom, genre, auteur, ...">
        <input type="submit" hidden />
    </form>
</div>

<div>
    <h2>Prochaines diffusions : </h2>
    <div>
        <?php foreach ($diffusions as $diffusion): ?>
            <div class="diffusion">
                <p><?= $diffusion->getFilm()->getNom(); ?></p>
                <p><?= $diffusion->getDateDiffusion(); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <input type="button" onclick="location.href='http://localhost:8080/diffusion'" value="Tout voir">
</div>
</div>

<div>
    <h2>Tous nos films :</h2>
    <div class="list">
        <?php foreach ($films as $film): ?>
            <a href="/film/show/<?= $film->getId(); ?>"><?= $film->getNom(); ?></a>
        <?php endforeach; ?>
    </div>
</div>