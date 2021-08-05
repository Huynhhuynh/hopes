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
 * Get currency
 * 
 */
function hopes_get_currency( $currency = '' ) {
  $json = file_get_contents( __DIR__ . '/lib/common-currency.json' );
  $all_currency = json_decode( $json, true );

  if( empty( $currency ) ) {
    return $all_currency;
  } else {
    return isset( $all_currency[ $currency ] ) ? $all_currency[ $currency ] : null;
  }
}

/**
 * Select option currency
 */
function hopes_get_select_option_currency() {
  $all_currency = hopes_get_currency();
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
      'action' => 'DONOR_DONATION_SUCCESSFUL',
      'label' => __( 'Donor — Donation Successful', 'hopes' ),
    ],
    [
      'action' => 'DONOR_OFFLINE_DONATION_INSTRUCTIONS',
      'label' =>  __( 'Donor — Offline Donation Instructions', 'hopes' ),
    ],
    [
      'action' => 'DONOR_REGISTRATION_INFORMATION',
      'label' => __( 'Donor — Registration Information', 'hopes' ),
    ],
    [
      'action' => 'DONOR_CONFIRM_EMAIL',
      'label' => __( 'Donor — Confirm Email (After register user)', 'hopes' ),
    ],
    [
      'action' => 'ADMIN_NEW_DONATION',
      'label' => __( 'Admin — New Donation', 'hopes' ),
      'custom_email_recipients' => true,
    ],
    [
      'action' => 'ADMIN_NEW_OFFLINE_DONATION',
      'label' => __( 'Admin — New Offline Donation', 'hopes' ),
      'custom_email_recipients' => true,
    ],
    [
      'action' => 'ADMIN_NEW_USER_REGISTRATION',
      'label' => __( 'Admin — New User Registration', 'hopes' ),
      'custom_email_recipients' => true,
    ]
  ] );
}

/**
 * 
 * @return Array
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
 * Global default email template 
 * 
 * @return Array
 */
function hopes_set_default_email_template_global_settings() {
  $email_template = require( HOPES_DIR . '/inc/lib/global-default-email-template.php' );
  return $email_template;
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

/**
 * Get total donate by cause id 
 * 
 * @param Int $cause_id
 * @return Int 
 */
function hopes_cause_get_total_donate(  $cause_id = 0 ) {
  // query here!

  return 400; // exam return 400 
}

/**
 * Get price 
 * 
 * @param Int $num
 * @return String 
 */
function hopes_get_price( $num = 0, $currency = null ) {

  if( $currency == null ) {
    $currency = carbon_get_theme_option( 'hopes_currency' );
  }

  $currency_opts = [
    'currency' => hopes_get_currency( $currency ),
    'position' => carbon_get_theme_option( 'hopes_currency_position' ),
    'thousands_separator' => carbon_get_theme_option( 'hopes_currency_thousands_separator' ),
    'decimal_separator' => carbon_get_theme_option( 'hopes_currency_decimal_separator' ),
    'number_of_decimals' => carbon_get_theme_option( 'hopes_currency_number_of_decimals' ),
  ];

  if( $currency_opts[ 'currency' ] === null ) {
    return;
  }

  $currency_pos_temp = [
    'before' => '{symbol}{number}',
    'after' => '{number}{symbol}'
  ];

  $replace_map = [
    '{symbol}' => $currency_opts[ 'currency' ][ 'symbol' ],
    '{number}' => number_format( 
      (float) $num, 
      (int) $currency_opts[ 'number_of_decimals' ], 
      $currency_opts[ 'decimal_separator' ], 
      $currency_opts[ 'thousands_separator' ] ),
  ];

  return str_replace( 
    array_keys( $replace_map ), 
    array_values( $replace_map ), 
    $currency_pos_temp[ $currency_opts[ 'position' ] ] );
}

/**
 * Get percent 
 * 
 * @param Float $target
 * @param Float $achieved
 * 
 * @return Float 
 */
function hopes_get_percent( $target = 0, $achieved = 0 ) {
  $percent = number_format( ($achieved / $target ) * 100, 2, '.', ',' );
  return $percent > 100 ? 100 : $percent;
}


/**
 * Cause donation process
 * 
 * @param Int $post_id
 * @return Void
 */
function hopes_cause_donate_process_template( $post_id ) {

  $target = carbon_get_post_meta( $post_id, 'couse_target_donation_amount' );
  $total = hopes_cause_get_total_donate( $post_id );

  $cause_meta_data = [
    'done' => false,
    'target_donate' => $target,
    'total_donated' => $total,
    'percent' => hopes_get_percent( $target, $total ),
    'goal_achieved_message' => carbon_get_post_meta( $post_id, 'cause_goal_achieved_message' ),
  ];

  set_query_var( 'cause_meta_data', $cause_meta_data );
  load_template( hopes_template_path( 'cause-donate-process.php' ), false );
}

/**
 * Donation custom status data
 * 
 * @return Array
 */
function hopes_donation_custom_status() {
  $custom_status = require( HOPES_DIR . '/inc/lib/donation-custom-status.php' );
  return apply_filters( 'hopes/donation-custom-status', $custom_status );
}

/**
 * Get all cause
 * 
 * @return Array 
 */
function hopes_get_select_option_causes() {
  $causes = get_posts( [
    'numberposts' => -1,
    'post_type' => 'hopes-cause',
    'post_status' => 'publish',
  ] );

  $options = [ '' => __( '— Select Cause —', 'hopes' ) ];
  if( ! $causes || count( $causes ) < 0 ) return $options;

  foreach( $causes as $cause ) {
    $options[ $cause->ID ] = $cause->post_title . ' (#'. $cause->ID .')';
  };

  return $options;
}

/**
 * Get all donor 
 * 
 * @return Array 
 */
function hopes_get_select_option_donors() {
  $donors = get_posts( [
    'numberposts' => -1,
    'post_type' => 'hopes-donor',
    'post_status' => 'publish',
  ] );

  $options = [ '' => __( '— Select Donor —', 'hopes' ) ];
  if( ! $donors || count( $donors ) < 0 ) return $options;

  foreach( $donors as $donor ) {
    $options[ $donor->ID ] = $donor->post_title . ' (#'. $donor->ID .')';
  };

  return $options;
}

/**
 * Get all users 
 * 
 * @return Array 
 */
function hopes_get_select_option_users() {
  $users = get_users();
  $options = [ '' => __( '— Select User —', 'hopes' ) ];
  if( ! $users || count( $users ) < 0 ) return $options;

  foreach( $users as $user ) {
    $options[$user->ID] = $user->display_name . ' ('. $user->user_email .')';
  }

  return $options;
}

/**
 * Get donation by donor ID
 *  
 * @param Int $donor_id
 * 
 * @return Array 
 */
function hopes_get_donation_by_donor( $donor_id = 0, $paged = 1, $posts_per_page = 20 ) {
  $query = new WP_Query( [
    'post_type' => 'hopes-donation',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'post_status' => 'any',
    'meta_query' => [
      [
        'key' => 'donation_donor_id',
        'value' => (int) $donor_id
      ]
    ]
  ] );

  return $query;
}