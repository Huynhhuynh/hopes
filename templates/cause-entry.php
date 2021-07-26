<?php 
/**
 * Cause entry template 
 * 
 */

?>
<div class="cause-entry-container">
  <div class="cause-title-summary">
    <div class="post-term"><?php echo get_the_term_list( get_the_ID(), 'cause_tax', __( 'In ', 'hopes' ), ', ', '.' ) ?></div>
    <h2 class="post-title"><?php the_title() ?></h2>
  </div>
</div>