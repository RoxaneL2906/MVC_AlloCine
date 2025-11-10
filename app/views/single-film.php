<section>

    <h3> <span>Titre</span>: <?= $film->getNom(); ?> </h3>
    <h3> <span>Date de sortie</span>: <?= $film->getDateSortie(); ?> </h3>
    <h3> <span>Genre</span>: <?= $film->getGenre(); ?> </h3>
    <h3> <span>Auteur</span>: <?= $film->getAuteur(); ?> </h3>


    <div>
        <p>Toutes les diffusions à venir : <br></p>
        <?php foreach ($diffusions as $diffusion): ?>
            <p><?= $diffusion->getDateDiffusion(); ?></p>
        <?php endforeach; ?>
    </div>

    <div>
        <p>Diffusions passées : <br></p>
        <?php foreach ($pastDiffusions as $diffusion): ?>
            <p><?= $diffusion->getDateDiffusion(); ?></p>
        <?php endforeach; ?>
    </div>
</section>