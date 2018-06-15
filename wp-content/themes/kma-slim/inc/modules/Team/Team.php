<?php
/**
 * Created by PhpStorm.
 * User: bbair
 * Date: 9/25/2017
 * Time: 8:51 PM
 */

namespace Includes\Modules\Team;

use KeriganSolutions\CPT\CustomPostType;

class Team
{
    public function __construct()
    {
    }

    public function setupAdmin()
    {
        $this->createPostType();
        $this->createAdminColumns();
        $this->setupShortcode();
    }

    public function createPostType()
    {
        $team = new CustomPostType(
            'Team Member',
            [
                'supports'           => [ 'title', 'editor', 'author' ],
                'menu_icon'          => 'dashicons-businessman',
                'has_archive'        => false,
                'menu_position'      => null,
                'public'             => true,
                'publicly_queryable' => true,
                'hierarchical'       => true,
                'show_ui'            => true,
                'show_in_nav_menus'  => true,
                '_builtin'           => false,
                'rewrite'            => [
                    'slug'       => 'about',
                    'with_front' => true,
                    'feeds'      => true,
                    'pages'      => false
                ]
            ]
        );

        $team->addMetaBox(
            'Contact Info',
            [
                'Title'        => 'text',
                'Photo'        => 'image',
                'Email'        => 'text',
                'Phone'        => 'text',
            ]
        );
    }

    /**
     * @return null
     */
    public function createAdminColumns()
    {
        add_filter(
            'manage_team_member_posts_columns',
            function ($defaults) {
                $defaults = [
                    'title'       => 'Name',
                    'wtitle'      => 'Title',
                    'email'       => 'Email Address',
                    'photo'       => 'Photo'
                ];

                return $defaults;
            },
            0
        );

        add_action('manage_team_member_posts_custom_column', function ($column_name, $post_ID) {
            switch ($column_name) {
                case 'photo':
                    $photo = get_post_meta($post_ID, 'contact_info_photo', true);
                    echo(isset($photo) ? '<img src ="' . $photo . '" class="img-fluid" style="width:150px; max-width:100%;" >' : null);
                    break;

                case 'email':
                    $object = get_post_meta($post_ID, 'contact_info_email', true);
                    echo(isset($object) ? date('M j, Y', strtotime($object)) : null);
                    break;

                case 'wtitle':
                    $object = get_post_meta($post_ID, 'contact_info_title', true);
                    echo(isset($object) ? date('M j, Y', strtotime($object)) : null);
                    break;
            }
        }, 0, 2);
    }

    public function getImageSizes( $url ) {

        // Split the $url into two parts with the wp-content directory as the separator
        $parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

        // Get the host of the current site and the host of the $url, ignoring www
        $this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
        $file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

        // Return nothing if there aren't any $url parts or if the current host and $url host do not match
        if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
            return;
        }

        // Now we're going to quickly search the DB for any attachment GUID with a partial path match

        // Example: /uploads/2013/05/test-image.jpg
        global $wpdb;
        $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );

        // Returns null if no attachment is found
        return $attachment[0];
    }

    public function getTeam($args = [])
    {
        $request = [
            'post_type'      => 'team_member',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'offset'         => 0,
            'post_status'    => 'publish',
        ];

        $request = get_posts(array_merge($request, $args));

        $output = [];
        foreach ($request as $item) {
            array_push($output, [
                'id'         => (isset($itemID) ? $item->ID : null),
                'name'       => $item->post_title,
                'title'      => (isset($item->contact_info_title) ? $item->contact_info_title : null),
                'email'      => (isset($item->contact_info_email) ? $item->contact_info_email : null),
                'phone'      => (isset($item->contact_info_phone) ? $item->contact_info_phone : null),
                'slug'       => (isset($item->post_name) ? $item->post_name : null),
                'images'     => [
                    'thumbnail' => wp_get_attachment_image_src($this->getImageSizes($item->contact_info_photo), 'thumbnail'),
                    'medium'    => wp_get_attachment_image_src($this->getImageSizes($item->contact_info_photo), 'medium'),
                    'large'     => wp_get_attachment_image_src($this->getImageSizes($item->contact_info_photo), 'large'),
                    'full'      => wp_get_attachment_image_src($this->getImageSizes($item->contact_info_photo), 'full')
                ],
                'link'       => get_permalink($item->ID),
            ]);
        }

        return $output;
    }

    public function getSingle($name)
    {
        $output = $this->getTeam([
            'title'          => $name,
            'posts_per_page' => 1,
        ]);

        return $output[0];
    }

    public function getTeamNames()
    {
        $request = $this->getTeam([]);

        $output = [];
        foreach ($request as $item) {
            array_push($output, (isset($item->post_title) ? $item->post_title : null));
        }

        return $output;
    }

    public function setupShortcode()
    {
        add_shortcode( 'team', function( $atts ){

            $data = $this->getTeam();
            ob_start();

            echo'<div class="columns is-multiline team">';
            foreach($data as $member){
                include(locate_template('template-parts/partials/mini-team.php'));
            }
            echo '</div>';

            return ob_get_clean();

        } );
    }
}
