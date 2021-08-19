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
  $paged = isset( $params[ 'paged' ] ) ? (int) $params[ 'paged' ] : 1;
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

  $status = 'any';
  if( isset( $params[ 'donation-status' ] ) ) {
    $status = $params[ 'donation-status' ];
  }

  $donation_query = hopes_get_donation( $paged, $s, $status );
  
  ob_start();
  while( $donation_query->have_posts() ){
    $donation_query->the_post();
    hopes_donor_the_donation_table_result_item( get_the_ID() );
  }
  $content = ob_get_clean();

  $result = [
    'success' => true,
    'result' => $donation_query,
    'fragments' => [
      '#donor_donation_results' => $content,
    ]
  ];

  if( isset( $params[ 'pagination' ] ) ) {
    $result[ 'pagination_params' ] = [
      'element_target' => '#hopes-donor-donations-pagination',
      'total' => $donation_query->found_posts,
      'items_per_page' => (int) $donation_query->query_vars[ 'posts_per_page' ],
      'current_page' => (int) $donation_query->query_vars[ 'paged' ]
    ];
  }

  wp_send_json( $result );
}

add_action( 'wp_ajax_hopes_ajax_query_donations', 'hopes_ajax_query_donations' );
add_action( 'wp_ajax_nopriv_hopes_ajax_query_donations', 'hopes_ajax_query_donations' );