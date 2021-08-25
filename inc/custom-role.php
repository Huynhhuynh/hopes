<?php 
/**
 * Custom user role 
 */

function hopes_add_custom_roles() {
  add_role( 'hopesdonor', __( 'Hopes Donor', 'hopes' ), get_role( 'subscriber' )->capabilities );
}

add_action( 'init', 'hopes_add_custom_roles' );