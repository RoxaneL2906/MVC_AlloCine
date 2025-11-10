<div>
    <h2>Liste des diffusions</h2>
    <div class="list">
        <?php foreach ($diffusions as $diffusion): ?>
            <div class="diffusion">
                <p><?= $diffusion->getDateDiffusion(); ?></p>
                <p><?= $diffusion->getFilm()->getNom(); ?></p>
            </div>            
        <?php endforeach; ?>
    </div>
</div>