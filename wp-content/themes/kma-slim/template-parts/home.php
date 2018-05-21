<?php

use Includes\Modules\Slider\BulmaSlider;

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

        <div class="section-wrapper home-page-copy">
            <div class="container">
                <div class="content home">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

        <div class="section-wrapper feature-boxes">
            <?php include(locate_template('template-parts/sections/feature-boxes.php')); ?>
        </div>

    </article>
</div>
<?php include(locate_template('template-parts/sections/bot.php')); ?>
