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
