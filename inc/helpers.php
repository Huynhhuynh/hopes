<?php 
/**
 * Helpers 
 * 
 * @package Hopes 
 * @since 1.0.0
 */

/**
 * Tempalte path apply filter 
 * 
 * @param String $full_path 
 * @param String $path 
 * 
 * @return String
 */
function hopes_template_path_apply_filter( $full_path = '', $path = '' ) {
  return apply_filters( 'hopes_hook_template_path__' . $path, $full_path );
}

/**
 * Template path 
 * 
 * @param String $path 
 * @param Boolean $require
 * 
 * @return String 
 */
function hopes_template_path( $path ) {
  $root_template = HOPES_DIR . '/templates/';
  $root_theme_template = get_template_directory() . '/hopes/';
  $root_childtheme_template = get_stylesheet_directory() . '/hopes/';

  # In child theme
  if( file_exists( $root_childtheme_template . $path ) ) {
    return hopes_template_path_apply_filter( $root_childtheme_template . $path, $path );
  }

  # In parent theme
  if( file_exists( $root_theme_template . $path ) ) {
    return hopes_template_path_apply_filter( $root_theme_template . $path, $path );
  }

  # In plugin
  if( file_exists( $root_template . $path ) ) {
    return hopes_template_path_apply_filter( $root_template . $path, $path );
  }

  # Template not exits!
  return;
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
      // 'name' => __( 'Donation Receipt', 'hopes' ),
      'action' => 'DONOR_DONATION_SUCCESSFUL',
      'label' => __( 'Donor — Donation Successful', 'hopes' ),
    ],
    [
      // 'name' => __( 'Offline Donation Instructions', 'hopes' ),
      'action' => 'DONOR_OFFLINE_DONATION_INSTRUCTIONS',
      'label' =>  __( 'Donor — Offline Donation Instructions', 'hopes' ),
    ],
    [
      // 'name' => __( 'User Registration Information', 'hopes' ),
      'action' => 'DONOR_REGISTRATION_INFORMATION',
      'label' => __( 'Donor — Registration Information', 'hopes' ),
    ],
    [
      // 'name' => __( 'Email Access', 'hopes' ),
      'action' => 'DONOR_CONFIRM_EMAIL',
      'label' => __( 'Donor — Confirm Email (After register user)', 'hopes' ),
    ],
    [
      // 'name' => __( 'New Donation', 'hopes' ),
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
      // 'name' => __( 'New User Registration', 'hopes' ),
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
    [
      'enable' => true,
      'email_action' => 'DONOR_CONFIRM_EMAIL',
      'email_subject' => sprintf( __( 'Please confirm your email for %s', 'hopes' ), get_site_url() ),
      'email_header' => __( 'Confirm Email', 'hopes' ),
      'email_message' => '<p>Please click the link to access your donation history on {site_url}. If you did not request this email, please contact {admin_email}.</p>

      <p>{email_access_link}</p>
      
      <p>Sincerely,<br />
      {sitename}</p>',
      'email_recipients' => ''
    ],
    [
      'enable' => true,
      'email_action' => 'ADMIN_NEW_DONATION',
      'email_subject' => __( 'New Donation - #{payment_id}', 'hopes' ),
      'email_header' => __( 'New Donation!', 'hopes' ),
      'email_message' => '<p>Hi there,</p>

      <p>This email is to inform you that a new donation has been made on your website: {site_url}.</p>

      <p>Donor: {name}</b>
      Donation: {donation}</b>
      Amount: {amount}</b>
      Payment Method: {payment_method}</p>

      <p>Thank you,<br />
      {sitename}</p>',
      'email_recipients' => get_option( 'admin_email' )
    ],
    [
      'enable' => true,
      'email_action' => 'ADMIN_NEW_OFFLINE_DONATION',
      'email_subject' => __( 'New Pending Donation', 'hopes' ),
      'email_header' => __( 'New Offline Donation!', 'hopes' ),
      'email_message' => '<p>Hi there,</p>

      <p>This email is to inform you that a new donation has been made on your website: {site_url}.</p>
      
      <p>Donor: {name}<br />
      Donation: {donation}<br />
      Amount: {amount}<br />
      Payment Method: {payment_method}</p>
      
      <p>Thank you,<br />
      {sitename}</p>',
      'email_recipients' => get_option( 'admin_email' )
    ],
    [
      'enable' => true,
      'email_action' => 'ADMIN_NEW_USER_REGISTRATION',
      'email_subject' => sprintf( __( '[%s] New User Registration', 'hopes' ), get_bloginfo( 'name' ) ),
      'email_header' => __( 'New User Registration', 'hopes' ),
      'email_message' => '<p>New user registration on your site {sitename}:</p>

      <p>Username: {username}<br />
      Email: {user_email}</p>',
      'email_recipients' => get_option( 'admin_email' )
    ],
  ];
}

/**
 * Custom single template cause
 * 
 * @param String $template
 */
function hopes_cause_custom_single_template( $template ) {
  if ( is_singular( 'cause' ) ) {
    $template = hopes_template_path( 'single-cause.php' );
  }
  return $template;
}

/**
 * Cause single heading template
 * 
 * @param Int $post_id
 */
function hopes_cause_single_heading_template( $post_id ) {

  // return if not exists
  if( ! has_post_thumbnail( $post_id ) ) return;

  $featured_image_html = get_the_post_thumbnail( $post_id, 'full' ); 
  set_query_var( 'featured_image_html', $featured_image_html );

  load_template( hopes_template_path( 'cause-heading.php' ), false );
}

/**
 * Cause single entry template
 * 
 * @param Int $post_id
 */
function hopes_cause_single_entry_template( $post_id ) {
  load_template( hopes_template_path( 'cause-entry.php' ), false );
}