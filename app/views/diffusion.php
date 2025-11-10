<div>
    <h3>Liste des diffusions</h3>
    <div class="list">
        <?php foreach ($diffusions as $diffusion): ?>
            <div class="diffusion">
                <p><?= $diffusion->getFilm()->getNom(); ?></p>
                <p><?= $diffusion->getDateDiffusion(); ?></p>
            </div>            
        <?php endforeach; ?>
    </div>
</div>