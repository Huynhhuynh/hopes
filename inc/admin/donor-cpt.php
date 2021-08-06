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
    'supports' => [ 'title', 'author' ],
    'show_in_menu' => 'edit.php?post_type=hopes-cause'
  ];

  register_post_type( 'hopes-donor', $args );
}

add_action( 'init', 'hopes_register_donor_cpt' );

/**
 * Register donor donation metabox 
 * 
 */
function hopes_donor_donation_meta_box() {
  add_meta_box(
      'donor-donation',
      __( 'Donation', 'hopes' ),
      'hopes_donor_donation_meta_box_callback',
      'hopes-donor'
  );
}

add_action( 'add_meta_boxes', 'hopes_donor_donation_meta_box' );

function hopes_donor_donation_meta_box_callback() {
  global $post; 
  $save_post = $post;
  if( empty( $post ) || empty( $post->ID ) ) return;
  
  $donation_query = hopes_get_donation_by_donor( $post->ID );
  
  if( $donation_query->have_posts() ){
    ?>
    <div class="donor-donation-table-entry">
      <div class="filter-donation-bar">
        <div class="__by-cause">
          <label>
            <span class="__label"><?php _e( 'Cause', 'hopes' ) ?></span>
            <input list="cause-search" name="cause-search" autocomplete="off" type="search" placeholder="<?php _e( 'Type cause name...', 'hopes' ); ?>">
            <datalist id="cause-search">
              <!-- Data render by js -->
            </datalist>
          </label>
        </div>
        <div class="__by-status">
          <label>
            <span class="__label"><?php _e( 'Select status', 'hopes' ) ?></span>
            <select name="" id="by_cause">
              <option value=""><?php _e( '— All Status —' ) ?></option>
              <?php hopes_build_donation_status_options_html( $echo = true ); ?>
            </select>
          </label>
        </div>
        <div class="__by-date">
          <span class="__label"><?php _e( 'Select date', 'hopes' ) ?></span>
          from <input type="date" max="<?php echo current_time( 'mysql' ) ?>">
          to <input type="date" max="<?php echo current_time( 'mysql' ) ?>">
        </div>
      </div>
      <table class="wp-list-table widefat fixed striped table-view-list">
        <thead>
          <tr>
            <th width="50px"><?php _e( 'ID', 'hopes' ) ?></th>
            <th><?php _e( 'Amount', 'hopes' ) ?></th>
            <th><?php _e( 'Date', 'hopes' ) ?></th>
            <th><?php _e( 'Status', 'hopes' ) ?></th>
            <th><?php _e( 'Cause', 'hopes' ) ?></th>
          </tr>
        </thead>
        <tbody>
        <?php
        while( $donation_query->have_posts() ){
          $donation_query->the_post();
          $donation_amount = hopes_get_price( 
            carbon_get_post_meta( get_the_ID(), 'donation_amount' ), 
            carbon_get_post_meta( get_the_ID(), 'donation_amount_currency' ) 
          );

          $donation_cause_id = carbon_get_post_meta( get_the_ID(), 'donation_cause_id' );
          $cause_title = get_the_title( $donation_cause_id );
          $status = get_post_status( get_the_ID() );
          ?>
          <tr>
            <td><?php the_ID() ?></td>
            <td><?php echo $donation_amount; ?></td>
            <td><?php echo get_the_date( '', get_the_ID() ); ?></td>
            <td><span class="__tag is-<?php echo $status; ?>"><?php echo $status; ?></span></td>
            <td><a href="<?php echo get_the_permalink( $donation_cause_id ); ?>" target="_blank"><?php echo $cause_title; ?></a></td>
          </tr>
          <?php 
        }
        ?>
        </tbody>
      </table>
    </div>
    <?php 
  } else {
    // Error message: sorry, no posts here
    echo wpautop( __( 'No data...!', 'hopes' ) );
  }

  wp_reset_query();

  $GLOBALS[ 'post' ] = $save_post;
}