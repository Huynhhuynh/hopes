<?php 
/**
 * Register custom post type
 * 
 * @since 1.0.0
 * @package Hopes
 */

function hopes_register_cause_cpt() {
  $icon = '
  <svg fill="#000000" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill-rule="evenodd"><path d="m497 195.781h-19.313c-6.751-24.248-28.541-42.442-54.805-42.814-32.3-.458-58.693 25.654-58.693 57.814v72.847c0 69.225-56.101 124.267-124.26 124.267-57.357 0-106.979-38.882-120.671-94.554-1.877-7.632-2.459-20.999 7.387-33.158l-107.187-53.593c-9.517-4.759-19.458 2.647-19.458 12.025 0 22.053 12.25 41.877 31.969 51.737l32.577 16.289c2.903 1.452 5.258 3.806 6.709 6.709 0 .001 39.076 78.143 39.076 78.143 5.653 11.308 57.745 113.421 183.498 113.867 102.321.363 186.038-84.458 186.038-186.78v-92.799h17.133c8.284 0 15-6.716 15-15s-6.716-15-15-15zm-74.972 30c-8.28 0-15-6.728-15-15 0-8.28 6.72-15 15-15s15 6.72 15 15c0 8.273-6.72 15-15 15z"/><path d="m31.969 108.257 105.415 52.708c7.624 3.812 10.583 13.241 6.369 20.765-3.947 7.047-12.94 9.491-20.164 5.879l-31.117-15.558c-8.941-4.47-19.633 1.934-19.634 11.93-.003 22.056 12.248 41.883 31.969 51.744l68.998 34.499c7.409 3.706 10.412 12.715 6.707 20.125-3.049 6.097-8.895 8.308-13.771 8.308-4.219 0-6.226-1.537-6.725-1.786-6.257-3.128-13.296 2.515-11.625 9.308 10.095 41.046 47.274 72.171 92.524 71.714 50.557-.511 93.276-41.509 93.276-94.234v-.027c0-71.501-51.719-107.629-73.14-118.338l-241.596-120.802c-8.939-4.469-19.455 2.032-19.455 12.027 0 34.903 27.461 49.483 31.969 51.738z"/><path d="m141.226 71.838 133.24 66.62c23.865 11.931 44.338 29.499 59.724 51.159v-27c0-31.958-17.755-60.685-46.335-74.972l-159.14-79.57c-8.94-4.47-19.458 2.031-19.458 12.025 0 34.904 27.463 49.485 31.969 51.738z"/></g></svg>';
  
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
    'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode( $icon ),
  ];

  register_post_type( 'hopes-cause', $args );
}

add_action( 'init', 'hopes_register_cause_cpt' );