<?php 
/**
 * Donation custom port type 
 * 
 * @since 1.0.0
 */

function hopes_register_donation_cpt() {

  $labels = [
    'name' => _x( 'Donations', 'Post type general name', 'hopes' ),
    'singular_name' => _x( 'Donation', 'Post type singular name', 'hopes' ),
    'menu_name' => _x( 'Donations', 'Admin Menu text', 'hopes' ),
    'name_admin_bar' => _x( 'Donation', 'Add New on Toolbar', 'hopes' ),
    'add_new' => __( 'Add Donation', 'hopes' ),
    'add_new_item' => __( 'Add New Donation', 'hopes' ),
    'new_item' => __( 'New Donation', 'hopes' ),
    'edit_item' => __( 'Edit Donation', 'hopes' ),
    'view_item' => __( 'View Donation', 'hopes' ),
    'all_items' => __( 'Donations', 'hopes' ),
    'search_items' => __( 'Search Donations', 'hopes' ),
    'parent_item_colon' => __( 'Parent Donations:', 'hopes' ),
    'not_found' => __( 'No Donations found.', 'hopes' ),
    'not_found_in_trash' => __( 'No Donations found in Trash.', 'hopes' ),
    'featured_image' => _x( 'Donation Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'hopes' ),
    'set_featured_image' => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'hopes' ),
    'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'hopes' ),
    'use_featured_image' => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'hopes' ),
    'archives' => _x( 'Donation archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'hopes' ),
    'insert_into_item' => _x( 'Insert into Donation', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'hopes' ),
    'uploaded_to_this_item' => _x( 'Uploaded to this Donation', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'hopes' ),
    'filter_items_list' => _x( 'Filter Donations list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'hopes' ),
    'items_list_navigation' => _x( 'Donations list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'hopes' ),
    'items_list' => _x( 'Donations list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'hopes' ),
  ];

  $args = [
    'labels' => $labels,
    'exclude_from_search' => false,
    'public' => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'rewrite' => [ 'slug' => 'donation' ],
    'supports' => [ 'title', 'author' ],
    'show_in_menu' => 'edit.php?post_type=hopes-cause'
  ];

  register_post_type( 'hopes-donation', $args );

  register_post_status( 'complete', [
    'label' => _x( 'Complete', 'post status label', 'hopes' ),
		'public' => true,
		'label_count' => _n_noop( 'Completed <span class="count">(%s)</span>', 'Completed <span class="count">(%s)</span>', 'hopes' ),
		'post_type' => [ 'hopes-donation' ], // Define one or more post types the status can be applied to.
		'show_in_admin_all_list' => true,
		'show_in_admin_status_list' => true,
		'show_in_metabox_dropdown' => true,
		'show_in_inline_dropdown' => true,
		'dashicon' => 'dashicons-yes',
  ] );
}

add_action( 'init', 'hopes_register_donation_cpt' );