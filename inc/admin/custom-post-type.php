<?php 
/**
 * Register custom post type
 * 
 * @since 1.0.0
 * @package Hopes
 */

function hopes_register_cause_cpt() {
  $labels = [
    'name' => _x( 'Causes', 'Post type general name', 'hopes' ),
    'singular_name' => _x( 'Cause', 'Post type singular name', 'hopes' ),
    'menu_name' => _x( 'Causes', 'Admin Menu text', 'hopes' ),
    'name_admin_bar' => _x( 'Cause', 'Add New on Toolbar', 'hopes' ),
    'add_new' => __( 'Add New', 'hopes' ),
    'add_new_item' => __( 'Add New Cause', 'hopes' ),
    'new_item' => __( 'New Cause', 'hopes' ),
    'edit_item' => __( 'Edit Cause', 'hopes' ),
    'view_item' => __( 'View Cause', 'hopes' ),
    'all_items' => __( 'All Causes', 'hopes' ),
    'search_items' => __( 'Search Causes', 'hopes' ),
    'parent_item_colon' => __( 'Parent Causes:', 'hopes' ),
    'not_found' => __( 'No Causes found.', 'hopes' ),
    'not_found_in_trash' => __( 'No Causes found in Trash.', 'hopes' ),
    'featured_image' => _x( 'Cause Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'hopes' ),
    'set_featured_image' => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'hopes' ),
    'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'hopes' ),
    'use_featured_image' => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'hopes' ),
    'archives' => _x( 'Cause archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'hopes' ),
    'insert_into_item' => _x( 'Insert into Cause', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'hopes' ),
    'uploaded_to_this_item' => _x( 'Uploaded to this Cause', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'hopes' ),
    'filter_items_list' => _x( 'Filter Causes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'hopes' ),
    'items_list_navigation' => _x( 'Causes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'hopes' ),
    'items_list' => _x( 'Causes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'hopes' ),
  ];

  $args = [
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => 'hopes-welcome',
    'query_var' => true,
    'rewrite' => [ 'slug' => 'cause' ],
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'show_in_rest' => true,
    'supports' => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt' ],
  ];

  register_post_type( 'cause', $args );
}

add_action( 'init', 'hopes_register_cause_cpt' );