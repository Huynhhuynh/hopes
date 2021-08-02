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
      ->add_options( 'hopes_get_select_option_users' )
  ] );

  do_action( 'hopes/donor_meta_options', $donor_meta_options );
}

add_action( 'carbon_fields_register_fields', 'hopes_donor_meta_options' );
