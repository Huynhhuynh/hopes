<?php 
/**
 * Donation form template
 * 
 */
// echo '<pre>'; print_r( $donation_form_opts ); echo '</pre>';
?>
<div class="donation-form-wrap __default">
  <h4 class="donation-form-title"><?php echo sprintf( __( 'Donate to "%s"', 'hopes' ), $cause->post_title ); ?></h4>
  <form action="" class="hopes-form donation-form">
    <div class="hopes-form__padding">
      <div class="hopes-form__step hopes-form--first-step">
        <div class="donation-amount">
          <?php if( $donation_form_opts[ 'cause_donation_option' ] == 'multi-level-donation' ) {
            hopes_donation_amount_multi_level_layout( $donation_form_opts[ 'cause_donation_amount_levels' ], [
              'custom_amount' => $donation_form_opts[ 'cause_custom_amount' ],
              'min_amount' => $donation_form_opts[ 'cause_min_amount_limit' ],
              'max_amount' => $donation_form_opts[ 'cause_max_amount_limit' ],
              'text' => $donation_form_opts[ 'cause_custom_amount_text' ],
            ] );
          } else {

          } ?>
        </div>
        <?php hopes_donation_form_donor_infomation(); ?>
      </div>
      <div class="hopes-form__step hopes-form--second-step">
        <?php hopes_donation_form_payment(); ?>
      </div>
    </div>
    <div class="hopes-form__buttons">
      <button type="button" class="hopes-button donation-button-continue"><?php _e( 'Continue', 'hopes' ) ?></button>
    </div> 
  </form>
</div>