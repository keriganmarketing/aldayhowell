<?php ?>
<div class="column is-6-tablet is-3-desktop">
    <div class="card is-rounded is-full-height is-flex-column">
        <div class="card-image">
            <div class="project-photo-crop">
                <img src="<?= $project['featured_image']['thumbnail'][0]; ?>" alt="<?= $project['name']; ?>" >
            </div>
        </div>
        <div class="card-content">
            <p class="title"><strong><?= $project['name']; ?></strong></p>
            <p class="text-small">
                <?= ($project['location']!='' ? $project['location'] . '<br>' : ''); ?>
                <?= ($client->name!='' ? $client->name . '<br>' : ''); ?>
                <?= ($project['cost']!='' ? $project['cost'] : ''); ?>
            </p>
        </div>
        <div class="card-button">
            <a class="button is-small is-primary is-outlined is-round is-caps" href="<?= $project['link']; ?>">Project Details</a>
        </div>
    </div>
</div>