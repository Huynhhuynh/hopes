<?php 
/**
 * Donor custom post type
 * 
 * @since 1.0.0
 */

function hopes_register_donor_cpt() {

  $labels = [
    'name' => _x( 'Donors', 'Post type general name', 'hopes' ),
    'singular_name' => _x( 'Donor', 'Post type singular name', 'hopes' ),
    'menu_name' => _x( 'Donors', 'Admin Menu text', 'hopes' ),
    'name_admin_bar' => _x( 'Donor', 'Add New on Toolbar', 'hopes' ),
    'add_new' => __( 'Add Donor', 'hopes' ),
    'add_new_item' => __( 'Add New Donor', 'hopes' ),
    'new_item' => __( 'New Donor', 'hopes' ),
    'edit_item' => __( 'Edit Donor', 'hopes' ),
    'view_item' => __( 'View Donor', 'hopes' ),
    'all_items' => __( 'Donors', 'hopes' ),
    'search_items' => __( 'Search Donors', 'hopes' ),
    'parent_item_colon' => __( 'Parent Donors:', 'hopes' ),
    'not_found' => __( 'No Donors found.', 'hopes' ),
    'not_found_in_trash' => __( 'No Donors found in Trash.', 'hopes' ),
    'featured_image' => _x( 'Donor Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'hopes' ),
    'set_featured_image' => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'hopes' ),
    'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'hopes' ),
    'use_featured_image' => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'hopes' ),
    'archives' => _x( 'Donor archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'hopes' ),
    'insert_into_item' => _x( 'Insert into Donor', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'hopes' ),
    'uploaded_to_this_item' => _x( 'Uploaded to this Donor', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'hopes' ),
    'filter_items_list' => _x( 'Filter Donors list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'hopes' ),
    'items_list_navigation' => _x( 'Donors list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'hopes' ),
    'items_list' => _x( 'Donors list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'hopes' ),
  ];

  $args = [
    'labels' => $labels,
    'exclude_from_search' => false,
    'public' => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'rewrite' => [ 'slug' => 'donor' ],
    'supports' => [ 'title', 'author', 'thumbnail' ],
    'show_in_menu' => 'edit.php?post_type=hopes-cause'
  ];

  register_post_type( 'hopes-donor', $args );
}

add_action( 'init', 'hopes_register_donor_cpt' );