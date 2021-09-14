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
  $actions = require( HOPES_DIR . '/inc/lib/email-actions-register.php' );
  return apply_filters( 'hopes/email_actions_register', $actions );
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
  if ( is_singular( 'hopes-cause' ) ) {
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

function hopes_query_donations_by_cause( $cause_id = 0 ) {
  $donations = get_posts( [
    'numberposts' => -1,
    'post_type' => 'hopes-donation',
    'post_status' => 'complete',
    'meta_query' => [
      [
        'field' => 'donation_cause_id',
        'value' => (int) $cause_id,
      ]
    ]
  ] );

  if( $donations && count( $donations ) > 0 ) {
    return array_map( function( $d ) {
      $d->donation_donor_id = carbon_get_post_meta( $d->ID, 'donation_donor_id' );
      $d->donation_amount = carbon_get_post_meta( $d->ID, 'donation_amount' );
      return $d;
    }, $donations );
  }

  return $donations;
}

/**
 * Get donors by cause id 
 * 
 * @param Array $cause_id
 * @return Array
 */
function hopes_get_donors_by_cause( $cause_id = 0 ) {
  $donations = hopes_query_donations_by_cause( $cause_id );
  $donors = [];

  if( ! $donations || count( $donations ) <= 0 ) return $donors;
  
  foreach( $donations as $index => $d ) {
    if( isset( $donors[ $d->donation_donor_id ] ) ) {
      $donors[ $d->donation_donor_id ][ 'donation_total' ] += (float) $d->donation_amount;
      $donors[ $d->donation_donor_id ][ 'donation_count' ] += 1;
      $donors[ $d->donation_donor_id ][ 'donation_ids' ][] = $d->ID;
      continue;
    }

    $donor_id = (int) $d->donation_donor_id;
    $donor_user = carbon_get_post_meta( $donor_id, 'donor_user' );
    $donor_email = carbon_get_post_meta( $donor_id, 'donor_email' );
    [ $first_name, $last_name ] = [ carbon_get_post_meta( $donor_id, 'donor_first_name' ), carbon_get_post_meta( $donor_id, 'donor_last_name' ) ];
    $donor_avatar = '';
    $donor_avatar_url = '';

    if( ! empty( $donor_user ) ) {
      $donor_avatar = get_avatar( $donor_user );
      $donor_avatar_url = get_avatar_url( $donor_user );
    } else {
      $donor_avatar = get_avatar( $donor_email );
      $donor_avatar_url = get_avatar_url( $donor_email );
    }

    $donors[ $donor_id ] = [
      'ID' => $donor_id,
      'donor_user' => $donor_user,
      'donor_first_name' => carbon_get_post_meta( $donor_id, 'donor_first_name' ),
      'donor_last_name' => carbon_get_post_meta( $donor_id, 'donor_last_name' ),
      'donor_display_name' => $first_name . ' ' . $last_name,
      'donor_email' => carbon_get_post_meta( $donor_id, 'donor_email' ),
      'donor_phone' => carbon_get_post_meta( $donor_id, 'donor_phone' ),
      'donor_url' => carbon_get_post_meta( $donor_id, 'donor_url' ),
      'donation_total' => (float) $d->donation_amount,
      'donation_count' => 1,
      'donation_ids' => [ $d->ID ],
      'donor_avatar_url' => $donor_avatar_url,
      'donor_avatar' => $donor_avatar,
    ];
  }

  return $donors;
}

/**
 * Get donor
 * 
 * @param Int $donor_id
 */
function hopes_get_donor( $donor_id = 0 ) {
  $donor = get_post( $donor_id );
  return apply_filters( 'hopes/donor_result', [
    'ID' => (int) $donor_id,
    ] );
}

/**
 * Get total donate by cause id 
 * 
 * @param Int $cause_id
 * @return Int 
 */
function hopes_cause_get_total_donate( $cause_id = 0 ) {
  $donations = hopes_query_donations_by_cause( $cause_id ); 
  if( $donations && count( $donations ) > 0 ) {
    return (float) array_sum( array_map( function( $d ) { return (float) $d->donation_amount; }, $donations ) );
  } else {
    return 0;
  }
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

function hopes_global_currency_info() {
  $currency = carbon_get_theme_option( 'hopes_currency' );
  return hopes_get_currency( $currency );
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
  if( $target == 0 ) return 0;

  $percent = ($achieved / $target ) * 100;
  return $percent > 100 ? 100 : number_format( $percent, 2 );
}


/**
 * Cause donation process
 * 
 * @param Int $post_id
 * @return Void
 */
function hopes_cause_donate_process_template( $post_id ) {

  $enable_goal = carbon_get_post_meta( $post_id, 'cause_donation_goal' );
  $target = carbon_get_post_meta( $post_id, 'cause_target_donation_amount' );
  $total = hopes_cause_get_total_donate( $post_id );
  $donors = hopes_get_donors_by_cause( $post_id );

  if( ! $target ) { $target = 0; }

  $cause_meta_data = [
    'enable_goal' => $enable_goal,
    'done' => false,
    'target_donate' => $target,
    'total_donated' => $total,
    'donors' => $donors,
    'percent' => hopes_get_percent( $target, $total ),
    'goal_achieved_message' => carbon_get_post_meta( $post_id, 'cause_goal_achieved_message' ),
  ];

  set_query_var( 'cause_meta_data', $cause_meta_data );
  load_template( hopes_template_path( 'cause-donate-process.php' ), false );
}

/**
 * Donate process bar html 
 * 
 * @param Int $percent_compelted
 * @return Html
 */
function hopes_donate_process_bar_html( $percent_completed = 0 ) {
  ?>
  <div class="donate-process__bar">
    <div class="__bar">
      <div class="__bar_highlight" style="width: <?php echo $percent_completed; ?>%"></div>
    </div>
  </div>
  <?php 
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

function hopes_build_donation_status_options_html( $echo = fase ) {
  $status = hopes_donation_custom_status();
  $option_html = '';
  foreach( $status as $name => $item ) {
    $option_html .= '<option value="'. $name .'">'. $item[ 'label' ] .'</option>';
  }

  if( $echo == true ) 
    echo $option_html;
  else 
    return $option_html;
}

/**
 * Get all causes 
 * 
 */
function hopes_query_all_causes() {
  return get_posts( [
    'numberposts' => -1,
    'post_type' => 'hopes-cause',
    'post_status' => 'any',
  ] );
}

/**
 * Get all cause
 * 
 * @return Array 
 */
function hopes_get_select_option_causes() {
  $causes = hopes_query_all_causes();
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
 * Get donation 
 *  
 * @param Int $paged
 * @param Int $posts_per_page
 * @param Array $s
 * 
 * @return Array 
 */
function hopes_get_donation( $paged = 1, $s = [], $post_status = 'any' ) {

  $args = [
    'post_type' => 'hopes-donation',
    'posts_per_page' => apply_filters( 'hopes/query_posts_per_page', 20 ),
    'paged' => $paged,
    'post_status' => $post_status,
  ];

  # Search string
  if( isset( $s[ 's' ] ) ) {
    $args[ 's' ] = $s['s' ];
    unset( $s[ 's' ] );
  }

  # Date query
  if( isset( $s[ 'date_query' ] ) ) {
    $args[ 'date_query' ] = array_merge( [
      'column' => 'post_date',
      'inclusive' => true,
    ], $s[ 'date_query' ] );
    unset( $s[ 'date_query' ] );
  }

  # Meta query
  if( count( $s ) > 0 ) {
    $meta_query = [];
    foreach( $s as $s_item ) {
      array_push( $meta_query, $s_item );
    }

    $args[ 'meta_query' ] = $meta_query;
  }
  # wp_send_json( $args );
  return new WP_Query( $args );
}

function hopes_donor_the_donation_table_result_item( $donation_id ) {
  set_query_var( 'donation_id', $donation_id );
  load_template( hopes_template_path( 'admin/donor-donation-table-result-item.php' ), false );
}

/**
 * Donor list template 
 * 
 * @param Array $donors
 * @param Int $showing
 * 
 * @return Html
 */
function hopes_the_donor_list_html( $donors = [], $showing = 6 ) {
  if( ! $donors || count( $donors ) <= 0 ) return;
  set_query_var( 'donors', $donors );
  set_query_var( 'showing', $showing );
  load_template( hopes_template_path( 'donor-list.php' ), false );
}

function hopes_cause_content() {
  ?>
  <div class="cause-content">
    <?php the_content(); ?>
  </div>
  <?php 
}

function hopes_cause_single_sidebar( $cause_id = 0 ) {
  set_query_var( 'cause_id', $cause_id );
  load_template( hopes_template_path( 'single-cause-sidebar.php' ), false );
}

/**
 * Get cause 
 * 
 * @param Int $cause
 * @return Object 
 */
function hopes_get_cause( $cause_id = 0 ) {
  $cause = get_post( $cause_id );
  if( $cause == null ) return null;

  $cause->donation_form_opts = [
    'cause_donation_option' => carbon_get_post_meta( $cause_id, 'cause_donation_option' ),
    'cause_amount_donation' => carbon_get_post_meta( $cause_id, 'cause_amount_donation' ),
    'cause_donation_amount_levels' => carbon_get_post_meta( $cause_id, 'cause_donation_amount_levels' ),
    'cause_custom_amount' => carbon_get_post_meta( $cause_id, 'cause_custom_amount' ),
    'cause_min_amount_limit' => carbon_get_post_meta( $cause_id, 'cause_min_amount_limit' ),
    'cause_max_amount_limit' => carbon_get_post_meta( $cause_id, 'cause_max_amount_limit' ),
    'cause_custom_amount_text' => carbon_get_post_meta( $cause_id, 'cause_custom_amount_text' ),
    'cause_donation_goal' => carbon_get_post_meta( $cause_id, 'cause_donation_goal' ),
    'couse_target_donation_amount' => carbon_get_post_meta( $cause_id, 'couse_target_donation_amount' ),
    'cause_goal_achieved_message' => carbon_get_post_meta( $cause_id, 'cause_goal_achieved_message' ),
  ];
  
  return $cause;
}

function hopes_donation_form( $cause_id ) {
  $cause = hopes_get_cause( $cause_id );
  if( $cause == null ) return;

  set_query_var( 'cause', $cause );
  set_query_var( 'donation_form_opts', $cause->donation_form_opts );
  load_template( hopes_template_path( 'donation-form.php' ), false );
}

function hopes_register_payment_methods() {
  $payment_methods = apply_filters( 'hopes/payment_methods', [
    'test_donation' => [
      'label' => __( 'Test Donation', 'hopes' )
    ],
    'offline_donation' => [
      'label' => __( 'Offline Donation', 'hopes' )
    ],
    'paypal' => [
      'label' => __( 'Paypal' ),
      'brand' => '',
    ]
  ] );
  return $payment_methods;
}

/**
 * 
 */
function hopes_donation_amount_multi_level_layout( $levels, $opts ) {
  set_query_var( 'levels', $levels );
  set_query_var( 'options', $opts );
  set_query_var( 'global_currency_info', hopes_global_currency_info() );
  load_template( hopes_template_path( 'donation-amount-multi-level.php', false ) );
}

