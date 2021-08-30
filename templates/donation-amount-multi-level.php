<?php 
/**
 * Donation amount multi level
 * 
 */

// var_dump( $levels );
// var_dump( $options );
// var_dump( $global_currency_info[ 'symbol' ] );
?>
<div class="donation-amount-multi-level">
  <label><?php _e( 'Amount', 'hopes' ) ?></label>
  <div class="donation-amount-custom-input">
    <div class="currency-symbols"><?php echo $global_currency_info[ 'symbol' ]; ?></div>
    <input type="number" name="donation-amount" placeholder="<?php _e( 'Enter amount', 'hopes' ) ?>">
  </div>
  <ul class="amount-level">
    <?php foreach( $levels as $index => $level ) { ?>
      <li class="amount-level__item">
        <label title="<?php echo $level[ 'text' ] ?>">
          <input type="radio" name="donation-amount-select" value="<?php echo $level[ 'amount' ] ?>">
          <span class="amount-level__item-amount"><?php echo hopes_get_price( $level[ 'amount' ] ) ?></span>
        </label>
      </li>
    <?php } ?>
    <?php if( $options[ 'custom_amount' ] == true ) { ?>
      <li class="amount-level__item">
        <label title="<?php echo $options[ 'text' ]; ?>">
          <input 
            type="radio" 
            name="donation-amount-select" 
            value="custom-amount"
            data-min-amount="<?php echo (float) $options[ 'min_amount' ]; ?>"
            data-max-amount="<?php echo (float) $options[ 'max_amount' ]; ?>">
          <span class="amount-level__item-amount"><?php echo $options[ 'text' ]; ?></span>
        </label>
      </li>
    <?php } ?>
  </ul>
</div>