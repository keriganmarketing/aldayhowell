<?php

use Includes\Modules\Layouts\Layouts;

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = '404';
$subhead = 'page not found';

include(locate_template('template-parts/sections/top.php'));
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section id="content" class="entry-content support">
            <div class="container">
                <div class="content">
                    <?php include(locate_template('template-parts/sections/support-heading.php')); ?>
                    <p>The page you requested does not exist. <a href="/">Visit our home page.</a></p>
                </div>
            </div>
        </section>
    </article>
</div>
<?php include(locate_template('template-parts/sections/bot.php')); ?>