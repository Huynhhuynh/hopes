<?php 
/**
 * Helpers 
 * 
 * @package Hopes 
 * @since 1.0.0
 */

/**
 * Load template 
 * 
 * @since 1.0
 * @version 1.0
 * 
 * @param String $path
 */
function hopes_template( $path = null ) {
  if( empty( $path ) ) return; 
  $root_path = HOPES_DIR . '/templates/';
}

/**
 * Select option page 
 * 
 */
function hopes_get_select_option_page() {
  $options = [];
  $pages = get_posts( [
    'numberposts' => -1,
    'post_type' => 'page',
    'post_status' => 'publish'
  ] );

  if( !$pages || count( $pages ) <= 0 ) 
    return $options;
  
  foreach( $pages as $index => $p ) {
    $options[ $p->ID ] = $p->post_title;
  }

  return $options;
}

/**
 * Select option currency
 */
function hopes_get_select_option_currency() {
  $json = file_get_contents( __DIR__ . '/lib/common-currency.json' );
  $all_currency = json_decode( $json, true );

  $options = [];
  foreach( $all_currency as $key => $c ) {
    $options[ $key ] = "{$c[ 'name' ]} ({$c[ 'symbol_native' ]})";
  }

  return $options;
}

/**
 * 
 */
function hopes_set_default_email_template_global_settings() {
  return [
    [
      'enable' => true,
      'email_action' => 'DONOR_DONATION_SUCCESSFUL',
      'email_subject' => __( 'Donation Receipt', 'hopes' ),
      'email_header' => __( 'Donation Receipt', 'hopes' ),
      'email_message' => '<p>Dear {name},</p>

      <p>Thank you for your donation. Your generosity is appreciated! Here are the details of your donation:</p>
      
      <p>Donor: {fullname}<br />
      Donation: {donation}<br />
      Donation Date: {date}<br />
      Amount: {amount}<br />
      Payment Method: {payment_method}<br />
      Payment ID: {payment_id}</p>
      
      <p>{receipt_link}</p>
      
      <p>Sincerely,<br />
      {sitename}</p>',
      'email_recipients' => ''
    ],
  ];
}

add_action( 'init', function() {
  if( ! isset( $_GET[ 'dev' ] ) ) return;
  hopes_get_select_option_currency();
} );