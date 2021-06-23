<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;
/**
 * Options
 */

/**
 * Register global settings panel
 */
function crb_attach_theme_options() {

  $settings_global_tabs = apply_filters( 'hopes/settings_global_tabs', [] );

  $hopes_settings_object = Container::make( 'theme_options', __( 'Settings', 'hopes' ) )
    ->set_page_file( 'hopes-settings' )
    ->set_page_parent( 'edit.php?post_type=cause' );

  foreach( $settings_global_tabs as $index => $tab ) {
    $hopes_settings_object->add_tab( $tab[ 'name' ], $tab[ 'fields' ] );
  }

  add_action( 'hopes/settings_global_object', $hopes_settings_object );
}

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );

/**
 * Global general settings tab
 */
function hopes_settings_global_add_general_tab( $tabs = [] ) {
  $page_options = hopes_get_select_option_page();
  $curreny_coptions = hopes_get_select_option_currency();

  $general_settings = [
    'name' => __( 'General', 'hopes' ),
    'fields' => [
      Field::make( 'separator', 'hopes_page_separator', __( 'Page Settings', 'hopes' ) ),
      Field::make( 'select', 'hopes_success_donation_page', __( 'Success Page', 'hopes' ) )
        ->set_options( $page_options )
        ->set_help_text( __( 'The page donors are sent to after completing their donations.', 'hopes' ) ),
      Field::make( 'select', 'hopes_failed_donation_page', __( 'Failed Donation Page', 'hopes' ) )
        ->set_options( $page_options )
        ->set_help_text( __( 'The page donors are sent to if their donation is cancelled or fails.', 'hopes' ) ),
      Field::make( 'select', 'hopes_donor_dashboard_page', __( 'Donor Dashboard Page', 'hopes' ) )
        ->set_options( $page_options )
        ->set_help_text( __( 'This is the page where donors can manage their information, review history and more (all in one place).', 'hopes' ) ),
      Field::make( 'separator', 'hopes_curency_separator', __( 'Curency Settings', 'hopes' ) ),
      Field::make( 'select', 'hopes_currency', __( 'Currency', 'hopes' ) )
        ->set_options( $curreny_coptions )
        ->set_help_text( __( 'The donation currency. Note that some payment gateways have currency restrictions', 'hopes' ) ),
      Field::make( 'select', 'hopes_currency_position', __( 'Currency Position', 'hopes' ) )
        ->set_options( [
          'before' => __( 'Before - $10', 'hopes' ),
          'after' => __( 'After - 10$', 'hopes' ),
        ] )
        ->set_help_text( __( 'The position of the currency symbol.', 'hopes' ) ),
      Field::make( 'text', 'hopes_currency_thousands_separator', __( 'Thousands Separator', 'hopes' ) )
        ->set_default_value( ',' )
        ->set_help_text( __( 'The symbol (typically , or .) to separate thousands.', 'hopes' ) )
        ->set_width( 30 ),
      Field::make( 'text', 'hopes_currency_decimal_separator', __( 'Decimal Separator', 'hopes' ) )
        ->set_default_value( '.' )
        ->set_help_text( __( 'The symbol (usually , or .) to separate decimal points.', 'hopes' ) )
        ->set_width( 30 ),
      Field::make( 'text', 'hopes_currency_number_of_decimals', __( 'Number of Decimals', 'hopes' ) )
        ->set_default_value( 2 )
        ->set_attribute( 'type', 'number' )
        ->set_help_text( __( 'The number of decimal points displayed in amounts.', 'hopes' ) )->set_width( 30 ),
    ]
  ];

  array_push( $tabs, apply_filters( 'hopes/global_general_settings_tab', $general_settings ) );
  return $tabs;
}

add_action( 'hopes/settings_global_tabs', 'hopes_settings_global_add_general_tab', 10 );

function hopes_settings_global_add_payment_geteways_tab( $tabs = [] ) {

  $payment_gateways_settings = [
    'name' => __( 'Payment Gateways', 'hopes' ),
    'fields' => [
      Field::make( 'select', 'crb_select', __( 'Choose Options' ) )
        ->set_options( array(
          '1' => 1,
          '2' => 2,
          '3' => 3,
          '4' => 4,
          '5' => 5,
        ) )
    ]
  ];

  array_push( $tabs, apply_filters( 'hopes/global_payment_gateways_settings_tab', $payment_gateways_settings ) );
  return $tabs;
}

add_action( 'hopes/settings_global_tabs', 'hopes_settings_global_add_payment_geteways_tab', 20 );