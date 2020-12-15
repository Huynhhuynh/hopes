<?php 
/**
 * Plugin Name:       Hopes - Donation Plugin and Fundraising
 * Plugin URI:        #
 * Description:       ...
 * Version:           1.0.0
 * Requires at least: 5.3
 * Requires PHP:      7.2
 * Author:            Beplus
 * Author URI:        #
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hopes
 * Domain Path:       /languages
 */

{
  /**
   * Define
   */
  define( 'HOPES_VER', '1.0.0' );
  define( 'HOPES_URI', plugin_dir_url( __FILE__ ) );
  define( 'HOPES_DIR', plugin_dir_path( __FILE__ ) );
}

{
  /**
   * Include
   */
  require( HOPES_DIR . '/inc/static.php' );
  require( HOPES_DIR . '/inc/helpers.php' );
  require( HOPES_DIR . '/inc/ajax.php' );
}