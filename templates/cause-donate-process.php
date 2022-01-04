<?php 
/**
 * Cause donate process 
 * 
 */

# var_dump( $cause_meta_data );
$enable_goal = $cause_meta_data[ 'enable_goal' ];
?>
<div class="donate-process">
  <div class="donate-process__text">
    <?php 
    if( $enable_goal == true ) {
      echo sprintf( 
        '%s <span class="__current">%s</span> / <span class="__target">%s</span>', 
        __( 'Donation goals', 'hopes' ),
        hopes_get_price( $cause_meta_data[ 'total_donated' ] ),
        hopes_get_price( $cause_meta_data[ 'target_donate' ] ) );
    } else {
      echo sprintf(
        '%s <span class="__current">%s</span>',
        __( 'Has raised', 'hopes' ),
        hopes_get_price( $cause_meta_data[ 'total_donated' ] )
      );
    }
    ?> 
  </div>
  <?php ( $enable_goal == true ) ? hopes_donate_process_bar_html( $cause_meta_data[ 'percent' ] ) : ''; ?>
  <?php hopes_the_donor_list_html( $cause_meta_data[ 'donors' ] ); ?>
</div>