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

add_action( 'init', function() {
  if( ! isset( $_GET[ 'dev' ] ) ) return;
  hopes_get_select_option_currency();
} );