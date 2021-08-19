<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Donor custom meta fields
 * 
 */

function hopes_donor_meta_options() {

  $donor_meta_options = Container::make( 'post_meta', __( 'Donor', 'hopes' ) )
    ->where( 'post_type', '=', 'hopes-donor' );

  $donor_meta_options->add_fields( [
    Field::make( 'select', 'donor_user', __( 'User', 'hopes' ) )
      ->add_options( 'hopes_get_select_option_users' ),
    Field::make( 'text', 'donor_first_name', __( 'First Name', 'hopes' ) )
      ->set_width( 50 ),
    Field::make( 'text', 'donor_last_name', __( 'Last Name', 'hopes' ) )
      ->set_width( 50 ),
    Field::make( 'text', 'donor_email', __( 'Email', 'hopes' ) ),
    Field::make( 'text', 'donor_phone', __( 'Phone', 'hopes' ) ),
    Field::make( 'text', 'donor_url', __( 'Website', 'hopes' ) ),
  ] );

  do_action( 'hopes/donor_meta_options', $donor_meta_options );
}

add_action( 'carbon_fields_register_fields', 'hopes_donor_meta_options' );

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
  
  $donation_query = hopes_get_donation( 1, [
    [
      'key' => 'donation_donor_id',
      'value' => $post->ID // donor id
    ]
  ] );
  // echo '<pre>'; print_r( $donation_query ); echo '</pre>';
  if( $donation_query->have_posts() ){
    ?>
    <div class="donor-donation-table-entry">
      <div class="filter-donation-bar">
        <div class="__by-cause">
          <label>
            <span class="__label"><?php _e( 'Select cause', 'hopes' ) ?></span>
            <select name="cause-id">
              <option value=""><?php _e( '— All Causes —' ) ?></option>
            </select>
          </label>
        </div>
        <div class="__by-status">
          <label>
            <span class="__label"><?php _e( 'Select status', 'hopes' ) ?></span>
            <select name="donation-status">
              <option value=""><?php _e( '— All Status —' ) ?></option>
              <?php hopes_build_donation_status_options_html( $echo = true ); ?>
            </select>
          </label>
        </div>
        <div class="__by-date">
          <span class="__label"><?php _e( 'Select date', 'hopes' ) ?></span>
          <?php _e( 'from', 'hopes' ) ?> <input name="donation-from-date" type="date" max="<?php echo current_time( 'mysql' ) ?>">
          <?php _e( 'to', 'hopes' ) ?> <input name="donation-end-date" type="date" max="<?php echo current_time( 'mysql' ) ?>">
        </div>
        <input type="hidden" name="donor-id" value="<?php echo $post->ID; ?>">
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
        <tbody class="" id="donor_donation_results">
          <!-- Ajax load items -->
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5">
              <div id="hopes-donor-donations-pagination"></div>
            </td>
          </tr>
        </tfoot>
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