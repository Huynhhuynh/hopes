<?php 
/**
 * Custom taxonomy
 * 
 * @since 1.0.0
 * @package Hopes
 */
{
  /**
   * Register Cause Tax
   */
  function hopes_register_cause_tax() {
    $labels = [
      'name' => _x( 'Categories', 'taxonomy general name', 'hopes' ),
      'singular_name' => _x( 'Category', 'taxonomy singular name', 'hopes' ),
      'search_items' => __( 'Search Categories', 'hopes' ),
      'popular_items' => __( 'Popular Categories', 'hopes' ),
      'all_items' => __( 'All Categories', 'hopes' ),
      'edit_item' => __( 'Edit Category', 'hopes' ),
      'update_item' => __( 'Update Category', 'hopes' ),
      'add_new_item' => __( 'Add New Category', 'hopes' ),
      'new_item_name' => __( 'New Category Name', 'hopes' ),
      'separate_items_with_commas' => __( 'Separate Categories with commas', 'hopes' ),
      'add_or_remove_items' => __( 'Add or remove Categories', 'hopes' ),
      'choose_from_most_used' => __( 'Choose from the most used Category', 'hopes' ),
      'not_found' => __( 'No Category found.', 'hopes' ),
      'menu_name' => __( 'Categories', 'hopes' ),
    ];

    $args = [
      'hierarchical'          => true,
      'labels'                => $labels,
      'show_ui'               => true,
      'show_admin_column'     => false,
      'update_count_callback' => '_update_post_term_count',
      'query_var'             => true,
      'rewrite'               => [ 'slug' => 'cause_tax' ]
    ];

    register_taxonomy( 'cause_tax', 'cause', $args );
  }

  add_action( 'init', 'hopes_register_cause_tax' );
}

add_action( 'admin_menu', function() {
  add_submenu_page(
    'hopes-welcome',
    __( 'Categories', 'hopes' ),
    __( 'Categories', 'hopes' ),
    'manage_options',
    'edit-tags.php?taxonomy=cause_tax&post_type=cause'
  );
} );