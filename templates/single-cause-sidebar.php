<?php 
/**
 * Single cause sidebar
 */

?>
<div class="single-cause-sidebar">
  <div class="single-cause-sidebar__inner">
    <?php 
    /**
     * hopes/single-cause-sidebar hook.
     * 
     * @see hopes_donation_form - 10
     */
    do_action( 'hopes/single-cause-sidebar', $cause_id ); 
    ?>
  </div>
</div>