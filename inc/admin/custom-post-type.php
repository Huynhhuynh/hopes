<?php 
/**
 * Register custom post type
 * 
 * @since 1.0.0
 * @package Hopes
 */

function hopes_register_cause_cpt() {
  $icon = '<svg enable-background="new 0 0 473.411 473.411" viewBox="0 0 473.411 473.411" width="18px" xmlns="http://www.w3.org/2000/svg" fill="#000000"><path d="m383.679 163.414c.65-5.461.968-10.518.968-15.473 0-81.57-66.371-147.941-147.941-147.941-78.71 0-143.246 61.762-147.551 141.122-36.942 24.647-59.567 66.198-59.567 110.378 0 73.422 59.725 133.147 133.147 133.147h59.176v88.765h29.589v-88.765h73.971c65.259 0 118.353-53.094 118.353-118.353-.001-42.779-23.261-82.018-60.145-102.88zm-58.209 191.645h-73.97v-207.118h-29.588v105.504l-65.765-43.842-16.412 24.618 82.177 54.784v66.053h-59.176c-57.096 0-103.559-46.463-103.559-103.559 0-37 19.432-70.359 51.967-89.227 4.681-2.731 7.354-8.914 7.209-14.332 0-65.259 53.094-118.353 118.353-118.353s118.353 53.094 118.353 118.353c0 6.299-.693 13.046-2.167 21.209-1.214 6.704 2.326 13.378 8.553 16.152 32.073 14.26 52.791 46.058 52.791 80.992-.001 48.948-39.818 88.765-88.766 88.766z"/></svg>';
  
  $labels = [
    'name' => _x( 'Causes', 'Post type general name', 'hopes' ),
    'singular_name' => _x( 'Cause', 'Post type singular name', 'hopes' ),
    'menu_name' => _x( 'Hopes', 'Admin Menu text', 'hopes' ),
    'name_admin_bar' => _x( 'Cause', 'Add New on Toolbar', 'hopes' ),
    'add_new' => __( 'Add Cause', 'hopes' ),
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
    'exclude_from_search' => false,
    'public' => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'rewrite' => [ 'slug' => 'cause' ],
    'supports' => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt' ],
    'taxonomies' => [ 'cause_tax' ],
    'menu_position' => 25,
    'menu_icon' => 'dashicons-superhero-alt',
    'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode( $icon ),
  ];

  register_post_type( 'cause', $args );
}

add_action( 'init', 'hopes_register_cause_cpt' );