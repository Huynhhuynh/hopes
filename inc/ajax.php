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
  wp_send_json( $_POST );
  $params = $_POST[ 'params' ];
  $posts = hopes_get_donation( 1, 20, [] );
}

add_action( 'wp_ajax_hopes_ajax_query_donations', 'hopes_ajax_query_donations' );
add_action( 'wp_ajax_nopriv_hopes_ajax_query_donations', 'hopes_ajax_query_donations' );