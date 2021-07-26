<?php 
/**
 * Hooks 
 * 
 */

{
  /**
   * Cause single template hooks 
   * 
   */
  add_filter( 'single_template', 'hopes_cause_custom_single_template' );

  add_action( 'hope/single-cause', 'hopes_cause_single_heading_template', 10 );
  add_action( 'hope/single-cause', 'hopes_cause_single_entry_template', 14 );
}

