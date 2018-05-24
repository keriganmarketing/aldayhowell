<?php

use Includes\Modules\Slider\BulmaSlider;
use Includes\Modules\Helpers\PageField;

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead  = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');

include(locate_template('template-parts/sections/top.php'));
?>
<div id="mid">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper home-header">
            <?php include(locate_template('template-parts/sections/slider.php')); ?>
        </div>

        <div class="section-wrapper home-page-copy content home">
            <div class="container">
                <section class="home-title">
                    <h1 class="title is-1"><?php echo $headline; ?></h1>
                </section>
                <div class="columns is-multiline">
                    <div class="column is-12 is-8-widescreen">
                    <?php the_content(); ?>
                    </div>
                    <div class="column is-12 is-4-widescreen sidebar text-small">
                    <h4><?= PageField::getField('sidebar_content_title') ?></h4>
                    <?= PageField::getField('sidebar_content_html') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-wrapper featured-projects">
            <?php include(locate_template('template-parts/sections/featured-projects.php')); ?>
        </div>

        <div class="section-wrapper feature-boxes">
            <?php include(locate_template('template-parts/sections/feature-boxes.php')); ?>
        </div>

    </article>
</div>
<?php include(locate_template('template-parts/sections/bot.php')); ?>
