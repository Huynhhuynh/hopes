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
  add_action( 'hope/single-cause', 'hopes_cause_single_sidebar', 16 );

  add_action( 'hopes/single-cause-after-title', 'hopes_cause_donate_process_template', 20 );
  add_action( 'hopes/single-cause-after-title', 'hopes_cause_content', 22 );

  add_action( 'hopes/single-cause-sidebar', 'hopes_donation_form', 10 );
}

