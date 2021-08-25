<?php 
/**
 * Cause donate process 
 * 
 * 
 */

#echo '<pre>'; print_r( $cause_meta_data[ 'donors' ] ); echo '</pre>';
?>
<div class="donate-process">
  <div class="donate-process__text">
    <?php echo sprintf( 
      '%s <span class="__current">%s</span> / <span class="__target">%s</span>', 
      __( 'Donation goals', 'hopes' ),
      hopes_get_price( $cause_meta_data[ 'total_donated' ] ),
      hopes_get_price( $cause_meta_data[ 'target_donate' ] ) ); ?> 
  </div>
  <div class="donate-process__bar">
    <div class="__bar">
      <div class="__bar_highlight" style="width: <?php echo $cause_meta_data[ 'percent' ]; ?>%"></div>
    </div>
  </div>
  <?php hopes_the_donor_list_html( $cause_meta_data[ 'donors' ] ); ?>
</div>