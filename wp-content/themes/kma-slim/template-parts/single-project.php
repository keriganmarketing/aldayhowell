<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');

$youtubeId     = $post->project_details_youtube_video_id;
$featuredImage = $post->project_details_featured_image;
$location      = $post->project_details_location;
$cost          = $post->project_details_cost;
$photoGallery  = $post->project_details_photo_gallery;
$client        = get_the_terms($post->ID, 'client')[0];

include(locate_template('template-parts/sections/top.php'));
?>
<div class="top-pad"></div>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section id="content" class="section-wrapper">
            <div class="container">
                <div class="content">
                    <?php include(locate_template('template-parts/sections/support-heading.php')); ?>
                    <div class="columns is-multiline">
                        <div class="column is-5">
                            <p><strong>Client:</strong><br> <?= $client->name; ?></p>
                            <p><strong>Location:</strong><br> <?= $location; ?></p>
                            <p><strong>Cost:</strong><br> <?= $cost; ?></p>
                            <?php the_content(); ?>
                        </div>
                        <div class="column is-7">
                            <?php if($youtubeId!=''){ ?>
                                <div class="responsive-embed">
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?= $youtubeId; ?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            <?php }else{ ?>
                                <img src="<?= $featuredImage; ?>" alt="<?= $headline; ?>" >
                            <?php } ?>
                        </div>
                    </div>
                    <p>&nbsp;</p>

                    <?php if($photoGallery!=''){
                        $photoGallery = explode('|',$photoGallery);
                        //echo '<pre>',print_r($photoGallery),'</pre>';
                        $photos = [];
                        foreach($photoGallery as $key => $photo){  
                            $photoArray = wp_get_attachment_metadata($photo);
                            //echo '<pre>',print_r($photoArray),'</pre>';
                            $folders = explode('/',$photoArray['file']);
                            $folderPath = $folders[0].'/'.$folders[1];
                            $photos[] = [
                                'id'    => $key,
                                'name'  => $photoArray['image_meta']['title'],
                                'url'   => '/wp-content/uploads/'.$folderPath.'/'.$photoArray['sizes']['thumbnail']['file'],
                                'large' => '/wp-content/uploads/'.$folderPath.'/'.$photoArray['sizes']['large']['file']
                            ];
                        } ?>
                        <photo-gallery :data-photos='<?= json_encode($photos); ?>' ></photo-gallery>
                    <?php } ?>
                    
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php include(locate_template('template-parts/sections/bot.php')); ?>