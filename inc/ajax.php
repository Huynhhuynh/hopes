<?php 
/**
 * Ajax 
 * 
 * @package Hopes 
 * @since 1.0.0
 */

/**
 * Get all posts
 */
function hopes_ajax_get_all_causes() {
  $causes = hopes_query_all_causes();
  wp_send_json( [
    'success' => 1,
    'result' => $causes
  ] );
} 

add_action( 'wp_ajax_hopes_ajax_get_all_causes', 'hopes_ajax_get_all_causes' );
add_action( 'wp_ajax_nopriv_hopes_ajax_get_all_causes', 'hopes_ajax_get_all_causes' );

function hopes_ajax_query_donations() {
  // wp_send_json( $_POST );
  $params = $_POST[ 'params' ];
  $s = [];

  if( isset( $params[ 'cause-id' ] ) ) {
    array_push( $s, [
      [
        'key' => 'donation_cause_id',
        'value' => (int) $params[ 'cause-id' ],
      ]
    ] );
  }

  if( isset( $params[ 'donor-id' ] ) ) {
    array_push( $s, [
      [
        'key' => 'donation_donor_id',
        'value' => (int) $params[ 'donor-id' ],
      ]
    ] );
  }

  $donation_query = hopes_get_donation( 1, $s );
  
  ob_start();
  while( $donation_query->have_posts() ){
    $donation_query->the_post();
    hopes_donor_the_donation_table_result_item( get_the_ID() );
  }
  $content = ob_get_clean();

  wp_send_json( [
    'success' => true,
    's' => $s,
    'fragments' => [
      '#donor_donation_results' => $content,
    ]
  ] );
}

add_action( 'wp_ajax_hopes_ajax_query_donations', 'hopes_ajax_query_donations' );
add_action( 'wp_ajax_nopriv_hopes_ajax_query_donations', 'hopes_ajax_query_donations' );