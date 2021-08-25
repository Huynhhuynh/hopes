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

/**
 * Vendor
 */
require( __DIR__ . '/vendor/autoload.php' );

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
  require( HOPES_DIR . '/inc/hooks.php' );
  require( HOPES_DIR . '/inc/helpers.php' );
  require( HOPES_DIR . '/inc/ajax.php' );

  /**
   * Admin
   */
  require( HOPES_DIR . '/inc/custom-role.php' );
  require( HOPES_DIR . '/inc/options.php' );
  require( HOPES_DIR . '/inc/admin/welcome.php' );
  require( HOPES_DIR . '/inc/admin/cause-cpt.php' );
  require( HOPES_DIR . '/inc/admin/donation-cpt.php' );
  require( HOPES_DIR . '/inc/admin/donor-cpt.php' );
  require( HOPES_DIR . '/inc/admin/cause-meta-fields.php' );
  require( HOPES_DIR . '/inc/admin/donation-meta-fields.php' );
  require( HOPES_DIR . '/inc/admin/donor-meta-fields.php' );
  require( HOPES_DIR . '/inc/admin/custom-tax.php' );
}

/**
 * Hopes boot
 */
function hopes_boot() {
  \Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'after_setup_theme', 'hopes_boot' );