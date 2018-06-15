<?php ?>
<div class="column is-3">
    <div class="card is-rounded">
        <div class="card-image">
            <div class="project-photo-crop">
                <img src="<?= $project['featured_image']['thumbnail'][0]; ?>" alt="<?= $project['name']; ?>" >
            </div>
        </div>
        <div class="card-content">
            <p class="title"><strong><?= $project['name']; ?></strong></p>
            <p class="text-small"><?= $project['location']; ?><br>
            <?= $client->name; ?><br>
            <?= $project['cost']; ?></p>
        </div>
        <div class="card-button">
            <a class="button is-small is-primary is-outlined is-round is-caps" href="<?= $project['link']; ?>">Project Details</a>
        </div>
    </div>
</div>