<?php 
/**
 * Welcome page 
 * 
 * @since 1.0.0
 * @package Hopes
 */

function hopes_welcome_page() {
  add_menu_page(
    __( 'Welcome', 'hopes' ), 
    __( 'Hopes', 'hopes' ), 
    'manage_options', 
    'hopes-welcome', 
    '',
    HOPES_URI . '/images/love.svg',
    25
  );

  add_submenu_page( 
    'hopes-welcome', 
    __( 'Welcome Hopes', 'hopes' ), 
    __( 'Welcome', 'hopes' ), 
    'manage_options', 
    'hopes-welcome',
    'hope_welcome_page_callback', 
    0
  );
}

add_action( 'admin_menu', 'hopes_welcome_page' );

function hope_welcome_page_callback() {
  ?>
  Hello...!
  <?
}