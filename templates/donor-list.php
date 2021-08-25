<?php 
/**
 * Donor list template
 * 
 */

?>
<div class="donor-list">
  <ul class="donor-list__ul">
    <?php foreach( $donors as $index => $donor ) { ?>
    <li class="donor-list__item">
      <div class="donor-list__item-avatar">
        <?php echo $donor[ 'donor_avatar' ]; ?>
      </div>
    </li>
    <?php } ?>
  </ul>
</div>