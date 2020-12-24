<?php 
/**
 * Welcome page 
 * 
 * @since 1.0.0
 * @package Hopes
 */

function hopes_welcome_page() {
  add_submenu_page( 
    'edit.php?post_type=cause', 
    __( 'Welcome Hopes', 'hopes' ), 
    __( 'Welcome', 'hopes' ), 
    'manage_options', 
    'hopes-welcome',
    'hope_welcome_page_callback'
  );
}

add_action( 'admin_menu', 'hopes_welcome_page' );

function hope_welcome_page_callback() {
  ?>
  Hello...!
  <?
}