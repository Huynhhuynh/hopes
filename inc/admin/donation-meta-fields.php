<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Donation custom meta fields
 * 
 */

function hopes_donation_meta_options() {

  $donation_meta_option_tabs = apply_filters( 'hopes/donation_meta_option_tabs', [] );

  $donation_meta_options = Container::make( 'post_meta', __( 'Donation', 'hopes' ) )
    ->where( 'post_type', '=', 'hopes-donation' );

  if( count( $donation_meta_option_tabs ) > 0 ) {
    foreach( $donation_meta_option_tabs as $tab ) {
      $donation_meta_options->add_tab( $tab[ 'name' ], $tab[ 'fields' ] );
    }
  }

  
  do_action( 'hopes/donation_meta_options', $donation_meta_options );
}

add_action( 'carbon_fields_register_fields', 'hopes_donation_meta_options' );

function hopes_donation_infomation_options_tab_register( $tabs = [] ) {
  
  array_push( $tabs, [
    'name' => __( 'Infomation', 'hopes' ),
    'fields' => [
      Field::make( 'select', 'donation_donor_id', __( 'Donor', 'hopes' ) )
        ->add_options( 'hopes_get_select_option_donors' ),
      Field::make( 'select', 'donation_cause_id', __( 'Cause', 'hopes' ) )
        ->add_options( 'hopes_get_select_option_causes' ),
      Field::make( 'text', 'donation_amount', __( 'Donation Amount', 'hopes' ) )
        ->set_attribute( 'type', 'number' ),
      Field::make( 'select', 'donation_amount_currency', __( 'Currency', 'hopes' ) )
        ->add_options( 'hopes_get_select_option_currency' )
        ->set_default_value( carbon_get_theme_option( 'hopes_currency' ) )
    ],
  ] );

  return $tabs;
}

add_filter( 'hopes/donation_meta_option_tabs', 'hopes_donation_infomation_options_tab_register' );

function hopes_donation_billing_address_options_tab_register( $tabs = [] ) {

  array_push( $tabs, [
    'name' => __( 'Billing Address', 'hopes' ),
    'fields' => [
      Field::make( 'text', 'country', __( 'Country', 'hopes' ) ),
      Field::make( 'text', 'address', __( 'Address 1', 'hopes' ) ),
      Field::make( 'text', 'address_2', __( 'Address 2', 'hopes' ) ),
      Field::make( 'text', 'city', __( 'City', 'hopes' ) ),
      Field::make( 'text', 'zip_code', __( 'Zip / Postal Code', 'hopes' ) ),
    ]
  ] );

  return $tabs;
}

add_filter( 'hopes/donation_meta_option_tabs', 'hopes_donation_billing_address_options_tab_register' );