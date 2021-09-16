<?php 
/**
 * Donation form template
 * 
 */
// echo '<pre>'; print_r( $donation_form_opts ); echo '</pre>';
?>
<div class="donation-form-wrap __default">
  <h4 class="donation-form-title"><?php echo sprintf( __( 'Donate to "%s"', 'hopes' ), $cause->post_title ); ?></h4>
  <form action="" class="hopes-form donation-form donation-form__default-handle">
    <div class="hopes-form__padding">
      <div class="hopes-form__step hopes-form--first-step hopes-form__step--active">
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
        <h4 class="donation-form__label"><?php _e( 'Select Payment Method', 'hopes' ); ?></h4>
        <?php hopes_donation_form_payment(); ?>
      </div>
    </div>
    <div class="hopes-form__buttons">
      <input type="hidden" name="donor-logged-in" value="<?php echo is_user_logged_in(); ?>" />
      <input type="hidden" name="cause-id" value="<?php echo $cause->ID ?>" />
      <button type="button" class="hopes-button donation-button-continue"><?php _e( 'Continue', 'hopes' ) ?></button>
    </div> 
  </form>
</div>