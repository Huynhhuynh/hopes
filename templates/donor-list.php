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
      <div class="donor-list__item-avatar" title="<?php echo $donor[ 'donor_display_name' ]; ?>">
        <?php echo $donor[ 'donor_avatar' ]; ?>
      </div>
    </li>
    <?php } ?>
  </ul>
  <span class="total-donors"><?php echo sprintf( _n( '%s donor', '%s donors', count( $donors ), 'hopes' ), count( $donors ) ); ?></span>
</div>