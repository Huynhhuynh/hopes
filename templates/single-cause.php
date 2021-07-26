<?php 
/**
 * Cause single template 
 * 
 */


get_header();

if ( have_posts() ) {
  ?>
  <div class="site-container">
    <article <?php echo post_class() ?>>
      <?php 
      while ( have_posts() ) {
        the_post(); 
        /**
         * hook hope/single-cause. 
         * 
         * @see hopes_cause_single_heading_template - 10
         * @see hopes_cause_single_entry_template - 14
         */
        do_action( 'hope/single-cause', get_the_ID() );
      }
      ?>
    </article>
  </div> <!-- .site-container -->
  <?php
}

get_footer();
