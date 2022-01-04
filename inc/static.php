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
  wp_enqueue_style( 'hopes-style', HOPES_URI . '/dist/css/hopes.frontend.css', false, HOPES_VER );
  wp_enqueue_script( 'hopes-script', HOPES_URI . '/dist/hopes.frontend.bundle.js', [ 'jquery' ], HOPES_VER, true );
  wp_localize_script( 'hopes-script', 'HOPES_PHP_DATA', [
    'ajax_url' => admin_url( 'admin-ajax.php' ),
    'lang' => []
  ] );
} 

add_action( 'wp_enqueue_scripts', 'hopes_enqueue_scripts' );

/**
 * Hopes admin enqueue scripts 
 */
function hopes_admin_enqueue_scripts() {
  wp_enqueue_style( 'hopos-admin-style', HOPES_URI . '/dist/css/hopes.admin.css', false, HOPES_VER );
  wp_enqueue_script( 'hopes-admin-script', HOPES_URI . '/dist/hopes.admin.bundle.js', [ 'jquery' ], HOPES_VER );  
  wp_localize_script( 'hopes-admin-script', 'HOPES_PHP_DATA', [
    'donation_custom_status' => hopes_donation_custom_status(),
    'lang' => [
      'error_message_1' => __( 'Type your donation amount.', 'hopes' ),
      'error_message_2' => __( 'Type your information.', 'hopes' ),
    ]
  ] );
}

add_action( 'admin_enqueue_scripts', 'hopes_admin_enqueue_scripts' );