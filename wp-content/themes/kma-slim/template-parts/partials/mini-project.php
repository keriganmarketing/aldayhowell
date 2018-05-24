<?php ?>
<div class="column is-3">
    <div class="card is-rounded">
        <div class="card-image">
            <div class="project-photo-crop">
                <img src="<?= $project['featured_image']; ?>" alt="<?= $project['name']; ?>" >
            </div>
        </div>
        <div class="card-content">
            <h4 class="title is-5"><strong><?= $project['name']; ?></strong></h4>
            <p class="text-small">Location: <?= $project['city']; ?>, <?= $project['state']; ?><br>
            Client: <?= $project['name']; ?><br>
            Cost: <?= $project['cost']; ?></p>
        </div>
        <div class="card-button">
            <a class="button is-small is-primary is-outlined is-round is-caps" href="<?= $project['link']; ?>">Project Details</a>
        </div>
    </div>
</div>