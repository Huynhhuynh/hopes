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
 * Email actions register
 * 
 */
function hopes_email_actions_register() {
  return apply_filters( 'hopes/email_actions_register', [
    [
      'name' => __( 'Donation Receipt', 'hopes' ),
      'action' => 'DONOR_DONATION_SUCCESSFUL',
      'label' => __( 'Donor — Donation Successful', 'hopes' ),
    ],
    [
      'name' => __( 'Offline Donation Instructions', 'hopes' ),
      'action' => 'DONOR_OFFLINE_DONATION_INSTRUCTIONS',
      'label' =>  __( 'Donor — Offline Donation Instructions', 'hopes' ),
    ],
    [
      'name' => __( 'User Registration Information', 'hopes' ),
      'action' => 'DONOR_REGISTRATION_INFORMATION',
      'label' => __( 'Donor — Registration Information', 'hopes' ),
    ],
    [
      'name' => __( 'Email Access', 'hopes' ),
      'action' => 'DONOR_CONFIRM_EMAIL',
      'label' => __( 'Donor — Confirm Email (After register user)', 'hopes' ),
    ],
    [
      'name' => __( 'New Donation', 'hopes' ),
      'action' => 'ADMIN_NEW_DONATION',
      'label' => __( 'Admin — New Donation', 'hopes' ),
      'custom_email_recipients' => true,
    ],
    [
      'name' => __( 'New Offline Donation', 'hopes' ),
      'action' => 'ADMIN_NEW_OFFLINE_DONATION',
      'label' => __( 'Admin — New Offline Donation', 'hopes' ),
      'custom_email_recipients' => true,
    ],
    [
      'name' => __( 'New User Registration', 'hopes' ),
      'action' => 'ADMIN_NEW_USER_REGISTRATION',
      'label' => __( 'Admin — New User Registration', 'hopes' ),
      'custom_email_recipients' => true,
    ]
  ] );
}

/**
 * 
 */
function hopes_make_options_field( $options = [], $map = ['field_value' => 'value', 'field_label' => 'label'] ) {
  if( count( $options ) <=0 ) return [];
  $_options = [];

  foreach( $options as $index => $o ) {
    if( isset( $o[ $map[ 'field_value' ] ] ) ) {
      $_options[ $o[ $map[ 'field_value' ] ] ] = isset( $o[ $map[ 'field_label' ] ] ) ? $o[ $map[ 'field_label' ] ] : '';
    }
  }

  return $_options;
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
      'email_message' => '<p>Dear {name},</pre>

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
    [
      'enable' => true,
      'email_action' => 'DONOR_OFFLINE_DONATION_INSTRUCTIONS',
      'email_subject' => __( '{donation} - Offline Donation Instructions', 'hopes' ),
      'email_header' => __( 'Offline Donation Instructions', 'hopes' ),
      'email_message' => '<p>To make an offline donation toward this cause, follow these steps:<p/>

      <p>Write a check payable to "{sitename}"<br />
      On the memo line of the check, indicate that the donation is for "{sitename}"<br />
      Mail your check to:</p>
      
      <p>{offline_mailing_address}</p>
      
      <p>Your tax-deductible donation is greatly appreciated!</p>',
      'email_recipients' => ''
    ],
    [
      'enable' => true,
      'email_action' => 'DONOR_REGISTRATION_INFORMATION',
      'email_subject' => sprintf( __( '[%s] Your username and password', 'hopes' ), get_bloginfo( 'name' ) ),
      'email_header' => __( 'New User Registration', 'hopes' ),
      'email_message' => '<p>Dear {name}</p>

      <p>A user account has been created for you on {site_url}. You may access your account at anytime by using "{username}" to log in.</p>
      
      <p>To reset your password, simply click the link below to create a new password:</p>
      
      <p>{reset_password_link}</p>
      
      <p>You can log in to your account using the link below:</p>
      
      <p><a href="'. wp_login_url() .'">Click Here to Log In »</a></p>
      
      <p>Sincerely<br />
      {sitename}</p>',
      'email_recipients' => ''
    ],
  ];
}

add_action( 'init', function() {
  if( ! isset( $_GET[ 'dev' ] ) ) return;
  $email_action_opts = hopes_make_options_field( hopes_email_actions_register(), [
    'field_value' => 'action',
    'field_label' => 'label'
  ] );

  print_r( $email_action_opts );
} );