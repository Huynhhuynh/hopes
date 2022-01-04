<?php 
/**
 * Cause entry template 
 * 
 */

?>
<div class="cause-entry-container">
  <div class="cause-title">
    <div class="post-term"><?php echo get_the_term_list( get_the_ID(), 'cause_tax', __( 'In ', 'hopes' ), ', ', '.' ) ?></div>
    <h2 class="post-title"><?php the_title() ?></h2>
  </div>
  <?php
  /**
   * hook hopes/single-cause-after-title
   * 
   * @see hopes_cause_donate_process_template - 20
   * @see hopes_cause_content - 22
   */ 
  do_action( 'hopes/single-cause-after-title', get_the_ID() ); 
  ?>
</div>