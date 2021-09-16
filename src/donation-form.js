/**
 * Donation form 
 * 
 */
import { hopes_price_format } from './helpers';
import HopesFieldValidate from './libs/field-validate';

class HopesDonationForm_Default {
  loggedIn = false;
  causeId = 0;
  currentAmount = null;
  currentStep = 0;
  paymentMethod = {};
  donorInfomation = {
    firstName: '',
    lastName: '',
    email: '',
  };

  constructor( $form ) {
    this.$form = $form;
    this.$amountField = $form.find( 'input[name=donation-amount]' );
    this.loggedIn = parseInt( $form.find( 'input[name=donor-logged-in]' ).val() );
    this.causeId = $form.find( 'input[name=cause-id]' ).val();

    this.amountFieldTriggerOnChange();
    this.pickAmountHandle();
    this.nextStepHandle();
  }

  amountFieldTriggerOnChange() {
    this.$amountField.on( 'change', ( e ) => {
      const currentValue = e.target.value;
      this.$amountField.val( hopes_price_format( currentValue ) )

      // set amount
      this.currentAmount = parseFloat( currentValue );
    } )
  }

  pickAmountHandle() {
    const self = this;

    this.$form.on( 'change', 'input[name=donation-amount-select]', ( e ) => {
      const value = e.target.value
      if( value == 'custom-amount' ) {
        self.$amountField.val( hopes_price_format ( '' ) ).focus()
      } else {
        self.$amountField.val( value ).trigger( 'change' )
      }
    } )
  }

  stepValidate() {
    const self = this;
    return [
      // Step 1
      () => {
        self.$form.find( '.hopes-form--first-step *[data-validate]' )
          .each( ( index, field ) => {
            const pass = HopesFieldValidate( $( field ) )
            console.log( pass )
          } )
      },
      // Step 2
      () => {

      }
    ]
  }

  nextStepHandle() {
    const self = this;
    const $nextStepButton = this.$form.find( '.donation-button-continue' );
    
    $nextStepButton.on( 'click', ( e ) => {
      e.preventDefault();
      const pass = self.stepValidate()[self.currentStep].call();
      console.log(pass);
    } )
  }
}

;( ( w, $ ) => {
  'use strict';
  w.donationFormsAvailable = [];

  $( () => {
    $( 'form.donation-form.donation-form__default-handle' ).each( ( index, form ) => {
      const donationForm = new HopesDonationForm_Default( $( form ) );
      w.donationFormsAvailable.push( donationForm );
    } )
  } )

} )( window, jQuery )

module.exports = {}