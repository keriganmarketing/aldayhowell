<?php

use KeriganSolutions\CPT\CustomPostType;

/**
 * Registers the `project` post type.
 */
function project_init() {
	register_post_type( 'project', array(
		'labels'                => array(
			'name'                  => __( 'Projects', 'kma-slim' ),
			'singular_name'         => __( 'Project', 'kma-slim' ),
			'all_items'             => __( 'All Projects', 'kma-slim' ),
			'archives'              => __( 'Project Archives', 'kma-slim' ),
			'attributes'            => __( 'Project Attributes', 'kma-slim' ),
			'insert_into_item'      => __( 'Insert into Project', 'kma-slim' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Project', 'kma-slim' ),
			'featured_image'        => _x( 'Featured Image', 'project', 'kma-slim' ),
			'set_featured_image'    => _x( 'Set featured image', 'project', 'kma-slim' ),
			'remove_featured_image' => _x( 'Remove featured image', 'project', 'kma-slim' ),
			'use_featured_image'    => _x( 'Use as featured image', 'project', 'kma-slim' ),
			'filter_items_list'     => __( 'Filter Projects list', 'kma-slim' ),
			'items_list_navigation' => __( 'Projects list navigation', 'kma-slim' ),
			'items_list'            => __( 'Projects list', 'kma-slim' ),
			'new_item'              => __( 'New Project', 'kma-slim' ),
			'add_new'               => __( 'Add New', 'kma-slim' ),
			'add_new_item'          => __( 'Add New Project', 'kma-slim' ),
			'edit_item'             => __( 'Edit Project', 'kma-slim' ),
			'view_item'             => __( 'View Project', 'kma-slim' ),
			'view_items'            => __( 'View Projects', 'kma-slim' ),
			'search_items'          => __( 'Search Projects', 'kma-slim' ),
			'not_found'             => __( 'No Projects found', 'kma-slim' ),
			'not_found_in_trash'    => __( 'No Projects found in trash', 'kma-slim' ),
			'parent_item_colon'     => __( 'Parent Project:', 'kma-slim' ),
			'menu_name'             => __( 'Projects', 'kma-slim' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'project',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}

function cptMetaBox()
{
	$cpt = new CustomPostType('Project');

	$cpt->addMetaBox('Photo Gallery', [
			'Photo Gallery' => 'gallery',
			'Featured Image' => 'image',
			'Youtube Video Link' => 'text'
		]);
}

add_action( 'init', 'project_init' );
add_action( 'init', 'cptMetaBox' );



/**
 * Sets the post updated messages for the `project` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `project` post type.
 */
function project_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['project'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Project updated. <a target="_blank" href="%s">View Project</a>', 'kma-slim' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'kma-slim' ),
		3  => __( 'Custom field deleted.', 'kma-slim' ),
		4  => __( 'Project updated.', 'kma-slim' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Project restored to revision from %s', 'kma-slim' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Project published. <a href="%s">View Project</a>', 'kma-slim' ), esc_url( $permalink ) ),
		7  => __( 'Project saved.', 'kma-slim' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Project submitted. <a target="_blank" href="%s">Preview Project</a>', 'kma-slim' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Project</a>', 'kma-slim' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Project draft updated. <a target="_blank" href="%s">Preview Project</a>', 'kma-slim' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'project_updated_messages' );
