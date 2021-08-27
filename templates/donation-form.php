<?php 
/**
 * Donation form template
 * 
 */

$login_text = sprintf( '<div class="donor-login-text">'. __( 'Have an account already?', 'hopes' ) .' <a href="%s">'. __( 'Login', 'hopes' ) .'</a></div>', wp_login_url() );
?>
<div class="donation-form-wrap __default">
  <h4 class="donation-form-title"><?php echo sprintf( __( 'Donate to: <i>%s</i>', 'hopes' ), $cause->post_title ); ?></h4>
  <form action="" class="hopes-form donation-form">
    <div class="donor-infomation">
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
    </div>
  </form>
</div>