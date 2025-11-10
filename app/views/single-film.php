<h2> <?= $film->getNom(); ?> </h2>
<h2> <?= $film->getDateSortie(); ?> </h2>
<h2> <?= $film->getGenre(); ?> </h2>
<h2> <?= $film->getAuteur(); ?> </h2>


<p>Toutes les diffusions :</p>
<?php foreach ($diffusions as $diffusion): ?>
    <div class="diffusion">
        <p><?= $diffusion->getDateDiffusion(); ?></p>
    </div>
<?php endforeach; ?>