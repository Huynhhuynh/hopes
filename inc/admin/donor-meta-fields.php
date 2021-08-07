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
