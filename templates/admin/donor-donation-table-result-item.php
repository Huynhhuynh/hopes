<?php 
/**
 * 
 */

$donation_amount = hopes_get_price( 
  carbon_get_post_meta( $donation_id, 'donation_amount' ), 
  carbon_get_post_meta( $donation_id, 'donation_amount_currency' ) 
);

$donation_cause_id = carbon_get_post_meta( $donation_id, 'donation_cause_id' );
$cause_title = get_the_title( $donation_cause_id );
$status = get_post_status( $donation_id );
?>
<tr>
  <td>
    <a href="<?php echo get_edit_post_link( $donation_id ) ?>" target="_blank">#<?php echo $donation_id ?></a>
  </td>
  <td>
    <?php echo $donation_amount; ?>
  </td>
  <td>
    <?php echo get_the_date( '', $donation_id ); ?>
  </td>
  <td>
    <span class="hopes__tag is-<?php echo $status; ?>"><?php echo $status; ?></span>
  </td>
  <td>
    <a href="<?php echo get_the_permalink( $donation_cause_id ); ?>" target="_blank"><?php echo $cause_title; ?></a>
  </td>
</tr>