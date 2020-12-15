<?php 
/**
 * Static 
 * 
 * @package Hopes 
 * @since 1.0.0
 */

/**
 * Hopes enqueue scripts 
 *
 */
function hopes_enqueue_scripts() {
  wp_enqueue_script( 'hopes-script', HOPES_URI . '/dist/hopes.frontend.bundle.js', [ 'jquery' ], HOPES_VER, true );
  wp_localize_script( 'hopes-script', 'PHP_DATA', [
    'ajax_url' => admin_url( 'admin-ajax.php' ),
    'lang' => []
  ] );
} 

add_action( 'wp_enqueue_scripts', 'hopes_enqueue_scripts' );