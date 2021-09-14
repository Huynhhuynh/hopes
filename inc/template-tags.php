<?php 
/**
 * Template tags 
 * 
 * @since 1.0.0
 */

function hopes_donation_form_donor_infomation() {
  $loggedIn = is_user_logged_in();
  $login_text = sprintf( '<div class="donor-login-text">'. __( 'Have an account already?', 'hopes' ) .' <a href="%s">'. __( 'Login', 'hopes' ) .'</a></div>', wp_login_url() );
  $logout_text = sprintf( '<div class="donor-logout-text">'. __( 'Donation with another account?', 'hopes' ) .' <a href="%s">'. __( 'Logout', 'hopes' ) .'</a></div>', wp_login_url() );
  
  ob_start()
  ?>
  <div class="donor-infomation <?php echo $loggedIn ? 'donor-infomation--donor-loggedin' : '' ?>">
    <?php if( $loggedIn ) { 
      $userID = get_current_user_id();
      $userData = get_userdata( $userID );
      ?>
      <div class="donor-tag">
        <div class="donor-avatar">
          <?php echo get_avatar( $userID ); ?>
        </div>
        <div class="donor-common">
          <div class="donor-name"><?php echo $userData->display_name; ?></div>
          <div class="donor-donate-total">6 Donates in total.</div>
        </div>
      </div>
      <?php echo $logout_text; ?>
    <?php } else { ?>
      <?php echo $login_text; ?>
      <div class="hopes-form__field __first-name">
        <input type="text" placeholder="<?php _e( 'First Name', 'hopes' ) ?>">
      </div>
      <div class="hopes-form__field __last-name">
        <input type="text" placeholder="<?php _e( 'Last Name', 'hopes' ) ?>">
      </div>
      <div class="hopes-form__field __email">
        <input type="email" placeholder="<?php _e( 'Email', 'hopes' ) ?>">
      </div>
    <?php } ?>
  </div>
  <?php 
  echo ob_get_clean();
}

function hopes_donation_form_payment( $cause_id = 0 ) {
  if( empty( $cause_id ) ) {
    $cause_id = get_the_ID();
  }

  $post_type = get_post_type( $cause_id );
  if( $post_type != 'hopes-cause' ) return;

  $payments = hopes_register_payment_methods();
  if( count( $payments ) <= 0 ) return;

  ?>
  <ul class="doantion-payment-methods">
    <?php foreach( $payments as $name => $payment ) { ?>
      <li class="payment-method-item __<?php echo $name; ?>">
        <label>
          <div class="hopes-radio-custom-ui">
            <input type="radio" name="payment-method" value="<?php echo $name ?>">
            <span class="__radio-ui"></span>
          </div>
          <div><?php echo $payment[ 'label' ] ?></div>
        </label>
      </li>
    <?php } ?>
  </ul>
  <?php 
}