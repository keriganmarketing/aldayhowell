<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead  = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');
$clients  = get_terms(['taxonomy' => 'client', 'hide_empty' => true]);

include(locate_template('template-parts/sections/top.php'));

?>
<div class="top-pad"></div>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section id="content" class="section-wrapper">
            <div class="container">
                <div class="content">
                    <?php include(locate_template('template-parts/sections/support-heading.php')); ?>
                    <?php the_content();?>
                    <ul>
                        <?php
                            foreach ($clients as $client) {
                                echo '<li>'. $client->name .'</li>';
                            }
                        ?>
                    </ul>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php include(locate_template('template-parts/sections/bot.php')); ?>