<?php

use Includes\Modules\Team\Team;

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

include(locate_template('template-parts/sections/top.php'));

$team   = new Team();
$member = $team->getSingle($post->post_title);

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead  = $member['title'];
?>

<div class="top-pad"></div>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section id="content" class="section-wrapper">
            <div class="container">
                <div class="content">
                    <div class="columns is-multiline">
                        <div class="column is-3 sidebar">
                            <div class="image">
                                <img src="<?= $member['images']['thumbnail'][0]; ?>">
                            </div>
                        </div>
                        <div class="column is-9">
                            <?php include(locate_template('template-parts/sections/support-heading.php')); ?>
                            <?php if ($member['email'] != '' || $member['phone'] != '') { ?>
                                <p class="contact-info is-flex is-aligned is-multiline flex-wrap">
                                    <?php if ($member['email'] != '') { ?><a class="is-flex is-aligned" href="mailto:<?= $member['email']; ?>">
                                        <span class="icon">
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        </span>&nbsp;<?= $member['email']; ?></a> &nbsp;&nbsp;&nbsp;&nbsp; <?php } ?>
                                    <?php if ($member['phone'] != '') { ?><a class="is-flex is-aligned" href="tel:<?= $member['phone']; ?>">
                                        <span class="icon">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </span>&nbsp;<?= $member['phone']; ?></a><?php } ?>
                                <hr>
                                </p>
                            <?php } ?>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php include(locate_template('template-parts/sections/bot.php')); ?>